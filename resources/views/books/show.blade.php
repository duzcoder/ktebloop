@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/3">
                @if($book->image)
                    <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-book text-gray-400 text-6xl"></i>
                    </div>
                @endif
            </div>
            <div class="md:w-2/3 p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $book->title }}</h1>
                <p class="text-gray-600 mb-2"><strong>Propriétaire:</strong> {{ $book->user->name }}</p>
                <p class="text-gray-600 mb-2"><strong>Catégorie:</strong> {{ $book->category }}</p>
                <p class="text-gray-600 mb-4"><strong>Statut:</strong> 
                    <span class="px-2 py-1 rounded text-sm 
                        {{ $book->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $book->status === 'available' ? 'Disponible' : 'Indisponible' }}
                    </span>
                </p>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Description:</h3>
                    <p class="text-gray-700">{{ $book->description }}</p>
                </div>
                
                @auth
                    @if($book->status === 'available' && $book->user_id !== Auth::id())
                        <form action="{{ route('reservations.store', $book) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                                Réserver ce livre
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                        Connectez-vous pour réserver
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection