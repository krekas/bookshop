<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEditAuthorRequest;
use App\Models\Author;

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

    public function store(CreateEditAuthorRequest $request)
    {
        Author::create($request->validated());

        return redirect()->route('admin.authors.index')->with('success', 'Author created.');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(CreateEditAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return redirect()->route('admin.authors.index')->with('success', 'Author updated.');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('admin.authors.index')->with('success', 'Author deleted.');
    }
}
