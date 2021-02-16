<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">

            <x-alert />
  
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">

                    <table class="table-fixed border-collapse w-full mb-4">
                        <thead>
                            <tr>
                                <th class="lg:w-4/6 p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Book</th>
                                <th class="lg:w-1/6 p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
                                <th class="lg:w-1/6 p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)    
                                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                    <td class="w-full lg:w-auto p-3 text-gray-800 lg:text-left text-center border border-b block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Book</span>
                                        {{ $book->name }}
                                    </td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
                                        @if ($book->approved)
                                            <div class="text-xs p-1 bg-green-200 text-green-800 rounded-full uppercase">Approved</div>
                                        @else
                                            <div class="text-xs p-1 bg-yellow-100 text-yellow-600 rounded-full uppercase">Waiting for approval</div>
                                        @endif
                                    </td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                                        <div class="flex justify-center">
                                            <a href="{{ route('user.books.edit', $book) }}" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                                            <form method="POST" action="{{ route('user.books.destroy', $book) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex-inline bg-transparent text-blue-400 hover:text-blue-600 underline p-0 ml-2 border-none">
                                                Remove
                                            </button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                    <td colspan="3" class="w-full lg:w-auto p-3 text-gray-800 lg:text-left text-center border border-b block lg:table-cell relative lg:static">You have no books listed.</td>
                                </tr>                                
                            @endforelse
                        </tbody>
                    </table>

                    {{ $books->links() }}

                </div>
            </div>
  
        </div>
      </section>
  </x-app-layout>