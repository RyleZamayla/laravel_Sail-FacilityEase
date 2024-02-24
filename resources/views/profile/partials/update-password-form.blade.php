<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <div class="flex">
                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                <span class="text-red-500 ml-1">*</span>
            </div>
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <div class="flex">
                <x-input-label for="update_password_password" :value="__('New Password')" />
                <span class="text-red-500 ml-1">*</span>
            </div>
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <div class="flex">
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                <span class="text-red-500 ml-1">*</span>
            </div>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="w-full flex justify-end">
            <x-primary-button
                class="bg-facilityEaseMain items-center justify-center py-2 w-1/2 hover:bg-facilityEaseGreen hover:outline-none hover:ring-2 hover:ring-facilityEaseGreen hover:ring-offset-2 transition ease-in-out duration-150">{{ __('Save Password') }}</x-primary-button>

        </div>
    </form>
</section>
