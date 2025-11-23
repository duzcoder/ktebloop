<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.');
        }
    }

    public function users()
    {
        $this->checkAdmin();
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        $this->checkAdmin();
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès!');
    }

    public function editUser(User $user)
    {
        $this->checkAdmin();
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $this->checkAdmin();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:user,admin',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'role']));

        return redirect()->route('admin.users')->with('success', 'Utilisateur modifié avec succès!');
    }

    public function destroyUser(User $user)
    {
        $this->checkAdmin();
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->books()->delete();
        $user->reservations()->delete();
        $user->receivedReservations()->delete();

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès!');
    }

    public function books()
    {
        $this->checkAdmin();
        $books = Book::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.books', compact('books'));
    }

    public function destroyBook(Book $book)
    {
        $this->checkAdmin();
        if ($book->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('admin.books')->with('success', 'Livre supprimé avec succès!');
    }

    public function dashboard()
    {
        $this->checkAdmin();
        
        $stats = [
            'total_users' => User::count(),
            'total_books' => Book::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'recent_users' => User::orderBy('created_at', 'desc')->take(5)->get(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
}