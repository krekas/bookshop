<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;

class BookController extends Controller
{
    public function show(Book $book)
    {
        // dd($book);
        $reviews = Review::with('users')->latest()->whereBookId($book->id)->get();

        return view('front.book.show', compact('book', 'reviews'));
    }

    public function create()
    {
        $genres = Genre::all();

        return view('front.book.create', compact('genres'));
    }

    public function store(CreateBookRequest $request)
    {
        $authors = explode(',', $request->authors);

        $book = auth()->user()->books()->create($request->validated());

        $book->genres()->attach($request->genre);
        
        foreach ($authors as $authorName) {
            $author = Author::updateOrCreate(['name' => $authorName]);
            $book->authors()->attach($author);
        }

        return redirect()->route('books.show', $book)->with('success', 'Book created.');
    }
}
