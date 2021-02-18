<?php

namespace App\Mail;

use App\Http\Requests\CreateReportRequest;
use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportBook extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param $report
     * @param Book $book
     */
    public function __construct($report, Book $book)
    {
        $this->report = $report;
        $this->book = $book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(auth()->user()->email)
            ->replyTo(auth()->user()->email)
            ->markdown('emails.books.report', [
                'report' => $this->report,
                'book' => $this->book
            ]);
    }
}
