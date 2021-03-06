<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        request()->headers->set('Accept', 'application/json');
    }

    public function index()
    {
        $books = Book::with('authors', 'genres', 'media')
            ->approved()
            ->latest()
            ->simplePaginate();

        return BookResource::collection($books);
    }

    public function show(Book $book)
    {
        $book->load('authors', 'genres', 'media');

        return new BookResource($book);
    }
}
