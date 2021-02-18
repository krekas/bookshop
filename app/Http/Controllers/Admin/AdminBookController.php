<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;

class AdminBookController extends Controller
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

        $this->uploadImage($request->file('cover'), $book);

        $book->genres()->attach($request->genre);
        $book->authors()->attach($request->authors);

        return redirect()->route('admin.books.index')->with('success', 'Book created.');
    }

    public function edit(Book $book)
    {
        $book->load('authors', 'genres');

        $authors = Author::all();
        $genres = Genre::all();

        return view('admin.books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        if ($request->file('cover')) {
            $book->media()->delete();

            $this->uploadImage($request->file('cover'), $book);
        }

        $book->update($request->validated());

        $book->genres()->sync($request->genre);
        $book->authors()->sync($request->authors);

        return redirect()->route('admin.books.index')->with('success', 'Book updated.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted.');
    }

    public function approveBook(Book $book)
    {
        $book->approve();

        return redirect()->route('admin.books.index')->with('success', 'Book approved.');
    }

    private function uploadImage($file, $book)
    {
        $book->addMedia($file)->toMediaCollection('covers');
    }
}
