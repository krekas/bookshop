<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;

class AdminBooksController extends Controller
{
    public function index()
    {
        return view('admin.books.index', [
            'books' => Book::latest()->with('authors', 'genres')->paginate()
        ]);
    }

    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();

        return view('admin.books.create', compact('genres', 'authors'));
    }

    public function store(CreateBookRequest $request)
    {
        $book = auth()->user()->books()->create($request->validated());

        $book->genres()->attach($request->genre);
        $book->authors()->attach($request->authors);

        return redirect()->route('admin.books.index')->with('success', 'Book created.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted.');
    }

    public function approveBook(Book $book)
    {
        $book->update(['approved' => 1]);
        
        return redirect()->route('admin.books.index')->with('success', 'Book approved.');
    }
}
