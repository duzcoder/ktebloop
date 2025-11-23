<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request, Book $book)
    {
        if ($book->status !== 'available') {
            return redirect()->back()->with('error', 'Ce livre n\'est pas disponible pour la réservation.');
        }

        if ($book->user_id === Auth::id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas réserver votre propre livre.');
        }

        $existingReservation = Reservation::where('book_id', $book->id)
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'accepted'])
            ->first();

        if ($existingReservation) {
            return redirect()->back()->with('error', 'Vous avez déjà une réservation en cours pour ce livre.');
        }

        // Create reservation
        Reservation::create([
            'book_id' => $book->id,
            'user_id' => Auth::id(),
            'owner_id' => $book->user_id,
            'status' => 'pending',
            'message' => $request->message,
        ]);

        return redirect()->route('my-reservations')->with('success', 'Réservation effectuée avec succès! En attente de confirmation du propriétaire.');
    }

    public function myReservations()
    {
        $reservations = Reservation::with(['book', 'owner'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my-reservations', compact('reservations'));
    }

    public function bookReservations(Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            return redirect()->route('my-books')->with('error', 'Accès non autorisé.');
        }

        $reservations = Reservation::with(['user', 'book'])
            ->where('book_id', $book->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('book-reservations', compact('book', 'reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        if ($reservation->owner_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected,completed'
        ]);

        $oldStatus = $reservation->status;
        $newStatus = $request->status;

        $reservation->update([
            'status' => $newStatus,
            'accepted_at' => $newStatus === 'accepted' ? now() : $reservation->accepted_at,
            'completed_at' => $newStatus === 'completed' ? now() : $reservation->completed_at,
        ]);

        if ($newStatus === 'accepted') {
            $reservation->book->update(['status' => 'reserved']);
            
            Reservation::where('book_id', $reservation->book_id)
                ->where('id', '!=', $reservation->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

        } elseif ($newStatus === 'rejected' && $oldStatus === 'accepted') {
            $reservation->book->update(['status' => 'available']);
        } elseif ($newStatus === 'completed') {
            $reservation->book->update(['status' => 'taken']);
        }

        $statusMessages = [
            'accepted' => 'Réservation acceptée! Les autres demandes ont été refusées automatiquement.',
            'rejected' => 'Réservation refusée.',
            'completed' => 'Échange marqué comme terminé.'
        ];

        return redirect()->back()->with('success', $statusMessages[$newStatus]);
    }
}