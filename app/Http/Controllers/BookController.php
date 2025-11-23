<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('user')
            ->where('status', 'available')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        $book->load('user');
        return view('books.show', compact('book'));
    }

    public function myBooks()
    {
        $books = Book::withCount(['reservations', 'pendingReservations'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my-books', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('book-images', 'public');
            $validated['image'] = $imagePath;
        }

        $book = Book::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'image' => $validated['image'] ?? null,
            'user_id' => Auth::id(),
            'status' => 'available',
        ]);

        return redirect()->route('my-books')->with('success', 'Livre ajouté avec succès!');
    }

    public function edit(Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            return redirect()->route('my-books')->with('error', 'Accès non autorisé.');
        }

        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            return redirect()->route('my-books')->with('error', 'Action non autorisée.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'status' => 'required|in:available,reserved,taken',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            
            $imagePath = $request->file('image')->store('book-images', 'public');
            $validated['image'] = $imagePath;
        } else {
            $validated['image'] = $book->image;
        }

        $book->update($validated);

        return redirect()->route('my-books')->with('success', 'Livre modifié avec succès!');
    }

    public function destroy(Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            return redirect()->route('my-books')->with('error', 'Action non autorisée.');
        }

        $activeReservations = $book->reservations()
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($activeReservations) {
            return redirect()->route('my-books')->with('error', 'Impossible de supprimer ce livre car il a des réservations en cours.');
        }

        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('my-books')->with('success', 'Livre supprimé avec succès!');
    }
}