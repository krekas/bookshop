<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreReviewRequest;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Book $book)
    {
        auth()->user()->reviews()->create($request->validated());

        return redirect()->route('books.show', $book);
    }
}
