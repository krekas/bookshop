<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="min-w-full bg-white rounded whitespace-nowrap mb-4">
                        <thead class="border-b bg-gray-50">
                            <tr class="">
                                <th class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle w-0">Order ID</th>
                                <th class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle w-0">Date</th>
                                <th class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle">Book</th>
                                <th class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle w-0">Status</th>
                                <th class="px-3 py-3 text-xs font-normal text-right text-gray-500 uppercase align-middle w-0">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm bg-white divide-y divide-gray-200">
                            @forelse($orders as $order)
                                <tr>
                                    <td class="px-3 py-4 text-gray-600 ">#{{ $order->id }}</td>
                                    <td class="px-3 py-4 text-gray-500">{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="px-3 py-4">
                                        <div class="flex items-center w-max">
                                            <img width="50" height="50" class="w-10 h-10 rounded-full" src="{{ asset($order->book->cover->getUrl('cover')) }}" alt="Book cover" />
                                            <div class="ml-4">
                                                <div class="text-gray-400">{{ $order->book->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4">
                                        <span class="px-4 py-1 text-sm text-green-500 rounded-full bg-green-50">completed</span>
                                    </td>
                                    <td class="px-3 py-4 text-right text-gray-500 ">@money($order->price)</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="font-semibold py-4">
                                        <div class="flex">
                                            No orders yet.
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $orders->links() }}

                </div>
            </div>
        </div>
    </section>
</x-app-layout>
