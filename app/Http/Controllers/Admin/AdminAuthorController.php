<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AdminAuthorController extends Controller
{
    public function index()
    {
        return view('admin.authors.index', [
            'authors' => Author::paginate(20)
        ]);
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Author::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.authors.index')->with('success', 'Author created.');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author->update($validate);

        return redirect()->route('admin.authors.index')->with('success', 'Author updated.');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('admin.authors.index')->with('success', 'Author deleted.');
    }
}
