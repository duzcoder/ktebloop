@extends('layouts.app')

@section('content')
<style>
    .edit-book-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-header {
        text-align: center;
        margin-bottom: 2rem;
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
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 184, 35, 0.1);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .image-preview {
        margin-top: 1rem;
        text-align: center;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 200px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
    }

    .current-image {
        font-size: 0.875rem;
        color: var(--gray-600);
        margin-bottom: 0.5rem;
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

    .btn-danger {
        background: #EF4444;
        color: white;
    }

    .btn-danger:hover {
        background: #DC2626;
        transform: translateY(-2px);
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: space-between;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .action-group {
        display: flex;
        gap: 1rem;
    }
</style>

<div class="edit-book-container">
    <div class="page-header">
        <h1 class="welcome-message text-gradient">Modifier le Livre</h1>
        <p class="text-lg text-gray-600">Modifiez les informations de votre livre</p>
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

    <div class="form-container">
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="form-label">Titre du livre *</label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $book->title) }}" required>
                @error('title')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description *</label>
                <textarea id="description" name="description" class="form-textarea" required>{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Catégorie *</label>
                <select id="category" name="category" class="form-select" required>
                    <option value="">Sélectionnez une catégorie</option>
                    <option value="Roman" {{ old('category', $book->category) == 'Roman' ? 'selected' : '' }}>Roman</option>
                    <option value="Science-Fiction" {{ old('category', $book->category) == 'Science-Fiction' ? 'selected' : '' }}>Science-Fiction</option>
                    <option value="Fantasy" {{ old('category', $book->category) == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                    <option value="Mystère" {{ old('category', $book->category) == 'Mystère' ? 'selected' : '' }}>Mystère</option>
                    <option value="Biographie" {{ old('category', $book->category) == 'Biographie' ? 'selected' : '' }}>Biographie</option>
                    <option value="Histoire" {{ old('category', $book->category) == 'Histoire' ? 'selected' : '' }}>Histoire</option>
                    <option value="Développement personnel" {{ old('category', $book->category) == 'Développement personnel' ? 'selected' : '' }}>Développement personnel</option>
                    <option value="Cuisine" {{ old('category', $book->category) == 'Cuisine' ? 'selected' : '' }}>Cuisine</option>
                    <option value="Voyage" {{ old('category', $book->category) == 'Voyage' ? 'selected' : '' }}>Voyage</option>
                </select>
                @error('category')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Statut *</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>Disponible</option>
                    <option value="reserved" {{ old('status', $book->status) == 'reserved' ? 'selected' : '' }}>Réservé</option>
                    <option value="taken" {{ old('status', $book->status) == 'taken' ? 'selected' : '' }}>Pris</option>
                </select>
                @error('status')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Image du livre</label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                @error('image')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                
                @if($book->image)
                    <div class="image-preview">
                        <div class="current-image">Image actuelle :</div>
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                    </div>
                @endif
            </div>

            <div class="form-actions">
                <div class="action-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>
                        Mettre à jour
                    </button>
                    <a href="{{ route('my-books') }}" class="btn btn-outline">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour
                    </a>
                </div>
                
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash mr-2"></i>
                    Supprimer le livre
                </button>
            </div>
        </form>

        <form id="deleteForm" action="{{ route('books.destroy', $book->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
    function confirmDelete() {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce livre ? Cette action est irréversible.')) {
            document.getElementById('deleteForm').submit();
        }
    }

    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.querySelector('.image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.className = 'image-preview';
                    document.getElementById('image').parentNode.appendChild(preview);
                }
                preview.innerHTML = `
                    <div class="current-image">Nouvelle image :</div>
                    <img src="${e.target.result}" alt="Preview">
                `;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection