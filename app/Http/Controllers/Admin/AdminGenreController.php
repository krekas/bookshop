<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminGenreController extends Controller
{
    public function index()
    {
        return view('admin.genres.index', [
            'genres' => Genre::paginate(20)
        ]);
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genre::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.genres.index')->with('success', 'Genre created.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->update($validate);

        return redirect()->route('admin.genres.index')->with('success', 'Genre updated.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'Genre deleted.');
    }
}
