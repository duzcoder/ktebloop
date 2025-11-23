<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $books = Book::with('user')
            ->where('user_id', '!=', Auth::id())
            ->where('status', 'available')
            ->latest()
            ->get();

        return view('dashboard', compact('books'));
    }

    public function myBooks()
    {
        $books = Book::where('user_id', Auth::id())->with('user')->get();
        
        $pendingReservations = Reservation::whereHas('book', function($query) {
            $query->where('user_id', Auth::id());
        })->where('status', 'pending')->with('user', 'book')->get();

        return view('my-books', compact('books', 'pendingReservations'));
    }

    public function myReservations()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('book.user')
            ->get();
        
        return view('my-reservations', compact('reservations'));
    }
}