<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __invoke()
    {
        $books = Book::count();
        $approved = Book::approved()->count();
        $unapproved = Book::unapproved()->count();
        $users = User::count();

        return view('admin.index', compact('books', 'approved', 'unapproved', 'users'));
    }
}
