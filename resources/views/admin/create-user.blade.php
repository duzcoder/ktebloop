@extends('layouts.app')

@section('content')
<style>
    .admin-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    .form-container {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--secondary);
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 184, 35, 0.1);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        font-size: 0.9rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--secondary);
    }

    .btn-outline {
        background: transparent;
        color: var(--secondary);
        border: 1.5px solid var(--secondary);
    }
</style>

<div class="admin-container">
    <div class="page-header">
        <h1 class="welcome-message text-gradient">Créer un Utilisateur</h1>
        <p class="text-lg text-gray-600">Ajouter un nouvel utilisateur au système</p>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nom complet *</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email *</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="text" id="phone" name="phone" class="form-input" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mot de passe *</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Rôle *</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
            </div>

            <div class="flex gap-4 mt-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    Créer l'utilisateur
                </button>
                <a href="{{ route('admin.users') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection