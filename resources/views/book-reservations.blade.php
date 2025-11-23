@extends('layouts.app')

@section('content')
<style>
    .reservations-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--secondary);
        text-decoration: none;
        margin-bottom: 1rem;
        font-weight: 500;
    }

    .book-info-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
        border-left: 4px solid var(--primary);
    }

    .reservations-list {
        display: grid;
        gap: 1rem;
    }

    .reservation-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        box-shadow: var(--shadow);
        border-left: 4px solid;
    }

    .reservation-pending { border-left-color: #F59E0B; }
    .reservation-accepted { border-left-color: #10B981; }
    .reservation-rejected { border-left-color: #EF4444; }
    .reservation-completed { border-left-color: #3B82F6; }

    .reservation-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-weight: 600;
        font-size: 1rem;
    }

    .user-details h4 {
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 0.25rem;
    }

    .user-details p {
        color: var(--gray-600);
        font-size: 0.875rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 100px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .status-pending { background: #FEF3C7; color: #92400E; }
    .status-accepted { background: #D1FAE5; color: #065F46; }
    .status-rejected { background: #FEE2E2; color: #991B1B; }
    .status-completed { background: #E0E7FF; color: #3730A3; }

    .reservation-meta {
        color: var(--gray-600);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
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

    .btn-success { background: #10B981; color: white; }
    .btn-danger { background: #EF4444; color: white; }
    .btn-info { background: #3B82F6; color: white; }
    .btn:disabled { opacity: 0.6; cursor: not-allowed; }

    .btn:hover:not(:disabled) {
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--gray-500);
    }

    .contact-info {
        background: var(--gray-50);
        padding: 1rem;
        border-radius: var(--radius);
        margin: 1rem 0;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: var(--gray-700);
    }
</style>

<div class="reservations-container">
    <a href="{{ route('my-books') }}" class="back-button">
        <i class="fas fa-arrow-left"></i>
        Retour à mes livres
    </a>

    <div class="page-header">
        <h1 class="welcome-message text-gradient">Réservations pour "{{ $book->title }}"</h1>
        <p class="text-lg text-gray-600">Gérez les demandes de réservation pour votre livre</p>
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

    <div class="book-info-card">
        <h3 class="font-semibold text-lg mb-2">{{ $book->title }}</h3>
        <p class="text-gray-600 mb-2">{{ $book->description }}</p>
        <div class="flex gap-4 text-sm text-gray-600">
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
    </div>

    <div class="reservations-list">
        @forelse($reservations as $reservation)
            <div class="reservation-card reservation-{{ $reservation->status }}">
                <div class="reservation-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ substr($reservation->user->name, 0, 1) }}
                        </div>
                        <div class="user-details">
                            <h4>{{ $reservation->user->name }}</h4>
                            <p>{{ $reservation->user->email }}</p>
                        </div>
                    </div>
                    <span class="status-badge status-{{ $reservation->status }}">
                        @if($reservation->status == 'pending')
                            En attente
                        @elseif($reservation->status == 'accepted')
                            Acceptée
                        @elseif($reservation->status == 'rejected')
                            Refusée
                        @else
                            Terminée
                        @endif
                    </span>
                </div>

                <div class="reservation-meta">
                    <div>Demandé le : {{ $reservation->created_at->format('d/m/Y à H:i') }}</div>
                    @if($reservation->accepted_at)
                        <div>Accepté le : {{ $reservation->accepted_at->format('d/m/Y à H:i') }}</div>
                    @endif
                    @if($reservation->message)
                        <div class="mt-2">
                            <strong>Message :</strong> {{ $reservation->message }}
                        </div>
                    @endif
                </div>

                @if($reservation->status == 'accepted' || $reservation->status == 'completed')
                    <div class="contact-info">
                        <h5 class="font-semibold mb-2">Coordonnées de l'emprunteur :</h5>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $reservation->user->email }}</span>
                        </div>
                        @if($reservation->user->phone)
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $reservation->user->phone }}</span>
                            </div>
                        @endif
                    </div>
                @endif

                <div class="action-buttons">
                    @if($reservation->status == 'pending')
                        <form action="{{ route('reservations.update-status', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="btn btn-success" onclick="return confirm('Accepter cette réservation ? Cela refusera automatiquement les autres demandes.')">
                                <i class="fas fa-check mr-1"></i>
                                Accepter
                            </button>
                        </form>
                        <form action="{{ route('reservations.update-status', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Refuser cette réservation ?')">
                                <i class="fas fa-times mr-1"></i>
                                Refuser
                            </button>
                        </form>
                    @elseif($reservation->status == 'accepted')
                        <form action="{{ route('reservations.update-status', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn btn-info" onclick="return confirm('Marquer cet échange comme terminé ?')">
                                <i class="fas fa-check-double mr-1"></i>
                                Échange terminé
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-handshake"></i>
                <h3>Aucune réservation</h3>
                <p>Aucune demande de réservation pour ce livre pour le moment.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection