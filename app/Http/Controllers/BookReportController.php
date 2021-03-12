<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReportRequest;
use App\Mail\ReportBook;
use App\Models\Book;
use App\Models\User;
use App\Notifications\SendReportNotification;use Illuminate\Support\Facades\Mail;use Illuminate\Support\Facades\Notification;

class BookReportController extends Controller
{
    public function create(Book $book)
    {
        return view('front.book.report.create', compact('book'));
    }

    public function store(CreateReportRequest $request, Book $book)
    {
        $admins = User::where('admin', true)->get();

        Notification::send($admins, new SendReportNotification($request->report, $book));

        return redirect()->route('books.show', $book)->with('success', 'Report sent successfully.');
    }
}
