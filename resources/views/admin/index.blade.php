<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="text-gray-600 body-font">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-wrap -m-4 text-center">
                                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                                        <svg class="text-indigo-500 w-12 h-12 mb-3 inline-block" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ $books }}</h2>
                                        <p class="leading-relaxed">Books</p>
                                    </div>
                                </div>
                                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                                        <svg class="text-indigo-500 w-12 h-12 mb-3 inline-block" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ $approved }}</h2>
                                        <p class="leading-relaxed">Approved</p>
                                    </div>
                                </div>
                                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                                        <svg class="text-indigo-500 w-12 h-12 mb-3 inline-block" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7A9.97 9.97 0 014.02 8.971m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ $unapproved }}</h2>
                                        <p class="leading-relaxed">Unapproved</p>
                                    </div>
                                </div>
                                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                                        <svg class="text-indigo-500 w-12 h-12 mb-3 inline-block" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        <h2 class="title-font font-medium text-3xl text-gray-900">{{  $users }}</h2>
                                        <p class="leading-relaxed">Users</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
