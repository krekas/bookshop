<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{ $orders->count() }}
            </div>

        </div>
    </section>
</x-app-layout>