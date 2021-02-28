<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">

            @unless($book->approved)
                <div class="bg-blue-100 p-5 w-full border-l-4 mx-auto border-blue-500 mb-4">
                    <div class="flex space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             class="flex-none fill-current text-blue-500 h-4 w-4">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/>
                        </svg>
                        <div class="flex-1 leading-tight text-sm text-blue-700">This book still needs to be approved
                        </div>
                    </div>
                </div>
            @endunless

            <x-alert/>

            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="{{ $book->name }}" class="lg:w-1/3 w-full h-96 object-cover object-center rounded"
                     src="{{ asset($book->cover->getUrl('cover')) }}">
                <div class="lg:w-2/3 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <div class="flex justify-between items-center border-solid border-b-2 border-light-blue-500">
                        <h1 class="text-gray-900 text-3xl title-font font-medium tracking-widest mb-1">{{ $book->name }}</h1>
                        <div>
                            @admin
                                <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="inline-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-transparent text-red-400 hover:text-red-600 p-0 ml-2 border-none text-sm">
                                        Remove
                                    </button>
                                </form>
                            @endadmin
                            @auth
                                <a href="{{ route('books.report.create', $book) }}" class="bg-transparent hover:bg-red-400 text-red-400 font-semibold hover:text-white text-xs py-1 px-4 border border-red-400 hover:border-transparent rounded">
                                    Report
                                </a>
                            @endauth
                        </div>
                    </div>

                    <div class="flex items-center md:flex-row flex-col mb-4">
                        <div class="flex flex-col md:pr-10 md:mb-0 mb-1 pr-0 w-full md:w-auto">
                            <h2 class="text-indigo-400 font-medium title-font">
                                @foreach ($book->authors as $author)
                                    {{ $author->name }}@if( !$loop->last),@endif
                                @endforeach
                            </h2>
                            <h4 class="text-sm text-gray-400">
                                @foreach ($book->genres as $genre)
                                    {{ $genre->name }}
                                    @if( !$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </h4>
                        </div>

                        <div class="flex md:ml-auto md:mr-0 mx-auto items-center flex-shrink-0 space-x-4">
                            <livewire:rating :bookId="$book->id" />

                            <livewire:reviews-count :bookId="$book->id" />
                        </div>
                    </div>

                    <p class="leading-relaxed mb-4">{{ e($book->description) }}</p>

                    <div class="flex">
                        <div class="flex flex-row items-center">
                            <div class="@if ($book->discount) text-md line-through @else text-2xl @endif mr-1">
                                {{ $book->price }}&euro;
                            </div>
                            @if ($book->discount)
                                <div class="text-red-600 font-medium text-2xl">{{ $book->discount_price }}&euro;
                                </div>@endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reviews --}}
            <livewire:reviews :bookId="$book->id" />

        </div>
    </section>
</x-app-layout>
