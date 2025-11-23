<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Log; // Add this import

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Debug: Let's see what's happening
        Log::info('Login attempt', [
            'email' => $this->email,
            'ip' => $this->ip()
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            Log::warning('Login failed: User not found', ['email' => $this->email]);
            throw ValidationException::withMessages([
                'email' => 'Aucun utilisateur trouvé avec cette adresse email.',
            ]);
        }

        // Check password manually
        if (!Hash::check($this->password, $user->password)) {
            Log::warning('Login failed: Password incorrect', ['email' => $this->email]);
            throw ValidationException::withMessages([
                'email' => 'Le mot de passe est incorrect.',
            ]);
        }

        Log::info('Credentials are correct, attempting Auth::login', ['user_id' => $user->id]);

        // Manual login since Auth::attempt might be having issues
        Auth::login($user);

        Log::info('Manual login successful', ['user_id' => Auth::id()]);

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => 'Trop de tentatives de connexion. Veuillez réessayer dans '.ceil($seconds / 60).' minutes.',
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}