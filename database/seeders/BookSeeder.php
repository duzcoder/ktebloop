<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $books = [
            [
                'title' => 'Le Petit Prince',
                'description' => 'Un livre magnifique sur les rencontres extraordinaires.',
                'category' => 'Littérature',
                'user_id' => $users->first()->id,
            ],
            [
                'title' => 'Harry Potter à l\'école des sorciers',
                'description' => 'Premier tome de la saga Harry Potter.',
                'category' => 'Fantasy',
                'user_id' => $users->get(1)->id,
            ],
            [
                'title' => 'L\'Étranger',
                'description' => 'Roman philosophique de Albert Camus.',
                'category' => 'Littérature',
                'user_id' => $users->get(2)->id,
            ],
            [
                'title' => '1984',
                'description' => 'Dystopie classique de George Orwell.',
                'category' => 'Science-Fiction',
                'user_id' => $users->first()->id,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}