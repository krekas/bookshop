<x-app-layout>
    <section class="text-gray-600 body-font mb-5 md:mb-0">
        <div class="container max-w-7xl px-5 mx-auto mt-6">
            <x-alert />

            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                  <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                      <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
                    </div>
                  </div>
                  <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('user.settings.update', auth()->user()) }}" method="POST">
                        @csrf
                      <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                          <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                              <label for="email" class="block text-sm font-medium text-gray-700">
                                Email
                              </label>
                              <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                              </div>
                            </div>
                          </div>
              
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                  <div class="border-t border-gray-200"></div>
                </div>
              </div>

              <div class="mt-5 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                  <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                      <h3 class="text-lg font-medium leading-6 text-gray-900">Change password</h3>
                    </div>
                  </div>
                  <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('user.password.update', auth()->user()) }}" method="POST">
                        @csrf
                      <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                          <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                              <label for="old_password" class="block text-sm font-medium text-gray-700">
                                Old password
                              </label>
                              <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="password" name="old_password" id="old_password" value="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                              </div>
                            </div>

                            <div class="col-span-3 sm:col-span-2">
                                <label for="new_password" class="block text-sm font-medium text-gray-700">
                                  New password
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                  <input type="password" name="new_password" id="new_password" value="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                              </div>

                              <div class="col-span-3 sm:col-span-2">
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">
                                  Repeat new password
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                  <input type="password" name="new_password_confirmation" id="new_password_confirmation" value="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                              </div>
                          </div>
              
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
      </section>
</x-app-layout>