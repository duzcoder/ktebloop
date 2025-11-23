@extends('layouts.app')

@section('content')
<style>
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .welcome-message {
        font-size: 2.5rem;
        color: var(--secondary);
        margin-bottom: 1rem;
    }

    .dashboard-layout {
        display: grid;
        grid-template-columns: 1fr 3fr;
        gap: 3rem;
        margin-top: 2rem;
    }

    /* Sidebar Styles */
    .sidebar {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow);
        height: fit-content;
        position: sticky;
        top: 2rem;
    }

    .sidebar-section {
        margin-bottom: 2rem;
    }

    .sidebar-title {
        font-size: 1.25rem;
        color: var(--secondary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sidebar-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1rem;
    }

    /* Books Grid Styles */
    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
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

    .book-image i {
        font-size: 3rem;
    }

    .book-content {
        padding: 1.5rem;
    }

    .book-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .book-description {
        color: var(--gray-600);
        font-size: 0.9rem;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .book-category {
        background: var(--primary-light);
        color: var(--secondary);
        padding: 0.25rem 0.75rem;
        border-radius: 100px;
        font-weight: 500;
    }

    .book-status {
        padding: 0.25rem 0.75rem;
        border-radius: 100px;
        font-weight: 500;
        font-size: 0.75rem;
    }

    .status-available {
        background: #D1FAE5;
        color: #065F46;
    }

    .status-reserved {
        background: #FEF3C7;
        color: #92400E;
    }

    .status-taken {
        background: #FEE2E2;
        color: #991B1B;
    }

    .book-owner {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        font-size: 0.875rem;
        color: var(--gray-600);
    }

    .owner-avatar {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Filter and Search Styles */
    .search-box {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 184, 35, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
    }

    .filter-group {
        margin-bottom: 1rem;
    }

    .filter-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--gray-700);
    }

    .filter-select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 0.9rem;
        background: var(--white);
    }

    /* Button Styles */
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

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--gray-500);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--gray-300);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .dashboard-layout {
            grid-template-columns: 1fr;
        }
        
        .sidebar {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }
        
        .dashboard-container {
            padding: 1rem;
        }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="welcome-message text-gradient">Bienvenue, {{ Auth::user()->name ?? 'Utilisateur' }}! 👋</h1>
        <p class="text-lg text-gray-600">Découvrez les livres disponibles dans la communauté Ktebloop</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="dashboard-layout">
        <!-- Sidebar with filters and user info -->
        <div class="sidebar">
            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <div class="sidebar-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    Rechercher
                </h3>
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Rechercher un livre..." id="searchInput">
                </div>
            </div>

            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <div class="sidebar-icon">
                        <i class="fas fa-filter"></i>
                    </div>
                    Filtres
                </h3>
                <div class="filter-group">
                    <label class="filter-label">Catégorie</label>
                    <select class="filter-select" id="categoryFilter">
                        <option value="">Toutes les catégories</option>
                        <option value="Roman">Roman</option>
                        <option value="Science-Fiction">Science-Fiction</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Mystère">Mystère</option>
                        <option value="Biographie">Biographie</option>
                        <option value="Histoire">Histoire</option>
                        <option value="Développement personnel">Développement personnel</option>
                        <option value="Cuisine">Cuisine</option>
                        <option value="Voyage">Voyage</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Statut</label>
                    <select class="filter-select" id="statusFilter">
                        <option value="">Tous les statuts</option>
                        <option value="available">Disponible</option>
                        <option value="reserved">Réservé</option>
                    </select>
                </div>
            </div>

            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <div class="sidebar-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    Mon Profil
                </h3>
                <div class="user-info">
                    <div class="book-owner">
                        <div class="owner-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">{{ Auth::user()->email }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline btn-full">
                        <i class="fas fa-edit mr-2"></i>
                        Modifier le profil
                    </a>
                </div>
                <div class="navigation-links">
                    <br>
                    <a href="{{ route('my-books') }}" class="btn btn-outline btn-full" style="margin-bottom: 1rem;">
                        <i class="fas fa-book-open mr-2"></i>
                        Mes livres partagés
                    </a>
                    <a href="{{ route('my-reservations') }}" class="btn btn-outline btn-full">
                        <i class="fas fa-handshake mr-2"></i>
                        Mes réservations
                    </a>
                </div>
            </div>

            <div class="sidebar-section">
                <a href="{{ route('books.create') }}" class="btn btn-primary btn-full">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter un livre
                </a>
            </div>
        </div>

        <!-- Main Content - Books Grid -->
        <div class="main-content">
            <div class="books-grid" id="booksGrid">
                @forelse($books as $book)
                    <div class="book-card" data-category="{{ $book->category }}" data-status="{{ $book->status }}" data-title="{{ strtolower($book->title) }}">
                        <div class="book-image">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="book-image">
                            @else
                                <i class="fas fa-book"></i>
                            @endif
                        </div>
                        <div class="book-content">
                            <h3 class="book-title">{{ $book->title }}</h3>
                            <p class="book-description">{{ Str::limit($book->description, 100) }}</p>
                            
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

                            <div class="book-owner">
                                <div class="owner-avatar">
                                    {{ substr($book->user->name, 0, 1) }}
                                </div>
                                <span>Par {{ $book->user->name }}</span>
                            </div>

                            @if($book->status == 'available' && $book->user_id != Auth::id())
                                @if($book->status == 'available' && $book->user_id != Auth::id())
                                    <form action="{{ route('reservations.store', $book->id) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-full" onclick="return confirm('Voulez-vous réserver ce livre ?')">
                                            <i class="fas fa-handshake mr-2"></i>
                                            Réserver
                                        </button>
                                    </form>
                                @elseif($book->user_id == Auth::id())
                                    <button class="btn btn-outline btn-full" disabled>
                                        <i class="fas fa-user mr-2"></i>
                                        Votre livre
                                    </button>
                                @else
                                    <button class="btn btn-outline btn-full" disabled>
                                        <i class="fas fa-clock mr-2"></i>
                                        Indisponible
                                    </button>
                                @endif
                            @elseif($book->user_id == Auth::id())
                                <button class="btn btn-outline btn-full" disabled>
                                    <i class="fas fa-user mr-2"></i>
                                    Votre livre
                                </button>
                            @else
                                <button class="btn btn-outline btn-full" disabled>
                                    <i class="fas fa-clock mr-2"></i>
                                    Indisponible
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="fas fa-book-open"></i>
                        <h3>Aucun livre disponible pour le moment</h3>
                        <p>Soyez le premier à ajouter un livre à la communauté !</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    // Simple search and filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const statusFilter = document.getElementById('statusFilter');
        const bookCards = document.querySelectorAll('.book-card');

        function filterBooks() {
            const searchTerm = searchInput.value.toLowerCase();
            const categoryValue = categoryFilter.value;
            const statusValue = statusFilter.value;

            bookCards.forEach(card => {
                const title = card.getAttribute('data-title');
                const category = card.getAttribute('data-category');
                const status = card.getAttribute('data-status');

                const matchesSearch = title.includes(searchTerm);
                const matchesCategory = !categoryValue || category === categoryValue;
                const matchesStatus = !statusValue || status === statusValue;

                if (matchesSearch && matchesCategory && matchesStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterBooks);
        categoryFilter.addEventListener('change', filterBooks);
        statusFilter.addEventListener('change', filterBooks);
    });

    function reserveBook(bookId) {
        if (confirm('Voulez-vous réserver ce livre ?')) {
            // Here you would typically make an AJAX request to reserve the book
            alert('Fonction de réservation à implémenter pour le livre ID: ' + bookId);
        }
    }
</script>
@endsection