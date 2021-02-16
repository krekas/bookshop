<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('books.store') }}" class="sm:w-4/6 w-full">
                        @csrf

                        <div class="mb-2">
                            <x-label for="name" :value="__('Name*')" />
            
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Harry Potter" required autofocus />
                        </div>

                        <div class="mb-2">
                            <x-label for="price" :value="__('Price*')" />
            
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" min="1" step="0.01" required />
                        </div>

                        <div class="mb-2">
                            <x-label for="authors" value="Authors*" />

                            <x-input id="authors" class="block mt-1 w-full" type="text" name="authors" :value="old('authors')" placeholder="J. K. Rowling, William Shakespeare" required />
                            <span class="text-xs text-gray-400">Separated by comma</span>
                        </div>

                        <div class="mb-2">
                            <x-label for="genre[]" value="Genre*" />

                            <div class="flex items-center">
                            @foreach ($genres as $genre)
                                <input type="checkbox" name="genre[]" id="{{ $genre->id }}" value="{{ $genre->id }}" @if (in_array($genre->id, old('genre', []))) checked @endif class="form-radio h-4 w-4 text-blue-600 mr-1">
                                <label for="{{ $genre->id }}" class="mr-2">{{ $genre->name }}</label>
                            @endforeach
                            </div>
                        </div>

                        <div class="mb-2">
                            <x-label for="description" value="Description*" />

                            <textarea name="description" id="description" cols="30" rows="10" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
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