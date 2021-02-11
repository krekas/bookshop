<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">
          <div class="flex flex-wrap -m-4">
            @foreach ($books as $book)
            <div class="xl:w-1/5 md:w-1/2 p-4">
                <a href="{{ route('book.show', $book->id) }}">
                    <div class="bg-gray-200 p-6 rounded-lg">
                        <img class="h-40 rounded w-full object-cover object-center mb-3" src="https://dummyimage.com/120x720" alt="content">
                        <h1 class="text-lg text-gray-900 font-medium title-font mb-1">{{ $book->name }}</h1>
                        <p class="leading-relaxed text-base">By 
                        @foreach ($book->authors as $author)
                            {{ $author->name }}
                            @if( !$loop->last)
                            ,
                            @endif
                        @endforeach
                        </p>
                    </div>
                </a>
            </div>
            @endforeach
          </div>

          {{ $books->links() }}

        </div>
      </section>
</x-app-layout>