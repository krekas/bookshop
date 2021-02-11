<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminBooksController extends Controller
{
    public function index()
    {
        return view('admin.books.index', [
            'books' => Book::latest()->with('authors', 'genres')->paginate(20)
        ]);
    }

    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();

        return view('admin.books.create', compact('genres', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'genre' => 'required',
            'author' => 'required'
        ]);

        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'slug' => 'test'
        ]);

        $book->genres()->sync($request->genre);
        $book->authors()->sync($request->author);

        return redirect()->route('admin.books.index')->with('success', 'Book created.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted.');
    }
}
