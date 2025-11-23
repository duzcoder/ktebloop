@extends('layouts.app')

@section('content')
<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .table-container {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--gray-200);
    }

    .table th {
        background: var(--gray-50);
        font-weight: 600;
        color: var(--secondary);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: var(--radius);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        font-size: 0.875rem;
    }

    .btn-danger {
        background: #dc2626;
        color: var(--white);
    }
</style>

<div class="admin-container">
    <div class="page-header">
        <h1 class="welcome-message text-gradient">Gestion des Livres</h1>
        <p class="text-lg text-gray-600">Gérer tous les livres du système</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Propriétaire</th>
                    <th>Date d'ajout</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->user->name }}</td>
                    <td>{{ $book->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash mr-2"></i>Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection