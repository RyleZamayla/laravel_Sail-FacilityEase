<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Users Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your user personal information and please note that you need to re-verify your email address once you change it.') }}
        </p>
    </header>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-facilityEaseLightGrey mt-2">
        <div
            class="flex items-center justify-between m-2 md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 dark:bg-gray-900">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search-users"
                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users">
            </div>
        </div>
        <div class="relative max-h-[32rem] overflow-y-auto shadow-md bg-gray-300 mt-2 scrollbar-none">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-sm text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User Role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            University ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="flex" class="flex justify-end px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userData as $index => $data)
                        <tr
                            class="{{ $index % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }} border-b">
                            <th scope="row"
                                class="flex items-center px-6 py-6 text-gray-900 whitespace-nowrap dark:text-white">
                                <img id="imgPreview" src="{{ $data->profile_image }}" alt="Avatar user"
                                    class="w-10 h-10" />
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $data->fName }}
                                        {{ substr($data->mName, 0, 1) }}. {{ $data->lName }}</div>
                                    <div class="font-normal text-gray-500">{{ $data->email }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                @foreach ($data->user_role as $role)
                                    @if ($role->roleID == 6)
                                        Student
                                    @elseif ($role->roleID == 5)
                                        Student Leader
                                    @elseif ($role->roleID == 4)
                                        Faculty
                                    @elseif ($role->roleID == 3)
                                        Staff
                                    @elseif ($role->roleID == 2)
                                        Facility in charge
                                    @elseif ($role->roleID == 1)
                                        Admin
                                    @endif
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->universityID }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($data->status == 'ACTIVE')
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                        Active
                                    </div>
                                @elseif ($data->status == 'INACTIVE')
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                        Inactive
                                    </div>
                                @endif
                            </td>
                            <td class="flex-1 px-6 py-4">
                                <div class="flex justify-between lg:justify-end">
                                    <form action="{{ route('toggle-user-status', ['userId' => $data->id]) }}"
                                        method="post">
                                        @csrf

                                        @if ($data->status == 'ACTIVE')
                                            <button type="submit"
                                                class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseRed rounded-md hover:bg-red-600 transition ease-in-out duration-300">
                                                Deactivate
                                            </button>
                                        @elseif ($data->status == 'INACTIVE')
                                            <button type="submit"
                                                class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseGreen rounded-md hover:bg-green-500 transition ease-in-out duration-300">
                                                Activate
                                            </button>
                                        @endif
                                    </form>
                                    <button x-data=""
                                        x-on:click="$dispatch('open-modal', 'edit-user-{{ $data->id }}')"
                                        class="w-32 px-4 py-2 leading-none text-white bg-facilityEaseMain rounded-md hover:bg-facilityEaseSecondary transition ease-in-out duration-300">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <x-modal name="edit-user-{{ $data->id }}" focusable class="max-w-md">
                            <div class="w-full px-5 pt-5">
                                <div class="max-h-[44rem] overflow-y-auto scrollbar-none">
                                    <form action="{{ route('edit-user-data', ['userId' => $data->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('patch')

                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __('Update User Information') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __('Module is still under development, please tune in for more updates.') }}
                                            {{ __('Please contact ') }} <a href=""
                                                class="text-facilityEaseMain font-bold">FacilityEase@gmail.com</a>
                                            {{ __(' for more inquiries, we will be sure to get back to you.') }}

                                        </p>


                                        <div class="mt-6">
                                            <div class="mt-3 flex-1 mx-1">
                                                <div class="flex">
                                                    <x-input-label class="font-bold" for="fName"
                                                        :value="__('First name')" />
                                                    <span class="text-red-500 ml-1">*</span>
                                                </div>
                                                <x-text-input class="block mt-1 w-full" type="text" name="fName"
                                                    autocomplete="off" :value="$data->fName ?? ''">
                                                </x-text-input>
                                                <x-input-error :messages="$errors->get('fName')"
                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <div class="flex">
                                                    <x-input-label class="font-bold" for="mName"
                                                        :value="__('Middle name')" />
                                                    <span class="text-red-500 ml-1 opacity-0">*</span>
                                                </div>
                                                <x-text-input class="block mt-1 w-full" type="text" name="mName"
                                                    autocomplete="off" :value="$data->mName ?? ''">
                                                </x-text-input>
                                                <x-input-error :messages="$errors->get('mName')"
                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <div class="flex">
                                                    <x-input-label class="font-bold" for="lName"
                                                        :value="__('Last name')" />
                                                    <span class="text-red-500 ml-1">*</span>
                                                </div>
                                                <x-text-input class="block mt-1 w-full" type="text" name="lName"
                                                    autocomplete="off" :value="$data->lName ?? ''">
                                                </x-text-input>
                                                <x-input-error :messages="$errors->get('lName')"
                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <div class="flex">
                                                    <x-input-label class="font-bold" for="cNumber"
                                                        :value="__('User Type')" />
                                                    <span class="text-red-500 ml-1">*</span>
                                                </div>
                                                <select name="userType" id="userType"
                                                    class="cursor-pointer block mt-1 w-full">
                                                    <option value="{{ $data->user_role->first()->roleID }}" hidden>
                                                        @if ($data->user_role->first()->roleID == 6)
                                                            Student
                                                        @elseif ($data->user_role->first()->roleID == 5)
                                                            Organization
                                                        @elseif ($data->user_role->first()->roleID == 4)
                                                            Faculty
                                                        @elseif ($data->user_role->first()->roleID == 3)
                                                            Staff
                                                        @elseif ($data->user_role->first()->roleID == 2)
                                                            Facility in Charge
                                                        @elseif ($data->user_role->first()->roleID == 1)
                                                            Admin
                                                        @endif
                                                    </option>
                                                    @foreach ($activeRoleData->reverse() as $roles)
                                                        <option value="{{ $roles->id }}"
                                                            {{ old('userType') == $roles->id ? 'selected' : '' }}>
                                                            {{ $roles->role }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('userType')"
                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <div class="flex">
                                                    <x-input-label class="font-bold" for="campus"
                                                        :value="__('Campus')" />
                                                    <span class="text-red-500 ml-1">*</span>
                                                </div>
                                                <select name="campus" id="campus"
                                                    class="cursor-pointer block mt-1 w-full">
                                                    <option value="{{ $data->campus }}" hidden>{{ $data->campus }}
                                                    </option>
                                                    @foreach ($activeCampusData as $campuses)
                                                        <option value="{{ $campuses->id }}"
                                                            {{ old('campus') == $campuses->id ? 'selected' : '' }}>
                                                            {{ $campuses->campus }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('campus')"
                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                            @if (
                                                $data->user_role->first()->roleID == 6 ||
                                                    $data->user_role->first()->roleID == 5 ||
                                                    $data->user_role->first()->roleID == 4)
                                                <div id="profile-academic-container">
                                                    <!-- Colleges -->
                                                    <div class="mt-3 flex-1 mx-1">
                                                        <div class="flex">
                                                            <x-input-label class="font-bold" for="college"
                                                                :value="__('College')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <select name="college" id="college"
                                                            class="cursor-pointer block mt-1 w-full">
                                                            <option value="{{ optional($data->academic)->college }}"
                                                                hidden>
                                                                {{ optional($data->academic)->college }}</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('college')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>

                                                    <!-- Departments -->
                                                    <div class="mt-3 flex-1 mx-1">
                                                        <div class="flex">
                                                            <x-input-label class="font-bold" for="department"
                                                                :value="__('Department')" />
                                                            <span class="text-red-500 text-opacity-0 ml-1">*</span>
                                                        </div>
                                                        <select name="department" id="department"
                                                            class="cursor-pointer block mt-1 w-full">
                                                            <option
                                                                value="{{ optional($data->academic)->department }}"
                                                                hidden>
                                                                {{ optional($data->academic)->department }}</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('department')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>

                                                    @if ($data->user_role->first()->roleID == 5)
                                                        <div id="profile-organization-container">
                                                            <!-- Organizations -->
                                                            <div class="mt-3 flex-1 mx-1">
                                                                <div class="flex">
                                                                    <x-input-label class="font-bold"
                                                                        for="organization" :value="__('Organization')" />
                                                                    <span class="text-red-500 ml-1">*</span>
                                                                </div>
                                                                <select name="organization" id="organization"
                                                                    class="cursor-pointer block mt-1 w-full">
                                                                    <option
                                                                        value="{{ optional($data->org_role->first())->orgName }}"
                                                                        hidden>
                                                                        {{ optional($data->org_role->first())->orgName }}
                                                                    </option>
                                                                    @foreach ($activeOrganizationData as $org)
                                                                        <option value="{{ $org->id }}"
                                                                            {{ old('organization') == $org->id ? 'selected' : '' }}>
                                                                            {{ $org->orgName }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <x-input-error :messages="$errors->get('organization')"
                                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                            </div>

                                                            <!-- Org Position -->
                                                            <div class="mt-3 flex-1 mx-1">
                                                                <div class="flex">
                                                                    <x-input-label class="font-bold" for="orgPosition"
                                                                        :value="__('Position')" />
                                                                    <span class="text-red-500 ml-1">*</span>
                                                                </div>
                                                                <x-text-input id="orgPosition"
                                                                    class="block mt-1 w-full" type="text"
                                                                    name="orgPosition" :value="optional($data->org_role->first())
                                                                        ->orgPosition"
                                                                    autocomplete="off" />

                                                                <x-input-error :messages="$errors->get('orgPosition')"
                                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>
                                            @endif
                                            @if (
                                                $data->user_role->first()->roleID == 3 ||
                                                    $data->user_role->first()->roleID == 2 ||
                                                    $data->user_role->first()->roleID == 1)
                                                <div id="profile-nonacademic-container">
                                                    <!-- Offices -->
                                                    <div class="mt-3 flex-1 mx-1">
                                                        <div class="flex">
                                                            <x-input-label class="font-bold" for="office"
                                                                :value="__('Office')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <select name="office" id="office"
                                                            class="cursor-pointer block mt-1 w-full">
                                                            <option
                                                                value="{{ optional($data->nonacademic)->office }}">
                                                                {{ optional($data->nonacademic)->office }}</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('office')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>

                                                    <!-- Positions -->
                                                    <div class="mt-3 flex-1 mx-1">
                                                        <div class="flex">
                                                            <x-input-label class="font-bold" for="position"
                                                                :value="__('Position')" />
                                                            <span class="text-red-500 text-opacity-0 ml-1">*</span>
                                                        </div> <select name="position" id="position"
                                                            class="cursor-pointer block mt-1 w-full">
                                                            <option
                                                                value="{{ optional($data->nonacademic)->position }}">
                                                                {{ optional($data->nonacademic)->position }}</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('position')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>

                                                </div>
                                            @endif
                                            <div class="mt-3 flex-1 mx-1">
                                                <div class="flex">
                                                    <x-input-label class="font-bold" for="universityID"
                                                        :value="__('University ID')" />
                                                    <span class="text-red-500 ml-1">*</span>
                                                </div>
                                                <x-text-input class="block mt-1 w-full" type="text"
                                                    name="universityID" autocomplete="off" :value="$data->universityID ?? ''">
                                                </x-text-input>
                                                <x-input-error :messages="$errors->get('universityID')"
                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <div class="flex">
                                                    <x-input-label class="font-bold" for="email"
                                                        :value="__('Email')" />
                                                    <span class="text-red-500 ml-1">*</span>
                                                </div>
                                                <x-text-input class="block mt-1 w-full" type="text" name="email"
                                                    autocomplete="off" :value="$data->email ?? ''">
                                                </x-text-input>
                                                <x-input-error :messages="$errors->get('email')"
                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <div class="flex">
                                                    <x-input-label class="font-bold" for="cNumber"
                                                        :value="__('Contact Number')" />
                                                    <span class="text-red-500 ml-1">*</span>
                                                </div>
                                                <x-text-input class="block mt-1 w-full" type="text" name="cNumber"
                                                    autocomplete="off" :value="$data->cNumber ?? ''">
                                                </x-text-input>
                                                <x-input-error :messages="$errors->get('cNumber')"
                                                    class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                            <div class="mt-9 mb-4 flex justify-end">

                                                <x-primary-button
                                                    class="bg-facilityEaseMain hover:bg-facilityEaseGreen ms-3 items-center justify-center py-2 w-1/2">
                                                    {{ __('Update Information') }}
                                                </x-primary-button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </x-modal>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



</section>
