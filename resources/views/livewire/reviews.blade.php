<div class="container md:max-w-5xl w-full mx-auto mt-6">

    <div class="flex">
        <div class="sm:w-1/5 sm:block hidden"></div>
        <div class="sm:w-4/5 w-full mb-2">
            <h5
                class="text-gray-900 text-2xl title-font font-medium tracking-widest mb-1 border-solid border-b-2 border-light-blue-500">
                Reviews</h5>

            @guest
                <div class="bg-blue-100 p-5 w-full border-l-4 mx-auto border-blue-500 mb-4">
                    <div class="flex space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="flex-none fill-current text-blue-500 h-4 w-4">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/>
                        </svg>
                        <div class="flex-1 leading-tight text-sm text-blue-700"><a href="{{  route('login') }}">Login</a> or <a href="{{ route('register') }}">register</a> to leave a review.
                        </div>
                    </div>
                </div>
            @else
            <form action="#" method="POST" wire:submit.prevent="submitReview" >
                @csrf
                <textarea name="review" id="review" cols="30" rows="3"
                    wire:model="review"
                    class="@error('review')border border-red-500 @enderror w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    @guest disabled @endguest>{{ old('review') }}
                            </textarea>
                <div class="flex justify-between mt-2">
                        <div class="flex items-center">
                            <input type="radio" name="rating" id="1" value="1" wire:model="rating"
                                class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">1</span>
                            <input type="radio" name="rating" id="2" value="2" wire:model="rating"
                                class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">2</span>
                            <input type="radio" name="rating" id="3" value="3" wire:model="rating"
                                class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">3</span>
                            <input type="radio" name="rating" id="4" value="4" wire:model="rating"
                                class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">4</span>
                            <input type="radio" name="rating" id="5" value="5" wire:model="rating"
                                class="form-radio h-4 w-4 text-blue-600 mr-1"><span class="mr-2">5</span>
                        </div>

                        <x-button>
                            {{ __('Submit review') }}
                        </x-button>
                </div>
            </form>
            @endguest

        </div>
    </div>

    <section id="reviews">
        @foreach ($reviews as $review)
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg flex flex-wrap p-2 mb-4">
                <div class="sm:w-1/5 w-full font-semibold">
                    {{ $review->user->name }}
                </div>
                <div class="sm:w-4/5 w-full sm:border-l-2 sm:border-solid sm:border-gray-200 sm:pl-2">
                    {!! nl2br($review->review) !!}
                </div>
            </div>
        @endforeach
        
        @if($reviews->count() < $reviewsCount)
            <div class="text-center mb-6">
                <a href="#reviews" wire:click="load" class="bg-transparent hover:bg-blue-400 text-blue-400 font-semibold hover:text-white py-1 px-4 border border-blue-400 hover:border-transparent rounded">Load more...</a>
            </div>
        @endif
    </section>
</div>
