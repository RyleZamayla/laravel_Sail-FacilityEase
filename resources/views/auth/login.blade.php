<x-guest-layout>

    <div class="w-full shadow-md overflow-hidden bg-gray-800 border-gray-700 max-w-md rounded-lg">
        <x-auth-session-status x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-red-400 justify-center items-center text-lg text-white py-2" :status="session('message')" />

        <div class="px-10">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm pt-6 pb-6">
                <img class="mx-auto h-25 w-auto" src="{{ asset('images/dark_noBG_FacilityEase_logo.png') }}"
                    alt="FacilityEase Logo">
            </div>

            <form method="POST" action="{{ route('login') }}" x-data="{ isLoading: false }" @submit.prevent="isLoading = true; $event.target.submit();">
                @csrf

                <!-- Email or UniversityID -->
                <div>
                    <x-input-label style="color:white" class="font-bold" for="email_universityID" :value="__('Email | University ID')" />

                    <x-text-input id="email_universityID" class="block mt-1 w-full " type="text"
                        name="email_universityID" :value="old('email_universityID')" autofocus autocomplete="username" />

                    <x-input-error :messages="$errors->get('email')"
                        class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-2" />
                    <x-input-error :messages="$errors->get('universityID')"
                        class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-2" />
                </div>

                <!-- Password -->
                <div class="mt-2 relative" x-data="{ show: false }">
                    <x-input-label style="color:white" class="font-bold" for="password" :value="__('Password')" />

                    <div class="relative">
                        <x-text-input id="password" class="block pr-10 mt-1 w-full" type="password" name="password"
                            autocomplete="current-password" x-bind:type="show ? 'text' : 'password'"
                            @blur="show = false" />

                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 cursor-pointer">
                            <svg @click="show = !show" class="h-6 w-6" fill="none" stroke="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" x-show="!show">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg @click="show = !show" class="h-6 w-6" fill="none" stroke="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" x-show="show">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')"
                        class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-2" />
                </div>






                {{-- <a href="/auth/google/redirect"
                    class="w-full text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center dark:focus:ring-[#4285F4]/55 mr-2 my-2">
                    <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                        <path fill="currentColor"
                            d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z">
                        </path>
                    </svg>
                    Sign in with Google
                </a> --}}

                <div class="pt-3 flex items-right justify-end">
                    <!-- Forget password -->
                    <div class="block my-2 font-bold">
                        @if (Route::has('password.request'))
                            <a class="italic text-sm text-facilityEaseBlue hover:text-facilityEaseRed hover:underline rounded-md focus:outline-none focus:text-facilityEaseRed focus:ring-1 focus:ring-facilityEaseRed transition duration-300 ease-in-out"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="my-4" :status="session('status')" />

                <x-primary-button style="padding: 0.75rem; font-size: 1rem;"
                    class="mt-3 flex items-center justify-center w-full text-black border-facilityEaseDarkGrey hover:border-facilityEaseSecondary focus:bg-facilityEaseBlue focus:text-facilityEaseWhite hover:text-facilityEaseWhite bg-facilityEaseMain hover:bg-facilityEaseBlue text-gray-800 transition ease-in-out duration-300 ">
                    {{ __('Log in') }}
                </x-primary-button>


                <p class="mt-6 text-center text-sm text-gray-400 mb-6">
                    Not registered yet?
                    <a href="{{ route('register') }}"
                        class="font-semibold leading-6 text-indigo-400 hover:text-facilityEaseMain transition ease-in-out duration-300">Start
                        your journey here!</a>
                </p>

            </form>
        </div>
    </div>

    @push('scripts')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    @endpush

</x-guest-layout>
