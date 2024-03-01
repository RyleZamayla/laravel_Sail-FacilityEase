<x-guest-layout>
    <div class="max-h-[95vh] bg-gray-800 border-gray-700 rounded-lg p-4 shadow-lg overflow-y-auto scrollbar-none mt-2"
        style="width: 500px;">
        <!--Logo-->
        <div class="text-center mt-4 mb-10">
            <img class="mx-auto w-48" src="{{ asset('images/FacilityEaseLogo.png') }}" alt="FacilityEase Logo" />
        </div>

        <div class="mb-4 text-medium text-white text-justify">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
            <div class="text-white mt-3">
                The Email would arrive at the estimated time around <strong class="text-facilityEaseYellow italic mt-3">3:00-5:00 minutes late.</strong></div>

            <div class="text-medium text-white mt-3">
                If you didn't receive the email,<strong class="text-facilityEaseRed italic"> please check your spam folder.</strong> We will gladly send you another link to be able to verify your account.</div>

        </div>


        @if (session('status') == 'verification-link-sent')
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-600"
                x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
             class="mb-4 font-bold text-sm text-green-400 italic text-right">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="mt-2 mb-2">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button
                        class="w-full flex items-center justify-center bg-facilityEaseMain hover:bg-indigo-600 hover:text-white h-auto text-facilityEaseSecondary transition ease-in-out duration-300">
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
