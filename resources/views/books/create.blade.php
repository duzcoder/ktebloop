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

    /* Form Styles */
    .book-form-container {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 2.5rem;
        box-shadow: var(--shadow);
    }

    .form-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--gray-200);
    }

    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .form-title {
        font-size: 1.5rem;
        color: var(--secondary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-title-icon {
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

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--gray-700);
    }

    .form-input, .form-textarea, .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-input:focus, .form-textarea:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 184, 35, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-help {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: var(--gray-500);
    }

    .form-error {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #e53e3e;
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

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }

    /* Image Preview */
    .image-preview {
        width: 200px;
        height: 200px;
        border: 2px dashed var(--gray-300);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 1rem;
        overflow: hidden;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview-placeholder {
        text-align: center;
        color: var(--gray-400);
    }

    .image-preview-placeholder i {
        font-size: 3rem;
        margin-bottom: 0.5rem;
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
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .dashboard-container {
            padding: 1rem;
        }
        
        .book-form-container {
            padding: 1.5rem;
        }
        
        .form-actions {
            flex-direction: column;
        }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="welcome-message text-gradient">Ajouter un Livre 📖</h1>
        <p class="text-lg text-gray-600">Partagez un nouveau livre avec la communauté Ktebloop</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="dashboard-layout">
        <!-- nav -->
        <div class="sidebar">
            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <div class="sidebar-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    Navigation
                </h3>
                <div class="navigation-links">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline btn-full" style="margin-bottom: 1rem; justify-content: flex-start;">
                        <i class="fas fa-home mr-2"></i>
                        Tableau de bord
                    </a>
                    <a href="{{ route('my-books') }}" class="btn btn-outline btn-full" style="margin-bottom: 1rem; justify-content: flex-start;">
                        <i class="fas fa-book-open mr-2"></i>
                        Mes livres
                    </a>
                    <a href="{{ route('my-reservations') }}" class="btn btn-outline btn-full" style="margin-bottom: 1rem; justify-content: flex-start;">
                        <i class="fas fa-handshake mr-2"></i>
                        Mes réservations
                    </a>
                    <a href="{{ route('books.create') }}" class="btn btn-primary btn-full" style="justify-content: flex-start;">
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter un livre
                    </a>
                </div>
            </div>

            <div class="sidebar-section">
                <h3 class="sidebar-title">
                    <div class="sidebar-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    Conseils
                </h3>
                <div class="tips">
                    <p class="text-sm text-gray-600 mb-2">📚 Choisissez une catégorie précise</p>
                    <p class="text-sm text-gray-600 mb-2">🖼️ Ajoutez une image de qualité</p>
                    <p class="text-sm text-gray-600 mb-2">✍️ Rédigez une description claire</p>
                    <p class="text-sm text-gray-600">🔍 Vérifiez les informations avant de publier</p>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="book-form-container">
                <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-section">
                        <h2 class="form-title">
                            <div class="form-title-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            Informations du livre
                        </h2>
                        
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label class="form-label" for="title">Titre du livre *</label>
                                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="category">Catégorie *</label>
                                <select id="category" name="category" class="form-select" required>
                                    <option value="">Choisir une catégorie</option>
                                    <option value="Roman" {{ old('category') == 'Roman' ? 'selected' : '' }}>Roman</option>
                                    <option value="Science-Fiction" {{ old('category') == 'Science-Fiction' ? 'selected' : '' }}>Science-Fiction</option>
                                    <option value="Fantasy" {{ old('category') == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                                    <option value="Mystère" {{ old('category') == 'Mystère' ? 'selected' : '' }}>Mystère</option>
                                    <option value="Biographie" {{ old('category') == 'Biographie' ? 'selected' : '' }}>Biographie</option>
                                    <option value="Histoire" {{ old('category') == 'Histoire' ? 'selected' : '' }}>Histoire</option>
                                    <option value="Développement personnel" {{ old('category') == 'Développement personnel' ? 'selected' : '' }}>Développement personnel</option>
                                    <option value="Cuisine" {{ old('category') == 'Cuisine' ? 'selected' : '' }}>Cuisine</option>
                                    <option value="Voyage" {{ old('category') == 'Voyage' ? 'selected' : '' }}>Voyage</option>
                                </select>
                                @error('category')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group full-width">
                                <label class="form-label" for="description">Description *</label>
                                <textarea id="description" name="description" class="form-textarea" placeholder="Décrivez le livre, son état, son contenu..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                                <span class="form-help">Décrivez l'état du livre et son contenu pour aider les autres membres.</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image -->
                    <div class="form-section">
                        <h2 class="form-title">
                            <div class="form-title-icon">
                                <i class="fas fa-image"></i>
                            </div>
                            Image du livre
                        </h2>
                        
                        <div class="form-group">
                            <label class="form-label" for="image">Image du livre</label>
                            <input type="file" id="image" name="image" class="form-input" accept="image/*">
                            @error('image')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                            <span class="form-help">Formats acceptés: JPG, PNG, GIF. Taille max: 2MB.</span>
                        </div>
                        
                        <div class="image-preview" id="imagePreview">
                            <div class="image-preview-placeholder">
                                <i class="fas fa-book"></i>
                                <p>Aperçu de l'image</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline">
                            <i class="fas fa-times mr-2"></i>
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter le livre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.innerHTML = '';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    imagePreview.appendChild(img);
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection