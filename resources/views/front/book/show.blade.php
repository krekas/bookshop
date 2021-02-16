<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">

          @unless($book->approved)
          <div class="bg-blue-100 p-5 w-4/5 border-l-4 mx-auto border-blue-500 mb-4">
              <div class="flex space-x-3">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                      class="flex-none fill-current text-blue-500 h-4 w-4">
                      <path
                          d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z" />
                  </svg>
                  <div class="flex-1 leading-tight text-sm text-blue-700">This book still needs to be approved</div>
              </div>
          </div>
          @endunless

              <div class="lg:w-4/5 mx-auto flex flex-wrap">
                {{-- <img alt="ecommerce" class="lg:w-1/3 w-full h-64 object-cover object-center rounded" src="https://dummyimage.com/330x400"> --}}
                <img alt="{{ $book->name }}" class="lg:w-1/3 w-full h-64 object-cover object-center rounded" src="{{ asset('storage/covers/'.$book->cover) }}">
                <div class="lg:w-2/3 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-gray-900 text-3xl title-font font-medium tracking-widest mb-1 border-solid border-b-2 border-light-blue-500">{{ $book->name }}</h1>

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
                        <span class="flex items-center">
                          @for ($i=0; $i < 5; $i++)
                            @if ($i < $book->avg_rating)
                              <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                              </svg>
                            @else
                              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                              </svg>
                            @endif
                          @endfor
                            </span>
                          
                            <span class="text-gray-600 ml-3">{{ $reviews->count() }} Reviews</span>
                          </span>
                          
                    </div>
                </div>

                  <p class="leading-relaxed mb-4">{{ e($book->description) }}</p>
                  
                  <div class="flex">
                    <div class="flex flex-row items-center">
                      <div class="@if ($book->discount) text-md line-through @else text-2xl @endif mr-1">{{ $book->price }}&euro;</div>
                      @if ($book->discount)<div class="text-red-600 font-medium text-2xl">{{ $book->discount_price }}&euro;</div>@endif
                    </div>
                    <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Button</button>
                    <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                      <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>

              {{-- Reviews --}}

              <div class="container md:max-w-5xl w-full mx-auto mt-6">
                
                <div class="flex">
                  <div class="sm:w-1/5 sm:block hidden"></div>
                  <div class="sm:w-4/5 w-full mb-2">
                    <h5 class="text-gray-900 text-2xl title-font font-medium tracking-widest mb-1 border-solid border-b-2 border-light-blue-500">Reviews</h5>

                    <form action="{{ route('books.review.store', $book) }}" method="POST">
                      @csrf
                      <textarea name="review" id="review" cols="30" rows="3" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" @guest disabled @endguest>{{ old('review') }}@guest Login to leave a review @endguest</textarea>
                      <div class="flex justify-between">
                        @auth
                        <div class="flex items-center">
                          <input type="radio" name="rating" id="1" value="1" class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">1</span>
                          <input type="radio" name="rating" id="2" value="2" class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">2</span>
                          <input type="radio" name="rating" id="3" value="3" class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">3</span>
                          <input type="radio" name="rating" id="4" value="4" class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">4</span>
                          <input type="radio" name="rating" id="5" value="5" class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">5</span>
                        </div>
                        
                          <x-button>
                            {{ __('Submit review') }}
                          </x-button>
                        @endauth
                      </div>
                    </form>

                  </div>
                </div>

                @foreach ($reviews as $review)
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg flex flex-wrap p-2 mb-4">
                  <div class="sm:w-1/5 w-full font-semibold">
                    {{ $review->users->name }}
                  </div>
                  <div class="sm:w-4/5 w-full sm:border-l-2 sm:border-solid sm:border-gray-200 sm:pl-2">
                    {!! nl2br($review->review) !!}
                  </div>
                </div>
                @endforeach
              </div>

        </div>
      </section>
</x-app-layout>