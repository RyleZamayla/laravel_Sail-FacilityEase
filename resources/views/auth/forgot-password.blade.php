<x-guest-layout>

    <div class="w-2/6 bg-gray-800 border-gray-700 rounded-lg p-4 shadow-lg ">
        <!--Logo-->
        <div class="text-center mb-10">
            <img class="mx-auto w-48" src="{{ asset('images/FacilityEaseLogo.png') }}" alt="FacilityEase Logo" />
        </div>

        <div class="mb-4 text-sm text-white">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email or University ID -->
            <div>
                <div class="flex">
                    <x-input-label class="text-facilityEaseWhite" for="email_universityID" :value="__('Email | University ID')" />
                <span class="text-red-500 ml-1">*</span>
                </div>
                <x-text-input id="email_universityID" class="block mt-1 w-full p-2" type="text" name="email_universityID" :value="old('email_universityID')" autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-2" />
                <x-input-error :messages="$errors->get('universityID')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-2" />
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mt-2" :status="session('status')" />

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="flex items-center justify-center text-facilityEaseBlack hover:text-facilityEaseWhite focus:text-facilityEaseWhite bg-facilityEaseMain hover:bg-facilityEaseBlue focus:bg-facilityEaseBlue transition ease-in-out duration-300 h-auto">
                    {{ __('Send Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>


</x-guest-layout>
