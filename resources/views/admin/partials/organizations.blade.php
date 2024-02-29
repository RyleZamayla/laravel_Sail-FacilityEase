<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Organizations Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update the Students' Accredited Organization Information, please note that annually there will be an accreditation process and organization moderators might change every one in a while.") }}
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
                    placeholder="Search for organizations">
            </div>
        </div>
        <div class="relative max-h-[32rem] overflow-y-auto shadow-md bg-gray-300 mt-2 scrollbar-none">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-sm text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Organization Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Campus
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
                    @foreach ($organizationData as $index => $data)
                        <tr
                            class="{{ $index % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }} border-b">
                            <th scope="row" class="flex items-center px-6 py-6 text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="ps-3">
                                    <div class="text-base font-semibold max-w-sm overflow-hidden overflow-ellipsis" id="orgNameContainer">
                                        {{ $data->orgName }}
                                    </div>

                                    <div class="font-normal text-gray-500">{{ $data->moderator }}</div>
                                </div>
                            </th>

                            <td class="px-6 py-4">
                                @if ($data->campusID == 8)
                                    Villanueva
                                @elseif ($data->campusID == 7)
                                    Panaon
                                @elseif ($data->campusID == 6)
                                    Oroquieta
                                @elseif ($data->campusID == 5)
                                    Jasaan
                                @elseif ($data->campusID == 4)
                                    Balubal
                                @elseif ($data->campusID == 3)
                                    Claveria
                                @elseif ($data->campusID == 2)
                                    Cagayan de Oro
                                @elseif ($data->campusID == 1)
                                    Alubijid
                                @endif
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
                                    <form action="{{ route('toggle-org-status', ['orgId' => $data->id]) }}"
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
                                        x-on:click="$dispatch('open-modal', 'edit-org-{{ $data->id }}')"
                                        class="w-32 px-4 py-2 leading-none text-white bg-facilityEaseMain rounded-md hover:bg-facilityEaseSecondary transition ease-in-out duration-300">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <x-short-modal name="edit-org-{{ $data->id }}" focusable class="max-w-md">
                            <div class="w-full px-5 pt-5">
                                <div class="max-h-[44rem] overflow-y-auto scrollbar-none">
                                    <form action="{{ route('edit-org-data', ['orgId' => $data->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('patch')

                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __('Update Organization Information') }}
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
                                                    <x-input-label class="font-bold" for="orgName" :value="__('Organization Name')" />
                                                    <span class="text-red-500 ml-1">*</span>
                                                </div>
                                                <x-text-input class="block mt-1 w-full" type="text" name="orgName" autocomplete="off" :value="$data->orgName">
                                                </x-text-input>
                                                <x-input-error :messages="$errors->get('orgName')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                            <div class="mt-3 flex-1 mx-1">
                                                <div class="flex">
                                                    <x-input-label class="font-bold" for="moderator" :value="__('Moderator')" />
                                                    <span class="text-red-500 ml-1">*</span>
                                                </div>
                                                <x-text-input class="block mt-1 w-full" type="text" name="moderator" autocomplete="off" :value="$data->moderator">
                                                </x-text-input>
                                                <x-input-error :messages="$errors->get('moderator')" class="mt-2 text-facilityEaseMain font-bold italic text-sm text-right my-1" />
                                            </div>
                                        </div>
                                        <div class="mt-9 mb-4 flex justify-end">
                                            <x-primary-button
                                                class="bg-facilityEaseMain hover:bg-facilityEaseGreen ms-3 items-center justify-center py-2 w-1/2">
                                                {{ __('Update Information') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </x-short-modal>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



</section>
