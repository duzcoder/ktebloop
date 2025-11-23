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
        <h1 class="welcome-message text-gradient">Mes Demandes de Réservation 🤝</h1>
        <p class="text-lg text-gray-600">L'historique de toutes mes demandes de réservation</p>
    </div>

    <!-- Pending Reservations -->
    @if($reservations->where('status', 'pending')->count() > 0)
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">En Attente de Réponse</h2>
        <div class="books-grid">
            @foreach($reservations->where('status', 'pending') as $reservation)
            <div class="book-card">
                <div class="book-image">
                    @if($reservation->book->image)
                        <img src="{{ asset('storage/' . $reservation->book->image) }}" alt="{{ $reservation->book->title }}">
                    @else
                        <i class="fas fa-book"></i>
                    @endif
                </div>
                <div class="book-content">
                    <h3 class="book-title">{{ $reservation->book->title }}</h3>
                    <p class="book-description">{{ Str::limit($reservation->book->description, 100) }}</p>
                    
                    <div class="book-meta">
                        <span class="book-category">{{ $reservation->book->category }}</span>
                        <span class="book-status" style="background: #FEF3C7; color: #92400E;">
                            En Attente
                        </span>
                    </div>

                    <div class="book-owner">
                        <div class="owner-avatar">
                            {{ substr($reservation->book->user->name, 0, 1) }}
                        </div>
                        <span>Par {{ $reservation->book->user->name }}</span>
                    </div>

                    <div class="reservation-info">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-calendar mr-1"></i>
                            Demandé le: {{ $reservation->created_at->format('d/m/Y') }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            En attente de confirmation du propriétaire
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Accepted Reservations -->
    @if($reservations->where('status', 'accepted')->count() > 0)
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Réservations Acceptées</h2>
        <div class="books-grid">
            @foreach($reservations->where('status', 'accepted') as $reservation)
            <div class="book-card">
                <div class="book-image">
                    @if($reservation->book->image)
                        <img src="{{ asset('storage/' . $reservation->book->image) }}" alt="{{ $reservation->book->title }}">
                    @else
                        <i class="fas fa-book"></i>
                    @endif
                </div>
                <div class="book-content">
                    <h3 class="book-title">{{ $reservation->book->title }}</h3>
                    <p class="book-description">{{ Str::limit($reservation->book->description, 100) }}</p>
                    
                    <div class="book-meta">
                        <span class="book-category">{{ $reservation->book->category }}</span>
                        <span class="book-status status-available">
                            Acceptée
                        </span>
                    </div>

                    <div class="book-owner">
                        <div class="owner-avatar">
                            {{ substr($reservation->book->user->name, 0, 1) }}
                        </div>
                        <div>
                            <span>Par {{ $reservation->book->user->name }}</span>
                            <div class="contact-info mt-2 p-3 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-600 mb-1">
                                    <i class="fas fa-envelope mr-2"></i>
                                    {{ $reservation->book->user->email }}
                                </p>
                                @if($reservation->book->user->phone)
                                <p class="text-sm text-gray-600">
                                    <i class="fas fa-phone mr-2"></i>
                                    {{ $reservation->book->user->phone }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="reservation-info">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-calendar mr-1"></i>
                            Acceptée le: {{ $reservation->updated_at->format('d/m/Y') }}
                        </p>
                        <p class="text-sm text-green-600 font-medium mt-1">
                            Contactez le propriétaire pour organiser l'échange
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Rejected Reservations -->
    @if($reservations->where('status', 'rejected')->count() > 0)
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Réservations Refusées</h2>
        <div class="books-grid">
            @foreach($reservations->where('status', 'rejected') as $reservation)
            <div class="book-card">
                <div class="book-image">
                    @if($reservation->book->image)
                        <img src="{{ asset('storage/' . $reservation->book->image) }}" alt="{{ $reservation->book->title }}">
                    @else
                        <i class="fas fa-book"></i>
                    @endif
                </div>
                <div class="book-content">
                    <h3 class="book-title">{{ $reservation->book->title }}</h3>
                    <p class="book-description">{{ Str::limit($reservation->book->description, 100) }}</p>
                    
                    <div class="book-meta">
                        <span class="book-category">{{ $reservation->book->category }}</span>
                        <span class="book-status status-taken">
                            Refusée
                        </span>
                    </div>

                    <div class="book-owner">
                        <div class="owner-avatar">
                            {{ substr($reservation->book->user->name, 0, 1) }}
                        </div>
                        <span>Par {{ $reservation->book->user->name }}</span>
                    </div>

                    <div class="reservation-info">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-calendar mr-1"></i>
                            Refusée le: {{ $reservation->updated_at->format('d/m/Y') }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Cette réservation a été refusée par le propriétaire
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($reservations->count() === 0)
        <div class="empty-state" style="grid-column: 1 / -1;">
            <i class="fas fa-handshake"></i>
            <h3>Aucune demande de réservation pour le moment</h3>
            <p>Vos demandes de réservation apparaîtront ici</p>
        </div>
    @endif
</div>
@endsection