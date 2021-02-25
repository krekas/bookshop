<div class="container md:max-w-5xl w-full mx-auto mt-6">

    <div class="flex">
        <div class="sm:w-1/5 sm:block hidden"></div>
        <div class="sm:w-4/5 w-full mb-2">
            <h5
                class="text-gray-900 text-2xl title-font font-medium tracking-widest mb-1 border-solid border-b-2 border-light-blue-500">
                Reviews</h5>

            <form action="#" method="POST" wire:submit.prevent="submitReview" >
                @csrf
                <textarea name="review" id="review" cols="30" rows="3"
                    wire:model="review"
                    class="@error('review')border border-red-500 @enderror w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    @guest disabled @endguest>{{ old('review') }}@guest Login to leave a review @endguest
                            </textarea>
                <div class="flex justify-between mt-2">
                    @auth
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
                    @endauth
                </div>
            </form>

        </div>
    </div>

    @foreach ($reviews as $review)
        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg flex flex-wrap p-2 mb-4">
            <div class="sm:w-1/5 w-full font-semibold">
                {{ $review['user']['name'] }}
            </div>
            <div class="sm:w-4/5 w-full sm:border-l-2 sm:border-solid sm:border-gray-200 sm:pl-2">
                {!! nl2br($review['review']) !!}
            </div>
        </div>
    @endforeach
</div>
