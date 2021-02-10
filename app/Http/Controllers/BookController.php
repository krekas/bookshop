<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function authors()
        {
            return $this->belongsToMany(Author::class);
        }
    }
}
