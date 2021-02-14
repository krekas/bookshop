<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEditGenreRequest;
use App\Models\Genre;

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

    public function store(CreateEditGenreRequest $request)
    {
        Genre::create($request->validated());

        return redirect()->route('admin.genres.index')->with('success', 'Genre created.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(CreateEditGenreRequest $request, Genre $genre)
    {
        $genre->update($request->validated());

        return redirect()->route('admin.genres.index')->with('success', 'Genre updated.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'Genre deleted.');
    }
}
