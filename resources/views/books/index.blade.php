@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Catalogue des Livres</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($books as $book)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($book->image)
                <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-book text-gray-400 text-4xl"></i>
                </div>
            @endif
            <div class="p-4">
                <h3 class="text-xl font-semibold mb-2">{{ $book->title }}</h3>
                <p class="text-gray-600 mb-2">Par: {{ $book->user->name }}</p>
                <p class="text-gray-500 text-sm mb-4">{{ Str::limit($book->description, 100) }}</p>
                <div class="flex justify-between items-center">
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                        {{ $book->category }}
                    </span>
                    <a href="{{ route('books.show', $book) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Voir détails
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection