<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Buildings Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update Buildings availability, please take note that changing this may greatly affect the system. This part of the system is in development, please note that you cannot change the number of floors per building.') }}
        </p>
    </header>

    <div class="relative max-h-96 overflow-y-auto shadow-md sm:rounded-lg bg-gray-300 mt-2 scrollbar-none">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Building Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Building Name
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
                @foreach ($buildingData as $index => $data)
                <tr class="{{ $index % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }} border-b">
                    <td class="px-6 py-6 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $data->buildingNumber }}
                    </td>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $data->building }}
                    </td>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
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
                            <form action="{{ route('toggle-building-status', ['buildingId' => $data->id]) }}" method="post">
                                @csrf

                                @if ($data->status == 'ACTIVE')
                                <button type="submit" class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseRed rounded-md hover:bg-red-600 transition ease-in-out duration-300">
                                    Deactivate
                                </button>
                                @elseif ($data->status == 'INACTIVE')
                                <button type="submit" class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseGreen rounded-md hover:bg-green-500 transition ease-in-out duration-300">
                                    Activate
                                </button>
                                @endif
                            </form>
                            <button x-data="" x-on:click="$dispatch('open-modal', 'edit-building-{{ $data->id }}')" class="w-32 px-4 py-2 leading-none text-white bg-facilityEaseMain rounded-md hover:bg-facilityEaseSecondary transition ease-in-out duration-300">
                                Edit
                            </button>
                        </div>
                    </td>
                </tr>

                <x-short-modal name="edit-building-{{ $data->id }}" focusable class="max-w-md">
                    <div class="max-w-md px-5 pt-5">
                        <form action="{{ route('edit-building-data', ['buildingId' => $data->id]) }}" method="post">
                            @csrf
                            @method('patch')
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Update Building Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{__("Module is still under development, please tune in for more updates.") }}
                                {{ __('Please contact ') }} <a href="" class="text-facilityEaseMain font-bold">FacilityEase@gmail.com</a>
                                {{ __(' for more inquiries, we will be sure to get back to you.') }}

                            </p>

                            <div class="mt-6">
                                <div class="mt-3 flex-1 mx-1">
                                    <div class="flex">
                                        <x-input-label class="font-bold" for="office" :value="__('Building Number')" />
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    <x-text-input class="block mt-1 w-full" type="text" name="buildingNumber" autocomplete="off" :value="$data->buildingNumber">
                                    </x-text-input>
                                    <x-input-error :messages="$errors->get('office')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                </div>
                                <div class="mt-3 flex-1 mx-1">
                                    <div class="flex">
                                        <x-input-label class="font-bold" for="office" :value="__('Building Name')" />
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    <x-text-input class="block mt-1 w-full" type="text" name="building" autocomplete="off" :value="$data->building">
                                    </x-text-input>
                                    <x-input-error :messages="$errors->get('office')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                </div>
                                <div class="mt-3 flex-1 mx-1">
                                    <div class="flex">
                                        <x-input-label class="font-bold" for="office" :value="__('Number of floors')" />
                                        <span class="text-red-500 ml-1">*</span>
                                    </div>
                                    <x-text-input class="block mt-1 w-full bg-facilityEaseLightGrey" type="text" name="floor" autocomplete="off" :value="$data->floor" readonly>

                                    </x-text-input>
                                    <x-input-error :messages="$errors->get('office')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                </div>
                            </div>

                            <div class="mt-9 mb-4 flex justify-end">

                                <x-primary-button class="bg-facilityEaseMain hover:bg-facilityEaseGreen ms-3 items-center justify-center py-2 w-1/2">
                                    {{ __('Update Information') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </x-short-modal>


                @endforeach
            </tbody>
        </table>
    </div>



</section>
