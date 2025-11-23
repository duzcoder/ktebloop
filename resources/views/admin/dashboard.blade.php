@extends('layouts.app')

@section('content')
<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow);
        text-align: center;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--gray-600);
        font-size: 1rem;
    }
</style>

<div class="admin-container">
    <div class="page-header">
        <h1 class="welcome-message text-gradient">Tableau de Bord Administrateur</h1>
        <p class="text-lg text-gray-600">Vue d'ensemble du système</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Utilisateurs Totaux</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_books'] }}</div>
            <div class="stat-label">Livres Totaux</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_admins'] }}</div>
            <div class="stat-label">Administrateurs</div>
        </div>
    </div>

    <div class="quick-actions">
        <h2 class="text-2xl font-bold mb-4">Actions Rapides</h2>
        <div class="flex gap-4">
            <a href="{{ route('admin.users') }}" class="btn btn-primary">
                <i class="fas fa-users mr-2"></i>
                Gérer les Utilisateurs
            </a>
            <a href="{{ route('admin.books') }}" class="btn btn-outline">
                <i class="fas fa-book mr-2"></i>
                Voir les Livres
            </a>
        </div>
    </div>
</div>
@endsection