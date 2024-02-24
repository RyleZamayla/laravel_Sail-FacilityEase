<x-guest-layout>

    <div class="max-h-[95vh] bg-gray-800 border-gray-700 rounded-lg p-4 shadow-lg overflow-y-auto scrollbar-none" style="width: 500px;">

        <!--Logo-->
        <div class="text-center mt-4 mb-10">
            <img class="mx-auto w-48" src="{{ asset('images/FacilityEaseLogo.png') }}" alt="FacilityEase Logo" />
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label style="color:white" for="email_universityID" :value="__('Email | University ID')" />
                <x-text-input id="email_universityID" class="block mt-1 w-full p-2 bg-facilityEaseLightGrey" type="text" name="email_universityID" :value="old('email_universityID', $email_universityID)" readonly />

                    <x-input-error :messages="$errors->get('email')"
                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-2" />
                    <x-input-error :messages="$errors->get('universityID')"
                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label style="color:white" for="password" :value="__('New Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    autocomplete="new-password" autofocus />
                    <x-input-error :messages="$errors->get('password')"
                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label style="color:white" for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" autofocus autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')"
                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-2" />
            </div>

            <div class="flex items-center justify-end my-4">
                <x-primary-button class="w-full flex items-center justify-center bg-facilityEaseMain hover:bg-indigo-600 h-auto text-facilityEaseDarkGrey">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>

            <p class="mt-6 text-center text-sm text-gray-400">
                Changed your mind?
                <a href="{{ route('login') }}"
                    class="font-semibold leading-6 text-indigo-400 hover:text-facilityEaseMain transition-color">Let's
                    get you inside, Trailblazer!</a>
            </p>

        </form>

    </div>


</x-guest-layout>
