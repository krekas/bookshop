<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container max-w-7xl px-5 mx-auto mt-6">
            <div class="overflow-hidden sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col bg-white shadow-lg border rounded-lg mr-2">
                            <div class="w-full bg-gray-100 text-center py-2 text-gray-600 font-semibold tracking-wide">Buy as registered user</div>
                            <div class="flex flex-col justify-center items-center h-full py-4">
                                <div class="flex justify-between w-2/4">
                                    <a href="{{ route('login') }}" class="w-full mr-2 justify-center font-semibold inline-flex items-center px-4 py-2 text-xs text-blue-400 uppercase transition duration-500 ease-in-out transform bg-white border rounded-md lg:inline-flex lg:mt-px hover:border-blue-800 hover:bg-blue-700 hover:text-white focus:ring focus:outline-none ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Login</a>
                                    <a href="{{ route('register') }}" class="w-full ml-2 justify-center font-semibold inline-flex items-center px-4 py-2 text-xs text-blue-400 uppercase transition duration-500 ease-in-out transform bg-white border rounded-md lg:inline-flex lg:mt-px hover:border-blue-800 hover:bg-blue-700 hover:text-white focus:ring focus:outline-none ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Register</a>
                                </div>

                                <div class="flex items-center justify-between mt-4 mb-2 w-2/4">
                                    <span class="w-1/5 border-b lg:w-1/4"></span>

                                    <span class="text-xs text-center text-gray-500 uppercase">or login with social</span>

                                    <span class="w-1/5 border-b lg:w-1/4"></span>
                                </div>

                                <x-social-logins/>
                            </div>
                        </div>

                        <div class="bg-white shadow-lg border rounded-lg ml-2">
                            <div class="w-full bg-gray-100 text-center py-2 text-gray-600 font-semibold tracking-wide">Buy as guest</div>

                            <form action="{{ route('checkout.guest', array_slice(explode('/', url()->previous()), -1, 1)) }}" method="POST" class="p-4">
                                @csrf
                                <x-label for="name" :value="__('Name')"/>
                                <x-input id="name" class="block m-1 mb-2 w-full" type="text" name="name" :value="old('name')" required/>

                                <x-label for="email" :value="__('Email')"/>
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>

                                <x-button class="mt-4">Go to checkout</x-button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</x-app-layout>
