<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                    <form method="POST" action="{{ route('user.books.update', $book) }}" class="sm:w-4/6 w-full" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <x-label for="name" :value="__('Name*')"/>

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$book->name"
                                     required autofocus/>
                        </div>

                        <div class="flex justify-between">
                            <div class="mb-2 flex-1 mr-2">
                                <x-label for="price" :value="__('Price*')"/>

                                <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                                         :value="$book->price" min="1" step="0.01" required/>
                            </div>

                            <div class="mb-2 flex-1 ml-2">
                                <x-label for="discount" :value="__('Discount')"/>

                                <x-input id="discount" class="block mt-1 w-full" type="number" name="discount"
                                         :value="$book->discount" min="1" max="99"/>
                                <span class="text-xs text-gray-400">Discount in percentage (%).</span>
                            </div>
                        </div>

                        <div class="mb-2">
                            <x-label for="cover" :value="__('Cover')"/>

                            <x-input id="cover" class="block mt-1 w-full" type="file" name="cover"/>
                        </div>

                        <div class="mb-2">
                            <x-label for="authors" value="Authors*"/>

                            <x-input id="authors" class="block mt-1 w-full" type="text" name="authors" :value="$authors"
                                     required/>
                            <span class="text-xs text-gray-400">Separated by comma</span>
                        </div>

                        <div class="mb-2">
                            <x-label for="genre[]" value="Genre*"/>

                            <div class="flex items-center">
                                @foreach ($genres as $genre)
                                    <input type="checkbox" name="genre[]" id="{{ $genre->id }}" value="{{ $genre->id }}"
                                           @if (in_array($genre->id, $book->genres->pluck('id')->toArray())) checked
                                           @endif class="form-radio h-4 w-4 text-blue-600 mr-1">
                                    <label for="{{ $genre->id }}" class="mr-2">{{ $genre->name }}</label>
                                @endforeach
                            </div>

                            </select>
                        </div>

                        <div class="mb-2">
                            <x-label for="description" value="Description*"/>

                            <textarea name="description" id="description" cols="30" rows="10"
                                      class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $book->description }}</textarea>
                        </div>

                        <x-button class="ml-3">
                            {{ __('Save') }}
                        </x-button>
                    </form>

                </div>
            </div>

        </div>
    </section>
</x-app-layout>
