<x-app-layout>
    <div class="py-12">

        <x-alert/>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 text-right">
            <a href="{{  route('admin.genres.create') }}"
               class="bg-transparent hover:bg-blue-400 text-blue-400 font-semibold hover:text-white mb-6 py-2 px-4 border border-blue-400 hover:border-transparent rounded">
                Create
            </a>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-fixed border-collapse w-full">
                        <thead>
                        <tr>
                            <th class="lg:w-5/6 p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Genre
                            </th>
                            <th class="lg:w-1/6 p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($genres as $genre)
                            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <td class="w-full lg:w-auto p-3 text-gray-800 lg:text-left text-center border border-b block lg:table-cell relative lg:static">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Genre</span>
                                    {{ $genre->name }}
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                                    <div class="flex justify-center">
                                        <a href="{{ route('admin.genres.edit', $genre) }}"
                                           class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                                        <form method="POST" action="{{ route('admin.genres.destroy', $genre) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="flex-inline bg-transparent text-blue-400 hover:text-blue-600 underline p-0 ml-2 border-none">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $genres->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
