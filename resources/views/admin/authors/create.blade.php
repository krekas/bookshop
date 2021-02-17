<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('admin.authors.store') }}" class="w-2/6">
                        @csrf

                        <div class="mb-2">
                            <x-label for="name" :value="__('Name')"/>

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                     required autofocus/>
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
