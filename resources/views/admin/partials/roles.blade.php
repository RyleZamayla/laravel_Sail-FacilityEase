<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Role Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update Role availability, please take note that changing this may greatly affect the system.') }}
        </p>

        <div class="relative max-h-96 overflow-y-auto shadow-md sm:rounded-lg bg-gray-300 mt-2 scrollbar-none">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-sm text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Role
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
                    @foreach ($activeRoleData as $index => $data)
                        <tr
                            class="{{ $index % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }} border-b">
                            <td class="px-6 py-6 text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $data->role }}
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
                            <td class="flex justify-center lg:justify-end px-6 py-4">
                                <form action="{{ route('toggle-role-status', ['roleId' => $data->id]) }}"
                                    method="POST">
                                    @csrf

                                    @if ($data->role == 'Admin' && $data->status == 'ACTIVE')
                                        <button type="submit"
                                            class="w-32 px-4 py-2 leading-none text-white bg-facilityEaseDarkGrey rounded-md cursor-not-allowed" disabled >
                                            Deactivate
                                        </button>
                                    @elseif ($data->status == 'ACTIVE')
                                        <button type="submit"
                                            class="w-32 px-4 py-2 leading-none text-white bg-facilityEaseRed rounded-md hover:bg-red-600 transition ease-in-out duration-300">
                                            Deactivate
                                        </button>
                                    @elseif ($data->status == 'INACTIVE')
                                        <button type="submit"
                                            class="w-32 px-4 py-2 leading-none text-white bg-facilityEaseGreen rounded-md hover:bg-green-500 transition ease-in-out duration-300">
                                            Activate
                                        </button>
                                    @endif

                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <!-- ... Your existing code ... -->

                </tbody>
            </table>
        </div>


    </header>
</section>
