<x-app-layout>
    <section class="text-gray-700 body-font">
        <div class="container max-w-7xl px-8 pb-4 mx-auto lg:px-4">
            <div class="flex flex-wrap text-left">
            @foreach ($books as $book)
                <div class="px-8 py-6 lg:w-1/5 md:w-full">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-12 h-12 mb-5 text-blue-800 bg-gray-200 rounded-full">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M21 3a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h18zM11 13H4v6h7v-6zm9 0h-7v6h7v-6zm-9-8H4v6h7V5zm9 0h-7v6h7V5z" />
                        </svg>
                    </div>
                    <h2 class="mb-2 text-base font-medium text-gray-700 title-font">{{ $book->name }}</h2>
                    <p class="mb-4 text-sm leading-relaxed">By 
                        @foreach ($book->authors as $author)
                            {{ $author->name }}
                        @endforeach
                    </p>
                    {{-- <a href="#" class="inline-flex items-center font-semibold text-blue-700 md:mb-2 lg:mb-0 hover:text-blue-400 ">
                        Learn More
                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" />
                        </svg>
                    </a> --}}
                </div>
            @endforeach
            </div>

            {{ $books->links() }}
        </div>
    </section>
</x-app-layout>