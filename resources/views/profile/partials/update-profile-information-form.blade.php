<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's personal information and please note that the Email address field and the University ID are non-editable.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="flex items-start justify-center">
            <div class="flex rounded-full p-1 relative group cursor-pointer">
                <div
                    class="inline-flex items-center justify-center p-1 overflow-hidden bg-facilityEaseMain rounded-full group-hover:bg-facilityEaseSecondary ease-in-out duration-200">

                    <div
                        class="relative inline-flex items-center justify-center w-44 h-44 overflow-hidden bg-gray-100 rounded-full">
                        <img id="imgPreview" src="{{ old('img', Auth::user()->profile_image) }}" alt="Avatar user" />
                        <input name="img" type="file" id="img"
                            class="opacity-0 absolute w-full h-full bg-gray-100 rounded-full cursor-pointer"
                            accept=".jpg, .jpeg, .gif, .png" onchange="handleFileChange(this)">
                    </div>
                </div>
                <div class="absolute
                            bottom-0 right-4">
                    <button type="button"
                        class="text-white rounded-full w-12 h-12 flex items-center justify-center bg-facilityEaseMain group-hover:bg-facilityEaseSecondary ease-in-out duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <input name="imgSvg" type="file" id="imgSvg"
                            class="opacity-0 absolute w-full h-full bg-gray-100 rounded-full"
                            accept=".jpg, .jpeg, .gif, .png" onchange="handleFileChange(this)">
                    </button>
                </div>
            </div>
        </div>
        <x-input-error class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" :messages="$errors->get('img')" />
        <x-input-error class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" :messages="$errors->get('imgSvg')" />
        <div class="flex">
            <div class="mt-3 flex-1 mx-1">
                <div class="flex">
                    <x-input-label class="font-bold" for="fName" :value="__('First name')" />
                    <span class="text-red-500 ml-1">*</span>
                </div>
                <x-text-input id="fName" name="fName" type="text" class="mt-1 block w-full" :value="old('fName', $user->fName)"
                    autocomplete="fName" />
                <x-input-error :messages="$errors->get('fName')"
                    class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
            </div>
            <div class="mt-3 flex-1 mx-1">
                <div class="flex">
                    <x-input-label class="font-bold" for="mName" :value="__('Middle name')" />
                    <span class="text-red-500 ml-1 opacity-0">*</span>
                </div>
                <x-text-input id="mName" name="mName" type="text" class="mt-1 block w-full" :value="old('mName', $user->mName)"
                    autocomplete="mName" />
                <x-input-error class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1"
                    :messages="$errors->get('mName')" />
            </div>
        </div>

        <div class="flex">
            <div class="mt-3 flex-1 mx-1">
                <div class="flex">
                    <x-input-label class="font-bold" for="lName" :value="__('Last name')" />
                    <span class="text-red-500 ml-1">*</span>
                </div>
                <x-text-input id="lName" name="lName" type="text" class="mt-1 block w-full" :value="old('lName', $user->lName)"
                    autocomplete="lName" />
                <x-input-error class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1"
                    :messages="$errors->get('lName')" />
            </div>
            <div class="mt-3 flex-1 mx-1">
                <div class="flex">
                    <x-input-label class="font-bold" for="cNumber" :value="__('Contact number')" />
                    <span class="text-red-500 ml-1">*</span>
                </div>
                <x-text-input id="cNumber" name="cNumber" type="text" class="mt-1 block w-full" :value="old('cNumber', $user->cNumber)"
                    autocomplete="cNumber" />
                <x-input-error class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1"
                    :messages="$errors->get('cNumber')" />
            </div>
        </div>

        <div class="flex">
            <!-- User Type -->
            <div class="mt-3 flex-1 mx-1">
                <div class="flex items-end justify-between my-1">
                    <div class="flex">
                        <x-input-label class="font-bold" for="userType" :value="__('User Type')" />
                        <span class="text-red-500 ml-1">*</span>
                    </div>
                    <span class="italic text-xs font-semibold text-facilityEaseDarkGrey ml-1">contact support to update
                        your user type</span>
                </div>
                <select name="userType" id="userType" class="cursor-not-allowed block mt-1 w-full" disabled>
                    <option value="{{ $user->user_role->first()->roleID }}">
                        @if ($user->user_role->first()->roleID == 6)
                            Student
                        @elseif ($user->user_role->first()->roleID == 5)
                            Student Leader
                        @elseif ($user->user_role->first()->roleID == 4)
                            Faculty
                        @elseif ($user->user_role->first()->roleID == 3)
                            Staff
                        @elseif ($user->user_role->first()->roleID == 2)
                            Facility in Charge
                        @elseif ($user->user_role->first()->roleID == 1)
                            Admin
                        @endif

                    </option>
                    @foreach ($roleData['roles']->reverse() as $data)
                        <option value="{{ $data->id }}" {{ old('userType') == $data->id ? 'selected' : '' }}>
                            {{ $data->role }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('userType')"
                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
            </div>

            <!-- Campus -->
            <div class="mt-3 flex-1 mx-1">
                <div class="flex my-1">
                    <x-input-label class="font-bold" for="campus" :value="__('Campus')" />
                    <span class="text-red-500 ml-1">*</span>
                </div>
                <select name="campus" id="campus" class="cursor-pointer block mt-1 w-full">
                    <option value="" disabled>Select a Campus</option>
                    <option value="{{ $user->campus }}">{{ $user->campus }}</option>
                    @foreach ($campusData['campuses'] as $data)
                        <option value="{{ $data->id }}" {{ old('campus') == $data->id ? 'selected' : '' }}>
                            {{ $data->campus }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('campus')"
                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
            </div>

        </div>

        @if (
            $user->user_role->first()->roleID == 6 ||
                $user->user_role->first()->roleID == 5 ||
                $user->user_role->first()->roleID == 4)

            <div id="profile-academic-container">
                <!-- Colleges -->
                <div class="mt-3 flex-1 mx-1">
                    <div class="flex items-end justify-between my-1">
                        <div class="flex">
                            <x-input-label class="font-bold" for="college" :value="__('College')" />
                            <span class="text-red-500 ml-1">*</span>
                        </div>
                        <span class="italic text-xs font-semibold text-facilityEaseDarkGrey ml-1">reselect campus to
                            load office data</span>
                    </div>
                    <select name="college" id="college" class="cursor-pointer block mt-1 w-full">
                        <option value="" disabled>Select a College</option>
                        <option value="{{ optional($user->academic)->college }}">
                            {{ optional($user->academic)->college }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('college')"
                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                </div>

                <!-- Departments -->
                <div class="mt-3 flex-1 mx-1">
                    <div class="flex items-end justify-between my-1">
                        <div class="flex">
                            <x-input-label class="font-bold" for="department" :value="__('Department')" />
                            <span class="text-red-500 text-opacity-0 ml-1">*</span>
                        </div>
                        <span class="italic text-xs font-semibold text-facilityEaseDarkGrey ml-1">reselect college to
                            load department data, some colleges might not have departments</span>
                    </div>
                    <select name="department" id="department" class="cursor-pointer block mt-1 w-full">
                        <option value="" disabled>Select a Department</option>
                        <option value="{{ optional($user->academic)->department }}">
                            {{ optional($user->academic)->department }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('department')"
                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                </div>

                @if ($user->user_role->first()->roleID == 5)
                    <div id="profile-organization-container">
                        <!-- Organizations -->
                        <div class="mt-3 flex-1 mx-1">
                            <div class="flex items-end justify-between my-1">
                                <div class="flex">
                                    <x-input-label class="font-bold" for="organization" :value="__('Organization')" />
                                <span class="text-red-500 ml-1">*</span>
                                </div>
                                <span class="italic text-xs font-semibold text-facilityEaseDarkGrey ml-1">some organizations might not show up due to them not being accredited</span>
                            </div>
                            <select name="organization" id="organization" class="cursor-pointer block mt-1 w-full">
                                <option value="" disabled>Select an Organization</option>
                                <option value="{{ optional($user->org_role->first())->orgName }}">
                                    {{ optional($user->org_role->first())->orgName }}
                                </option>
                                @foreach ($organizationData['organizations'] as $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('organization') == $data->id ? 'selected' : '' }}>
                                        {{ $data->orgName }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('organization')"
                                class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                        </div>

                        <!-- Org Position -->
                        <div class="mt-3 flex-1 mx-1">
                            <div class="flex">
                                <x-input-label class="font-bold" for="orgPosition" :value="__('Position')" />
                                <span class="text-red-500 ml-1">*</span>
                            </div>
                            <x-text-input id="orgPosition" class="block mt-1 w-full" type="text"
                                name="orgPosition" :value="optional($user->org_role->first())->orgPosition" autocomplete="off" />

                            <x-input-error :messages="$errors->get('orgPosition')"
                                class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                        </div>
                    </div>
                @endif

            </div>
        @endif

        @if (
            $user->user_role->first()->roleID == 3 ||
                $user->user_role->first()->roleID == 2 ||
                $user->user_role->first()->roleID == 1)
            <div id="profile-nonacademic-container">
                <!-- Offices -->
                <div class="mt-3 flex-1 mx-1">
                    <div class="flex items-end justify-between my-1">
                        <div class="flex">
                            <x-input-label class="font-bold" for="office" :value="__('Office')" />
                            <span class="text-red-500 ml-1">*</span>
                        </div>
                        <span class="italic text-xs font-semibold text-facilityEaseDarkGrey ml-1">reselect campus to
                            load office data</span>
                    </div>
                    <select name="office" id="office" class="cursor-pointer block mt-1 w-full">
                        <option value="" disabled>Select an Office</option>
                        <option value="{{ optional($user->nonacademic)->office }}">
                            {{ optional($user->nonacademic)->office }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('office')"
                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                </div>

                <!-- Positions -->
                <div class="mt-3 flex-1 mx-1">
                    <div class="flex items-end justify-between my-1">
                        <div class="flex">
                            <x-input-label class="font-bold" for="position" :value="__('Position')" />
                            <span class="text-red-500 text-opacity-0 ml-1">*</span>
                        </div>
                        <span class="italic text-xs font-semibold text-facilityEaseDarkGrey ml-1">reselect office to
                            load office data, some offices might not have positions</span>
                    </div> <select name="position" id="position" class="cursor-pointer block mt-1 w-full">
                        <option value="" disabled>Select a Position</option>
                        <option value="{{ optional($user->nonacademic)->position }}">
                            {{ optional($user->nonacademic)->position }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('position')"
                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                </div>

            </div>
        @endif

        <div>
            <div class="flex">
                <x-input-label class="font-bold" for="universityID" :value="__('University ID')" />
                <span class="text-red-500 ml-1">*</span>
            </div>
            <x-text-input id="universityID" name="universityID" type="text" class="mt-1 block w-full"
                :value="old('universityID', $user->universityID)" autocomplete="universityID" />
            <x-input-error class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1"
                :messages="$errors->get('universityID')" />
        </div>

        <div>
            <div class="flex">
                <x-input-label class="font-bold" for="email" :value="__('Email')" />
                <span class="text-red-500 ml-1">*</span>
            </div>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                autocomplete="email" />
            <x-input-error class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1"
                :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="flex justify-end text-md mt-4 text-facilityEaseRed font-bold">
                        {{ __('Your email address is unverified. ') }}

                        <span class="pl-4" />

                        <button form="send-verification"
                            class="underline text-facilityEaseRed hover:text-facilityEaseSecondary rounded-md">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="flex justify-end mt-2 font-medium text-md text-facilityEaseGreen italic">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="w-full flex justify-end">
            <x-primary-button
                class="bg-facilityEaseMain items-center justify-center py-2 w-1/2 hover:bg-facilityEaseGreen hover:outline-none hover:ring-2 hover:ring-facilityEaseGreen hover:ring-offset-2 transition ease-in-out duration-150">{{ __('Save Personal Information') }}</x-primary-button>

        </div>

    </form>
</section>
