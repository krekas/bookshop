<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBooksController extends Controller
{
    public function index()
    {
        return view('admin.books.index', [
            'books' => Book::approved()->with('authors', 'genres')->paginate(20)
        ]);
    }
}
