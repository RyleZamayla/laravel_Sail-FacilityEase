@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ session('success') }}
            </p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <div class="flex flex-row justify-between">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Facilities Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Update Facilities availability, please take note that changing this may greatly affect the system.') }}
                            </p>
                        </header>
                        @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0)
                            <div>
                                <button x-data="" x-on:click="$dispatch('open-modal', 'create-facility')"
                                    class="w-35 mx-2 px-4 py-3 leading-none text-white bg-facilityEaseGreen rounded-md hover:bg-green-600 hover:ring-2 hover:ring-facilityEaseGreen hover:ring-offset-2 transition ease-in-out duration-300">
                                    Add a Facility
                                </button>
                            </div>
                        @endif
                    </div>
                    <div
                        class="relative max-h-[520px] overflow-y-auto shadow-md sm:rounded-lg bg-gray-300 mt-2 scrollbar-none">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Facility Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Location
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Capacity
                                    </th>
                                    @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0 ||
                                            Auth::User()->User_Role->where('roleID', 2)->count() > 0)
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                    @endif
                                    <th scope="col" class="flex justify-center lg:justify-end px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facilities as $index => $facility)
                                    <tr
                                        class="{{ $index % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }} border-b">
                                        <td
                                            class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white max-w-sm overflow-hidden overflow-ellipsis">
                                            <div class="">
                                                <div class="text-base font-semibold max-w-sm overflow-hidden overflow-ellipsis facilityContainer">
                                                    {{ $facility->facility }}
                                                </div>
                                                <div class="font-normal text-gray-500">
                                                    {{ $facility->user_role->user->fName }}
                                                    {{ $facility->user_role->user->lName }}
                                                </div>
                                            </div>

                                        </td>
                                        <td
                                            class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white max-w-sm overflow-hidden overflow-ellipsis">
                                            Bldg. {{ $facility->building->buildingNumber ?? 'N/A' }},
                                            {{ $facility->building->building ?? 'N/A' }} –
                                            {{ getOrdinal($facility->building_floor->floorNumber ?? 'N/A') }} Floor
                                        </td>
                                        <td
                                            class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white max-w-sm overflow-hidden overflow-ellipsis">
                                            {{ $facility->capacity }}
                                        </td>
                                        @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0 ||
                                                Auth::User()->User_Role->where('roleID', 2)->count() > 0)
                                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                @if ($facility->status == 'ACTIVE')
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                        Active
                                                    </div>
                                                @elseif ($facility->status == 'INACTIVE')
                                                    <div class="flex items-center">
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                                        Inactive
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                        <td class="flex-1 px-6 py-4">
                                            <div class="flex justify-between lg:justify-end">
                                                @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0 ||
                                                        Auth::User()->User_Role->where('roleID', 2)->count() > 0)
                                                    <form
                                                        action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('toggle-facility-status', ['facilityId' => $facility->id]) }}
                                                    @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                                        {{ route('fic.toggle-facility-status', ['facilityId' => $facility->id]) }} @endif"
                                                        method="post">
                                                        @csrf

                                                        @if ($facility->status == 'ACTIVE')
                                                            <button type="submit"
                                                                class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseRed rounded-md hover:bg-red-600 transition ease-in-out duration-300">
                                                                Deactivate
                                                            </button>
                                                        @elseif ($facility->status == 'INACTIVE')
                                                            <button type="submit"
                                                                class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseGreen rounded-md hover:bg-green-500 transition ease-in-out duration-300">
                                                                Activate
                                                            </button>
                                                        @endif
                                                    </form>
                                                    <button x-data=""
                                                        x-on:click="$dispatch('open-modal', 'edit-facility-{{ $facility->id }}')"
                                                        class="w-32 px-4 py-2 leading-none text-white bg-facilityEaseMain rounded-md hover:bg-facilityEaseSecondary transition ease-in-out duration-300">
                                                        Edit
                                                    </button>
                                                @endif

                                                <form
                                                    action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                        @elseif(Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                            {{ route('fic.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                        @elseif(Auth::user()->user_role->where('roleID', 3)->count() > 0)
                                            {{ route('user.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                        @elseif(Auth::user()->user_role->where('roleID', 4)->count() > 0)
                                            {{ route('user.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                        @elseif(Auth::user()->user_role->where('roleID', 5)->count() > 0)
                                            {{ route('user.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                        @elseif(Auth::user()->user_role->where('roleID', 6)->count() > 0)
                                            {{ route('user.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }} @endif">
                                                    <button type="submit"
                                                        class="w-32 mx-2 px-4 py-2 leading-none text-white
                                                @if ($facility->status === 'INACTIVE') bg-facilityEaseDarkGrey cursor-not-allowed
                                                @else
                                                    bg-facilityEaseBlue hover:bg-blue-700 @endif
                                                transition ease-in-out duration-300 rounded-md"
                                                        @if ($facility->status === 'INACTIVE') disabled @endif>
                                                        Book
                                                    </button>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                    <x-long-modal name="edit-facility-{{ $facility->id }}" focusable>
                                        <div class="w-full p-6">
                                            <form
                                                action="{{ route('edit-facility-data', ['facilityId' => $facility->id]) }}"
                                                class="space-y-4 md:space-y-6" method="post">
                                                @csrf
                                                @method('patch')
                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Update Facility Information') }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600">
                                                    {!! nl2br(__("Module is still under development, please tune in for more updates.\n")) !!}
                                                    {{ __('Please contact ') }} <a href=""
                                                        class="text-facilityEaseMain font-bold">FacilityEase@gmail.com</a>
                                                    {{ __(' for more inquiries, we will be sure to get back to you.') }}

                                                </p>

                                                <div class="mt-6">
                                                    <div class="mt-3 flex-1 mx-1 flex">
                                                        <!-- Left side -->
                                                        <div class="flex-1 flex-col w-full">
                                                            <div class="flex items-center">
                                                                <x-input-label class="font-bold" :value="__('Facility Name')" />
                                                                <span class="text-red-500 ml-1">*</span>
                                                            </div>
                                                            <x-text-input class="block w-full" type="text" name="facility" autocomplete="off" :value="$facility->facility">
                                                            </x-text-input>
                                                            <x-input-error :messages="$errors->get('facility')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                        </div>
                                                        <!-- Right side -->
                                                        <div class="flex-1 flex-col w-full ms-2">
                                                            <div class="flex items-center">
                                                                <x-input-label class="font-bold" for="building" :value="__('Building')" />
                                                                <span class="text-red-500 ml-1">*</span>
                                                            </div>
                                                            <select name="buildingID" class="cursor-pointer block w-full building">
                                                                <option value="{{ $facility->building->id }}" hidden>
                                                                    {{ $facility->building->buildingNumber }} - {{ $facility->building->building }}
                                                                </option>
                                                                @foreach ($buildings as $data)
                                                                    <option value="{{ $data->id }}" {{ old('building') == $data->id ? 'selected' : '' }}>
                                                                        {{ $data->buildingNumber }} - {{ $data->building }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error :messages="$errors->get('buildingID')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="mt-3 flex-1 mx-1 flex">
                                                    <!-- Left side -->
                                                    <div class="flex flex-col w-full">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" for="floors"
                                                                :value="__('Floor')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <select name="buildingFloorID"
                                                            class="cursor-pointer block w-full floors">
                                                            <option value="{{ $facility->building_floor->id }}" hidden>
                                                                {{ getOrdinal($facility->building_floor->floorNumber) }} Floor
                                                            </option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('buildingFloorID')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <!-- Right side -->
                                                    <div class="flex flex-col w-full ms-2">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" for="userRoleID"
                                                                :value="__('In charge')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <select name="userRoleID"
                                                            class="block w-full edit-userRoleID">
                                                            <option hidden>Select Facility incharge</option>
                                                            @foreach ($userFacilityInCharges as $facilityInCharge)
                                                                <option value="{{ $facilityInCharge->id }}"
                                                                    {{ old('userRoleID', $facility->user_role->id) == $facilityInCharge->id ? 'selected' : '' }}>
                                                                    {{ $facilityInCharge->user->fName }}
                                                                    {{ $facilityInCharge->user->lName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('userRoleID')
                                                            <p class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="mt-3 flex-1 mx-1 flex">
                                                    <!-- Left side -->
                                                    <div class="flex flex-col w-full">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" for="capacity"
                                                                :value="__('Capacity')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <x-text-input class="block w-full" type="number"
                                                            name="capacity" autocomplete="off" :value="$facility->capacity">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('capacity')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <!-- Right side -->
                                                    <div class="flex flex-col w-full ms-2">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" for="noOfHours"
                                                                :value="__('Number of hours active within a day:')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <x-text-input class="block w-full" type="number"
                                                            name="noOfHours" autocomplete="off" :value="$facility->noOfHours">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('capacity')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                </div>
                                                <div class="mt-3 flex-1 mx-1 flex">
                                                    <!-- Left side -->
                                                    <div class="flex flex-col w-full">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" for="openTime"
                                                                :value="__('Opening Time:')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <x-text-input class="block w-full" type="time"
                                                            name="openTime" autocomplete="off" :value="$facility->openTime
                                                                ? Carbon\Carbon::parse($facility->openTime)->format(
                                                                    'H:i',
                                                                )
                                                                : null">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('openTime')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <!-- Right side -->
                                                    <div class="flex flex-col w-full ms-2">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" for="closeTime"
                                                                :value="__('Closing Time:')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <x-text-input class="block w-full" type="time"
                                                            name="closeTime" autocomplete="off" :value="$facility->closeTime
                                                                ? Carbon\Carbon::parse($facility->closeTime)->format(
                                                                    'H:i',
                                                                )
                                                                : null">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('closeTime')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                </div>
                                                <div class="mt-3 flex-1 mx-1 flex">
                                                    <!-- Left side -->
                                                    <div class="flex flex-col w-full">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" for="maxDays"
                                                                :value="__('Maximum days allowed per reservation:')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <x-text-input class="block w-full" type="number"
                                                            name="maxDays" autocomplete="off" :value="$facility->maxDays">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('maxDays')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <!-- Right side -->
                                                    <div class="flex flex-col w-full ms-2">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" for="maxHours"
                                                                :value="__(
                                                                    'Maximum hour/s allowed per reservation:',
                                                                )" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <x-text-input class="block w-full" type="number"
                                                            name="maxHours" autocomplete="off" :value="$facility->maxHours">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('maxDays')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                </div>
                                                <div class="mt-9 flex justify-end">
                                                    <x-primary-button
                                                        class="bg-facilityEaseMain hover:bg-facilityEaseGreen ms-3 items-center justify-center py-2 w-1/2">
                                                        {{ __('Update Information') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </div>
                                    </x-long-modal>
                                @endforeach
                                <x-long-modal name="create-facility" focusable>
                                    <div class="w-full p-6">
                                        <form id="addFacilityForm" class="space-y-4 md:space-y-6" action="{{ route('addFacility') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Add Facility Information') }}
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600">
                                                {!! nl2br(__("Module is still under development, please tune in for more updates.\n")) !!}
                                                {{ __('Please contact ') }} <a href=""
                                                    class="text-facilityEaseMain font-bold">FacilityEase@gmail.com</a>
                                                {{ __(' for more inquiries, we will be sure to get back to you.') }}

                                            </p>
                                            <div class="mt-6">
                                                <div class="mt-3 flex-1 mx-1 flex">
                                                    <!-- Left side -->
                                                    <div class="flex-1 flex-col w-full">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" :value="__('Facility Name')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <x-text-input class="block w-full" type="text" name="facility" autocomplete="off">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('facility')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <!-- Right side -->
                                                    <div class="flex-1 flex-col w-full ms-2">
                                                        <div class="flex items-center">
                                                            <x-input-label class="font-bold" for="buildingID" :value="__('Building')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <select name="buildingID" class="cursor-pointer block w-full building_dropdown">
                                                            <option value="" hidden>
                                                                Select Building
                                                            </option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('buildingID')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3 flex-1 mx-1 flex">
                                                <!-- Left side -->
                                                <div class="flex flex-col w-full">
                                                    <div class="flex items-center">
                                                        <x-input-label class="font-bold" for="floors"
                                                            :value="__('Floor')" />
                                                        <span class="text-red-500 ml-1">*</span>
                                                    </div>
                                                    <select name="buildingFloorID"
                                                        class="cursor-pointer block w-full floors_dropdown">
                                                        <option value="" hidden>
                                                            Select Floor
                                                        </option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('buildingFloorID')"
                                                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                </div>
                                                <!-- Right side -->
                                                <div class="flex flex-col w-full ms-2">
                                                    <div class="flex items-center">
                                                        <x-input-label class="font-bold" for="userRoleID"
                                                            :value="__('In charge')" />
                                                        <span class="text-red-500 ml-1">*</span>
                                                    </div>
                                                    <select name="userRoleID"
                                                        class="block w-full userRoleID">
                                                        <option hidden>Select Facility incharge</option>
                                                        @foreach ($userFacilityInCharges as $facilityInCharge)
                                                            <option value="{{ $facilityInCharge->id }}">
                                                                {{ $facilityInCharge->user->fName }}
                                                                {{ $facilityInCharge->user->lName }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error :messages="$errors->get('buildingFloorID')"
                                                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                </div>
                                            </div>
                                            <div class="mt-3 flex-1 mx-1 flex">
                                                <!-- Left side -->
                                                <div class="flex flex-col w-full">
                                                    <div class="flex items-center">
                                                        <x-input-label class="font-bold" for="capacity"
                                                            :value="__('Capacity')" />
                                                        <span class="text-red-500 ml-1">*</span>
                                                    </div>
                                                    <x-text-input class="block w-full" type="number"
                                                        name="capacity" autocomplete="off">
                                                    </x-text-input>
                                                    <x-input-error :messages="$errors->get('capacity')"
                                                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                </div>
                                                <!-- Right side -->
                                                <div class="flex flex-col w-full ms-2">
                                                    <div class="flex items-center">
                                                        <x-input-label class="font-bold" for="noOfHours"
                                                            :value="__('Number of hours active within a day:')" />
                                                        <span class="text-red-500 ml-1">*</span>
                                                    </div>
                                                    <x-text-input class="block w-full" type="number"
                                                        name="noOfHours" autocomplete="off">
                                                    </x-text-input>
                                                    <x-input-error :messages="$errors->get('capacity')"
                                                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                </div>
                                            </div>
                                            <div class="mt-3 flex-1 mx-1 flex">
                                                <!-- Left side -->
                                                <div class="flex flex-col w-full">
                                                    <div class="flex items-center">
                                                        <x-input-label class="font-bold" for="openTime"
                                                            :value="__('Opening Time:')" />
                                                        <span class="text-red-500 ml-1">*</span>
                                                    </div>
                                                    <x-text-input class="block w-full" type="time"
                                                        name="openTime" autocomplete="off">
                                                    </x-text-input>
                                                    <x-input-error :messages="$errors->get('openTime')"
                                                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                </div>
                                                <!-- Right side -->
                                                <div class="flex flex-col w-full ms-2">
                                                    <div class="flex items-center">
                                                        <x-input-label class="font-bold" for="closeTime"
                                                            :value="__('Closing Time:')" />
                                                        <span class="text-red-500 ml-1">*</span>
                                                    </div>
                                                    <x-text-input class="block w-full" type="time"
                                                        name="closeTime" autocomplete="off">
                                                    </x-text-input>
                                                    <x-input-error :messages="$errors->get('closeTime')"
                                                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                </div>


                                            </div>
                                            <div class="mt-3 flex-1 mx-1 flex">
                                                <!-- Left side -->
                                                <div class="flex flex-col w-full">
                                                    <div class="flex items-center">
                                                        <x-input-label class="font-bold" for="maxDays"
                                                            :value="__('Maximum days allowed per reservation:')" />
                                                        <span class="text-red-500 ml-1">*</span>
                                                    </div>
                                                    <x-text-input class="block w-full" type="number"
                                                        name="maxDays" autocomplete="off">
                                                    </x-text-input>
                                                    <x-input-error :messages="$errors->get('maxDays')"
                                                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                </div>
                                                <!-- Right side -->
                                                <div class="flex flex-col w-full ms-2">
                                                    <div class="flex items-center">
                                                        <x-input-label class="font-bold" for="maxHours"
                                                            :value="__(
                                                                'Maximum hour/s allowed per reservation:',
                                                            )" />
                                                        <span class="text-red-500 ml-1">*</span>
                                                    </div>
                                                    <x-text-input class="block w-full" type="number"
                                                        name="maxHours" autocomplete="off">
                                                    </x-text-input>
                                                    <x-input-error :messages="$errors->get('maxDays')"
                                                        class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                </div>
                                            </div>
                                            <div class="mt-9 flex justify-end">
                                                <x-primary-button
                                                    class="bg-facilityEaseMain hover:bg-facilityEaseGreen ms-3 items-center justify-center py-2 w-1/2">
                                                    {{ __('Add Facility') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </div>
                                </x-long-modal>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@push('scripts')
    <script script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.building_dropdown').select2({
                theme: 'bootstrap-5'
            });
            $('.floors_dropdown').select2({
                theme: 'bootstrap-5'
            });
            $('.userRoleID').select2({
                theme: 'bootstrap-5'
            });
            $('.edit-userRoleID').select2({
                theme: 'bootstrap-5'
            });

            $('.building_dropdown').on('change', function() {
                var buildingID = this.value;
                $(".floors_dropdown").html('');
                $.ajax({
                    url: "{{ url('api/getFloors') }}",
                    type: "POST",
                    data: {
                        buildingID: buildingID
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result, function(key, value) {
                            var ordinalFloor = getOrdinal(value.floorNumber) + ' Floor';
                            $(".floors_dropdown").append('<option value="' + value.id +
                                '">' + ordinalFloor + '</option>');
                        });
                        // Trigger Select2 to refresh the dropdown
                        $('.floors_dropdown').trigger('change.select2');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        console.log('Error:', error);
                    }
                });
            });

            $('.building').select2({
                theme: 'bootstrap-5'
            });
            $('.floors').select2({
                theme: 'bootstrap-5'
            });
            $('.facilities').select2({
                theme: 'bootstrap-5'
            });

            $('.building').on('change', function() {
                var buildingID = this.value;
                $(".floors").html('<option value="" hidden>Select Floors</option>');
                $.ajax({
                    url: "{{ url('api/getFloors') }}",
                    type: "POST",
                    data: {
                        buildingID: buildingID
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result, function(key, value) {
                            var ordinalFloor = getOrdinal(value.floorNumber) + ' Floor';
                            $(".floors").append('<option value="' + value.id + '">' +
                                ordinalFloor + '</option>');
                        });
                    }
                });
            });
        });

        function getOrdinal(number) {
            var suffix = 'th';
            if (number % 100 >= 11 && number % 100 <= 13) {
                suffix = 'th';
            } else {
                switch (number % 10) {
                    case 1:
                        suffix = 'st';
                        break;
                    case 2:
                        suffix = 'nd';
                        break;
                    case 3:
                        suffix = 'rd';
                        break;
                    default:
                        suffix = 'th';
                        break;
                }
            }
            return number + suffix;
        }
    </script>
@endpush
