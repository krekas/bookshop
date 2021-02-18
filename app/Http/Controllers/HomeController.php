<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    // paieska pagal Povilo video ir Deivido stream
    public function __invoke()
    {
        $search = request('search');

        $books = Book::with('authors', 'media')
            ->when(request('search'), function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('authors', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->latest()
            ->approved()
            ->simplePaginate();

        return view('front.home', compact('books'));
    }
}
