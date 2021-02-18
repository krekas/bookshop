@component('mail::message')
# {{ $book->name }} report

{{ $report }}

@component('mail::button', ['url' => route('books.show', $book)])
View Book
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
