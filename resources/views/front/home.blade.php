<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">
            <div class="flex flex-wrap -m-4 mb-4">
                @foreach ($books as $book)
                    <div class="xl:w-1/5 md:w-1/2 w-full p-4 relative">
                        @if ($book->is_new)
                            <div class="text-xs px-3 bg-green-200 text-green-800 rounded-full uppercase absolute -ml-4 mt-2 p-1">
                                New
                            </div>
                        @endif

                        @if ($book->discount)
                            <div class="text-xs px-3 bg-red-200 text-red-700 font-semibold rounded-full absolute -ml-4 mt-10 p-1">
                                -{{ $book->discount }}%
                            </div>
                        @endif

                        <a href="{{ route('books.show', $book) }}">
                            <div class="border-solid border border-gray-200 rounded-lg">
                                <img class="h-56 rounded-tl rounded-tr w-full object-cover object-center"
                                     src="{{ asset($book->cover->getUrl('cover')) }}" alt="content">
                                <div class="m-2">
                                    <p class="text-xs">
                                        @foreach ($book->authors as $author)
                                            {{ $author->name }}@if( !$loop->last), @endif
                                        @endforeach
                                    </p>
                                    <h1 class="text-lg text-gray-800 font-medium">{{ $book->name }}</h1>

                                    <div class="flex flex-row items-center">
                                        <div class="@if ($book->discount) text-xs line-through @endif mr-1">
                                            @money($book->price)
                                        </div>
                                        @if ($book->discount)
                                            <div class="text-red-600 text-lg">@money($book->discount_price)</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mb-4">
                {{ $books->links() }}
            </div>

        </div>
    </section>
</x-app-layout>
