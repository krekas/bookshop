<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReportRequest;
use App\Mail\ReportBook;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class BookReportController extends Controller
{
    public function create(Book $book)
    {
        return view('front.book.report.create', compact('book'));
    }

    public function store(CreateReportRequest $request, Book $book)
    {
        $adminMail = User::firstWhere('admin', true)->email;

        Mail::to($adminMail)
            ->send(new ReportBook($request->report, $book));

        return redirect()->route('books.show', $book)->with('success', 'Report sent successfully.');
    }
}
