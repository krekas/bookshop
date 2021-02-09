<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() {
        return view('front.home', [
            'books' => Book::approved()->simplePaginate(25)
        ]);
    }
}
