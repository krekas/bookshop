<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                    <form action="{{ route('books.report.store', $book) }}" method="POST">
                        @csrf

                        <div class="mb-2">
                            <x-label for="report" value="Report {{ $book->name }}" class="text-gray-900 text-3xl title-font font-medium tracking-widest mb-3"/>

                            <textarea name="report" id="report" cols="50" rows="10" required
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('report') }}</textarea>
                        </div>

                        <x-button class="ml-3">
                            {{ __('Report') }}
                        </x-button>
                    </form>

                </div>
            </div>

        </div>
    </section>
</x-app-layout>
