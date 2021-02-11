<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __invoke(Book $book)
    {
        return view('front.book.show', compact('book'));
    }
}
