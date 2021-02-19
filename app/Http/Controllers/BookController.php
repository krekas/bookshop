<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = auth()->user()->books()->latest()->paginate();

        return view('front.user.books.list', compact('books'));
    }

    public function show(Book $book)
    {
        $reviews = Review::with('users')->latest()->whereBookId($book->id)->get();

        $rating = collect($reviews)->avg('rating');

        return view('front.book.show', compact('book', 'reviews', 'rating'));
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

        $book->attachCover($request->file('cover'));

        $book->genres()->attach($request->genre);

        foreach ($authors as $authorName) {
            $author = Author::updateOrCreate(['name' => $authorName]);
            $book->authors()->attach($author);
        }

        return redirect()->route('books.show', $book)->with('success', 'Book created.');
    }

    public function edit(Book $book)
    {
        abort_unless(auth()->user()->id == $book->user_id, 403);

        $book->load('genres');
        $authors = $book->authors()->pluck('name')->implode(',');

        $genres = Genre::all();

        return view('front.user.books.edit', compact('book', 'genres', 'authors'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        abort_unless(auth()->user()->id == $book->user_id, 403);

        $authors = explode(',', $request->authors);

        if ($request->file('cover')) {
            $book->media()->delete();

            $book->attachCover($request->file('cover'));
        }

        $book->update($request->validated());

        $book->genres()->sync($request->genre);

        $updatedAuthors = [];

        foreach ($authors as $authorName) {
            $author = Author::where('name', 'like', $authorName)->first();
            if ($author) {
                $updatedAuthors[] = $author->id;
            } else {
                $updatedAuthors[] = Author::create(['name' => $authorName])->id;
            }
        }

        $book->authors()->sync($updatedAuthors);

        return redirect()->route('books.show', $book)->with('success', 'Book updated.');
    }

    public function destroy(Book $book)
    {
        abort_unless(auth()->user()->id == $book->user_id, 403);

        $book->delete();

        return redirect()->route('user.books.list')->with('success', 'Book deleted.');
    }
}
