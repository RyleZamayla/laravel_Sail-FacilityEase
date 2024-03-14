@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('Your Reservation form has been submitted!') }}
            </p>
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseRed justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ session('error') }}
            </p>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg h-full">
                <section>
                    <header class="flex clex-col">
                        <div class="flex flex-col">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Reservation Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Update Campus availability, please take note that changing this may greatly affect the system.') }}
                            </p>
                        </div>

                        <div class="flex flex-grow justify-end">
                            <button x-data="" x-on:click="$dispatch('open-modal', 'facility-type')"
                                class="w-35 mx-2 px-4 py-3 leading-none text-white bg-facilityEaseGreen rounded-md hover:bg-green-600 hover:ring-2 hover:ring-facilityEaseGreen hover:ring-offset-2 transition ease-in-out duration-300">
                                Make Reservation
                            </button>
                        </div>

                    </header>

                    <div
                        class="relative max-h-[520px] overflow-y-auto shadow-md sm:rounded-lg bg-gray-300 mt-2 scrollbar-none">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Event
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reserved by
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Days
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Contact no.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Timestamp
                                    </th>
                                    <th scope="col" class="flex justify-center lg:justify-end px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $index => $reservation)
                                    <tr
                                        class="border-b {{ $index % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }}">
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="">
                                                <div class="text-base font-semibold max-w-sm overflow-hidden overflow-ellipsis"
                                                    id="facilityContainer">
                                                    {{ $reservation->event }}
                                                </div>

                                                <div class="font-normal text-gray-500">
                                                    {{ $reservation->facility->facility }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="">
                                                <div class="text-base font-semibold max-w-sm overflow-hidden overflow-ellipsis"
                                                    id="NameContainer">
                                                    {{ $reservation->user->fName }} {{ $reservation->user->lName }}
                                                </div>
                                                <div class="font-normal text-gray-500">
                                                    {{ $reservation->user_role->role->role }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $reservation->noOfdays }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $reservation->user->cNumber }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            @if ($reservation->status == 'APPROVED')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseGreen me-2"></div>
                                                    Approved
                                                </div>
                                            @elseif ($reservation->status == 'PENDING')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseMain me-2"></div>
                                                    Pending
                                                </div>
                                            @elseif ($reservation->status == 'PENCILBOOKED')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseBlue me-2"></div>
                                                    Pencil Booked
                                                </div>
                                            @elseif ($reservation->status == 'DECLINED')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseRed me-2"></div>
                                                    Declined
                                                </div>
                                            @elseif ($reservation->status == 'CANCELLED')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseRed me-2"></div>
                                                    Cancelled
                                                </div>
                                            @elseif ($reservation->status == 'OCCUPIED')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseTeal me-2"></div>
                                                    Ongoing
                                                </div>
                                            @elseif ($reservation->status == 'REVOKED')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseRed me-2"></div>
                                                    Revoked
                                                </div>
                                            @elseif ($reservation->status == 'RESCHEDULED')
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseMain me-2"></div>
                                                    Rescheduled
                                                </div>
                                            @endif

                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $reservation->created_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-between lg:justify-end">
                                                <form
                                                    action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                        {{ route('fic.showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 3)->count() > 0)
                                        {{ route('user.showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 4)->count() > 0)
                                        {{ route('user.showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 5)->count() > 0)
                                        {{ route('user.showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 6)->count() > 0)
                                        {{ route('user.showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id]) }} @endif">
                                                    <button type="submit"
                                                        class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseBlue rounded-md hover:bg-indigo-600 transition ease-in-out duration-300"
                                                        onclick="markAsViewed({{ $reservation->id }});">
                                                        View
                                                    </button>
                                                </form>
                                                <form
                                                    action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                    {{ route('fic.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 3)->count() > 0)
                                    {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 4)->count() > 0)
                                    {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 5)->count() > 0)
                                    {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 6)->count() > 0)
                                    {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }} @endif">
                                                    <button x-data=""
                                                        class="w-32 px-4 py-2 leading-none text-white bg-facilityEaseMain rounded-md hover:bg-facilityEaseSecondary transition ease-in-out duration-300">
                                                        Edit
                                                    </button>
                                                </form>
                                                <form action="#" id="pdfForm">
                                                    <button type="button" class="ml-2 w-32 px-4 py-2 leading-none text-white bg-facilityEaseSecondary rounded-md hover:bg-indigo-600 transition ease-in-out duration-300" onclick="previewPdf({{ $reservation->id }})">
                                                        Print
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <x-long-modal name="facility-type" focusable class="max-w-md">
                        <div class="py-6 flex flex-wrap justify-center items-center w-full rounded-lg bg-white shadow">
                            @foreach ($facilities as $facility)
                                <div class="m-2 w-48 h-48  rounded-md shadow-md hover:shadow-facilityEaseSecondary bg-gray-200 transition ease-in-out duration-300">
                                    <a href="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                                @elseif(Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                                    {{ route('fic.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                                @elseif(Auth::user()->user_role->where('roleID', 3)->count() > 0)
                                                    {{ route('user.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                                @elseif(Auth::user()->user_role->where('roleID', 4)->count() > 0)
                                                    {{ route('user.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                                @elseif(Auth::user()->user_role->where('roleID', 5)->count() > 0)
                                                    {{ route('user.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }}
                                                @elseif(Auth::user()->user_role->where('roleID', 6)->count() > 0)
                                                    {{ route('user.reservationForm', ['universityID' => Auth::User()->universityID, 'id' => $facility->id]) }} @endif"
                                        class="hover:text-facilityEaseBlue transition ease-in-out duration-300">

                                        <div class="flex flex-col h-48 items-center justify-between p-3">
                                            <div class="flex justify-center text-md font-semibold">
                                                <center>{{ $facility->facility }}</center>
                                            </div>

                                            <div class="w-28">
                                                <img class="" src="{{ asset('images/FacilityEaseLogo-BG-round.png') }}"
                                                    alt="FacilityEase Logo">
                                            </div>
                                        </div>

                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </x-long-modal>
                </section>
            </div>
        </div>
    </div>

    <style>
        .read-row {
            background-color: #AEC6CF;
            /* Change the background color to indicate "read" */
            /* Add any other styles for the "read" state */
        }

        .custom-hover:hover {
            background-color: #3490dc;
            /* Use your desired shade of blue */
            color: white;
            /* Set the text color to white on hover if needed */
        }
    </style>
    <script>    
         function previewPdf(reservationId) {
        var url = '{{ route("pdfGenerator", ["id" => ":reservationId"]) }}';
        url = url.replace(':reservationId', reservationId);
        window.open(url, '_blank');
    }
    </script>
@endsection
