<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif

                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="max-w-xs overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                        <div class="px-4 py-2">
                            <h1 class="text-3xl font-bold text-gray-800 uppercase tracking-wide">{{ $book->name }}</h1>
                        </div>

                        <img class="object-cover object-center w-full h-56 mt-2" src="{{ asset($book->cover->getUrl('cover')) }}" alt="{{ $book->name }}">

                        <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                            <h1 class="text-lg font-bold text-white">@money($book->final_price)</h1>
                        </div>
                    </div>

                    <div class="mt-3">
                        {{ $checkout->button('Proceed to payment', ['class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}
                    </div>

                    <div class="text-sm text-gray-400 mt-4">All transaction are made using stripe.</div>
                </div>
            </div>
        </div>
    </section>

    @section('scripts')
        <script src="https://js.stripe.com/v3/"></script>
    @endsection
</x-app-layout>
