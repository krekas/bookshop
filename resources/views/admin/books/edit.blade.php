<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('admin.books.update', $book) }}" class="w-2/6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <x-label for="name" :value="__('Name')"/>

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$book->name"
                                     required/>
                        </div>

                        <div class="mb-2">
                            <x-label for="price" :value="__('Price')"/>

                            <x-input id="price" class="block mt-1 w-full" type="number" name="price"
                                     :value="$book->price" min="1" step="0.01" required/>
                        </div>

                        <div class="mb-2">
                            <x-label for="cover" :value="__('Cover*')"/>

                            <x-input id="cover" class="block mt-1 w-full" type="file" name="cover" required/>
                        </div>

                        <div class="mb-2">
                            <x-label for="authors[]" value="Authors"/>

                            <select name="authors[]" id="authors" multiple data-live-search="true"
                                    class="form-multiselect w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($authors as $author)
                                    <option class="py-1" value="{{ $author->id }}"
                                            @if (in_array($author->id, $book->authors->pluck('id')->toArray())) selected @endif>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <x-label for="genre[]" value="Genre"/>

                            <select name="genre[]" id="genre" multiple data-live-search="true"
                                    class="form-multiselect w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($genres as $genre)
                                    <option class="py-1" value="{{ $genre->id }}"
                                            @if (in_array($genre->id, $book->genres->pluck('id')->toArray())) selected @endif>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <textarea name="description" id="description" cols="30" rows="10" required
                                      class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $book->description }}</textarea>
                        </div>

                        <x-button class="ml-3">
                            {{ __('Save') }}
                        </x-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
