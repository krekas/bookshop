<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(Book $book)
    {
        return view('front.book.show', compact('book'));
    }

    public function create()
    {
        $genres = Genre::all();

        return view('front.book.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'genre' => 'required|array',
            'authors' => 'required'
        ]);

        $authors = explode(',', $request->authors);

        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);

        $book->genres()->attach($request->genre);
        
        foreach ($authors as $authorName) {
            $author = Author::updateOrCreate(['name' => $authorName]);
            $book->authors()->attach($author);
        }

        return redirect()->route('books.show', $book)->with('success', 'Book created.');
    }
}
