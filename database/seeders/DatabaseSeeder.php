<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            AuthorsSeeder::class,
            GenresSeeder::class
        ]);

        $genres = Genre::all()->random(rand(1, 3))->pluck('id');
        $authors = Author::all()->random(rand(1, 3))->pluck('id');

        Book::factory(55)->create()->each(
            function ($book) use ($genres, $authors) {
                $book->genres()->attach($genres);

                $book->authors()->attach($authors);
            }
        );
    }
}
