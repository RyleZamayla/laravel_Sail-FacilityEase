@extends('layouts.app')

@section('content')
    @if (session('equipment-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ session('equipment-success') }}
            </p>
        </div>
    @endif
    @if (session('equipment-toggle-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ session('equipment-toggle-success') }}
            </p>
        </div>
    @endif
    @if (session('equipment-edit-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ session('equipment-edit-success') }}
            </p>
        </div>
    @endif
    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseRed justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('There was a problem processing your reservation form!') }}
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
                                {{ __('Equipment Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Update Equipment status, please take note that changing this may greatly affect the system.') }}
                            </p>
                        </header>
                        @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0 ||
                                Auth::User()->User_Role->where('roleID', 2)->count() > 0)
                            <div>
                                <button x-data="" x-on:click="$dispatch('open-modal', 'create-equipment')"
                                    class="w-35 mx-2 px-4 py-3 leading-none text-white bg-facilityEaseGreen rounded-md hover:bg-green-600 hover:ring-2 hover:ring-facilityEaseGreen hover:ring-offset-2 transition ease-in-out duration-300">
                                    Add an Equipment
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
                                        Equipment
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Location
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="flex justify-center lg:justify-end px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <x-modal name="create-equipment" focusable>
                                    <div class="w-full p-6">
                                        <form class="space-y-4 md:space-y-6" action="{{ route('addEquipment') }}" method="POST">
                                            @csrf
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Add Equipment Information') }}
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600">
                                                {!! nl2br(__("Module is still under development, please tune in for more updates.\n")) !!}
                                                {{ __('Please contact ') }} <a href=""
                                                    class="text-facilityEaseMain font-bold">FacilityEase@gmail.com</a>
                                                {{ __(' for more inquiries, we will be sure to get back to you.') }}

                                            </p>
                                            <div class="mt-6 flex-1 mx-1">
                                                <div class="">
                                                    <x-input-label for="facility_dropdown" class="mt-3 block text-base font-medium ">
                                                        Facility:
                                                        <span class="text-red-500">*</span>
                                                    </x-input-label>
                                                    <select name="facilityID"
                                                        class="cursor-pointer block mt-1 w-full facility_dropdown" required="">
                                                        <option value="" hidden selected>Select Facility</option>
                                                        @foreach ($facilities as $facility)
                                                            <option value="{{ $facility->id }}">
                                                                {{ $facility->facility }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('building'))
                                                        <div class="text-facilityEaseSecondary font-bold italic text-xs">
                                                            {{ $errors->first('building') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <x-input-label for="equipmentName" class="mt-3 block text-base font-medium ">
                                                    Equipment Name:
                                                    <span class="text-red-500">*</span>
                                                </x-input-label>
                                                <x-text-input type="text" name="equipment" id="equipmentName"
                                                    class="mt-1 block w-full" placeholder="Enter equipment name" required="" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <x-input-label for="brand" class="mt-3 block text-base font-medium ">
                                                    Brand:
                                                    <span class="text-red-500 opacity-0">*</span>
                                                </x-input-label>
                                                <x-text-input type="text" name="brand" id="brand" class="mt-1 block w-full"
                                                    placeholder="Enter brand name" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <x-input-label for="model" class="mt-3 block text-base font-medium ">
                                                    Model:
                                                    <span class="text-red-500 opacity-0">*</span>
                                                </x-input-label>
                                                <x-text-input type="text" name="model" id="model"
                                                    class="mt-1 block w-full" placeholder="Enter model name" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <x-input-label for="quantity" class="mt-3 block text-base font-medium ">
                                                    Quantity:
                                                    <span class="text-red-500">*</span>
                                                </x-input-label>
                                                <x-text-input type="number" name="quantity" id="quantity"
                                                    class="mt-1 block w-full" placeholder="Enter quantity" required
                                                    min="0" />
                                            </div>
                                            <div class="mt-9 flex justify-end">
                                                <x-primary-button
                                                    class="bg-facilityEaseMain hover:bg-facilityEaseGreen ms-3 items-center justify-center py-2 w-1/2">
                                                    {{ __('Add Equipment') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </div>
                                </x-modal>
                                @foreach ($equipments as $index => $equipment)
                                    <tr
                                        class="{{ $index % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }} border-b">
                                        <td
                                            class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white max-w-sm overflow-hidden overflow-ellipsis">
                                            <div class="text-base font-semibold">{{ $equipment->equipment }}</div>
                                            <div class="font-normal text-gray-500">{{ $equipment->brand }}
                                                {{ $equipment->model }}</div>

                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="text-base font-semibold">{{ $equipment->facility->facility }}
                                            </div>
                                            <div class="font-normal text-gray-500">
                                                Bldg. {{ $equipment->facility->building->buildingNumber ?? 'N/A' }},
                                                {{ $equipment->facility->building->building ?? 'N/A' }} –
                                                {{ getOrdinal($equipment->facility->building_floor->floorNumber ?? 'N/A') }} Floor
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $equipment->quantity }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            @if ($equipment->status == 'SERVICEABLE')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                    Available
                                                </div>
                                            @elseif ($equipment->status == 'NON-SERVICEABLE')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                                    Unavailable
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-between lg:justify-end">
                                                <form
                                                action="{{ route('toggle-equipment-status', ['equipmentId' => $equipment->id]) }}"
                                                method="post">
                                                @csrf

                                                @if ($equipment->status == 'SERVICEABLE')
                                                    <button type="submit"
                                                        class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseRed rounded-md hover:bg-red-600 transition ease-in-out duration-150">
                                                        Unavailable
                                                    </button>
                                                @elseif ($equipment->status == 'NON-SERVICEABLE')
                                                    <button type="submit"
                                                        class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseGreen rounded-md hover:bg-green-500 transition ease-in-out duration-150">
                                                        Available
                                                    </button>
                                                @endif
                                            </form>
                                            <button x-data=""
                                                x-on:click="$dispatch('open-modal', 'edit-equipment-{{ $equipment->id }}')"
                                                class="w-32 px-4 py-2 leading-none text-white bg-facilityEaseMain rounded-md hover:bg-facilityEaseSecondary transition ease-in-out duration-150">
                                                Edit
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <x-modal name="edit-equipment-{{ $equipment->id }}" focusable>

                                        <div class="w-full p-6">
                                            <div class="">
                                                <form
                                                    action="{{ route('edit-equipment-data', ['equipmentId' => $equipment->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Update Equipment Information') }}
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {!! nl2br(__("Module is still under development, please tune in for more updates.\n")) !!}
                                                        {{ __('Please contact ') }} <a href=""
                                                            class="text-facilityEaseMain font-bold">FacilityEase@gmail.com</a>
                                                        {{ __(' for more inquiries, we will be sure to get back to you.') }}

                                                    </p>
                                                    <div class="mt-3 flex-1 mx-1">
                                                        <div class="flex">
                                                            <x-input-label class="font-bold" for="facilityID"
                                                                :value="__('Facility')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <select name="facilityID"
                                                            class="block mt-1 w-full facilities">
                                                            @foreach ($facilities as $facility)
                                                                <option value="{{ $facility->id }}"
                                                                    {{ old('facilityID', $equipment->facility->id) == $facility->id ? 'selected' : '' }}>
                                                                    {{ $facility->facility }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('facilityID')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <div class="mt-3 flex-1 mx-1">
                                                        <div class="flex">
                                                            <x-input-label class="font-bold" for="equipment"
                                                                :value="__('Equipment')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <x-text-input class="block mt-1 w-full" type="text"
                                                            name="equipment" autocomplete="off" :value="$equipment->equipment ?? ''">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('equipment')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <div class="mt-3 flex-1 mx-1">
                                                        <div class="flex">
                                                            <x-input-label class="font-bold" for="brand"
                                                                :value="__('Brand')" />
                                                            <span class="text-red-500 ml-1 opacity-0">*</span>
                                                        </div>
                                                        <x-text-input class="block mt-1 w-full" type="text"
                                                            name="brand" autocomplete="off" :value="$equipment->brand ?? ''">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('brand')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <div class="mt-3 flex-1 mx-1">
                                                        <div class="flex">
                                                            <x-input-label class="font-bold" for="model"
                                                                :value="__('Model')" />
                                                            <span class="text-red-500 ml-1 opacity-0">*</span>
                                                        </div>
                                                        <x-text-input class="block mt-1 w-full" type="text"
                                                            name="model" autocomplete="off" :value="$equipment->model ?? ''">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('model')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <div class="mt-3 flex-1 mx-1">
                                                        <div class="flex">
                                                            <x-input-label class="font-bold" for="office"
                                                                :value="__('Quantity')" />
                                                            <span class="text-red-500 ml-1">*</span>
                                                        </div>
                                                        <x-text-input class="block mt-1 w-full" type="text"
                                                            name="quantity" autocomplete="off" :value="$equipment->quantity ?? ''">
                                                        </x-text-input>
                                                        <x-input-error :messages="$errors->get('quantity')"
                                                            class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                                    </div>
                                                    <div class="mt-6 flex justify-end">
                                                        <x-primary-button
                                                            class="bg-facilityEaseMain hover:bg-facilityEaseGreen ms-3 items-center justify-center py-2 w-1/2">
                                                            {{ __('Update Information') }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </x-modal>
                                @endforeach
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
            $('.facility_dropdown').select2({
                theme: 'bootstrap-5'
            });
            $('.facilities').select2({
                theme: 'bootstrap-5'
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
