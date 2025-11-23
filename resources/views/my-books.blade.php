@extends('layouts.app')

@section('content')
<style>
    .my-books-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .book-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        border: 1px solid var(--gray-200);
    }

    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .book-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-400);
    }

    .book-content {
        padding: 1.5rem;
    }

    .book-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 0.5rem;
    }

    .book-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .book-category {
        background: var(--primary-light);
        color: var(--secondary);
        padding: 0.25rem 0.75rem;
        border-radius: 100px;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .book-status {
        padding: 0.25rem 0.75rem;
        border-radius: 100px;
        font-weight: 500;
        font-size: 0.75rem;
    }

    .status-available { background: #D1FAE5; color: #065F46; }
    .status-reserved { background: #FEF3C7; color: #92400E; }
    .status-taken { background: #FEE2E2; color: #991B1B; }

    .reservation-info {
        background: var(--gray-50);
        padding: 1rem;
        border-radius: var(--radius);
        margin: 1rem 0;
    }

    .reservation-count {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--gray-700);
        font-size: 0.875rem;
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

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-outline {
        background: transparent;
        color: var(--secondary);
        border: 1.5px solid var(--secondary);
    }

    .btn-outline:hover {
        background: var(--secondary);
        color: var(--white);
        transform: translateY(-2px);
    }

    .btn-full {
        width: 100%;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--gray-500);
        grid-column: 1 / -1;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--gray-300);
    }
    .action-buttons {
        margin-top: 1rem;
    }

    .flex {
        display: flex;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .flex-1 {
        flex: 1;
    }
</style>

<div class="my-books-container">
    <div class="page-header">
        <h1 class="welcome-message text-gradient">Mes Livres Partagés</h1>
        <p class="text-lg text-gray-600">Gérez les livres que vous avez partagés avec la communauté</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="text-right mb-6">
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>
            Ajouter un livre
        </a>
    </div>

    <div class="books-grid">
        @forelse($books as $book)
            <div class="book-card">
                <div class="book-image">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="book-image">
                    @else
                        <i class="fas fa-book"></i>
                    @endif
                </div>
                <div class="book-content">
                    <h3 class="book-title">{{ $book->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($book->description, 100) }}</p>
                    
                    <div class="book-meta">
                        <span class="book-category">{{ $book->category }}</span>
                        <span class="book-status status-{{ $book->status }}">
                            @if($book->status == 'available')
                                Disponible
                            @elseif($book->status == 'reserved')
                                Réservé
                            @else
                                Pris
                            @endif
                        </span>
                    </div>

                    @if($book->pending_reservations_count > 0)
                        <div class="reservation-info">
                            <div class="reservation-count">
                                <i class="fas fa-clock text-yellow-500"></i>
                                <span><strong>{{ $book->pending_reservations_count }}</strong> demande(s) en attente</span>
                            </div>
                        </div>
                    @endif

                    <div class="reservation-count mb-4">
                        <i class="fas fa-handshake text-blue-500"></i>
                        <span><strong>{{ $book->reservations_count }}</strong> réservation(s) au total</span>
                    </div>

                    <div class="action-buttons">
                    <a href="{{ route('books.reservations', $book->id) }}" class="btn btn-primary btn-full" style="margin-bottom: 0.5rem;">
                        <i class="fas fa-list mr-2"></i>
                        Voir les réservations
                    </a>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline flex-1">
                            <i class="fas fa-edit mr-2"></i>
                            Modifier
                        </a>
                        
                        @if($book->reservations_count == 0)
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-full" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer \"{{ addslashes($book->title) }}\" ? Cette action est irréversible.')">
                                    <i class="fas fa-trash mr-2"></i>
                                    Supprimer
                                </button>
                            </form>
                        @else
                            <button class="btn btn-outline flex-1" disabled title="Impossible de supprimer un livre avec des réservations">
                                <i class="fas fa-trash mr-2"></i>
                                Supprimer
                            </button>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-book-open"></i>
                <h3>Aucun livre partagé</h3>
                <p>Commencez par ajouter votre premier livre à partager avec la communauté !</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary mt-4">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter un livre
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection