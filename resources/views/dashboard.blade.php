@extends('layouts.app')

@section('content')
    <x-auth-session-status class="mb-4" :status="session('message')" />
    <div class = "p-6">
        <div class="relative bg-white max-h-auto overflow-y-auto shadow-md sm:rounded-lg bg-white scrollbar-none p-4">
            <div class="flex-grow flex items-center">
                <label for="facilitySelect" class="text-sm font-medium text-gray-900 dark:text-white"></label>
                <select id="facilitySelect" name="facilityID"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-64 py-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer">
                    <option value="all" {{ $selectedFacility == 'all' ? 'selected' : '' }}>Filter by</option>
                    @foreach ($facilitiesData as $facility)
                        <option value="{{ $facility->id }}" {{ $selectedFacility == $facility->id ? 'selected' : '' }}>
                            {{ $facility->facility }}</option>
                    @endforeach
                </select>
                <div class="fixed bottom-16 right-20 z-50 shadow-lg rounded-full">
                    <button x-data="" x-on:click="$dispatch('open-modal', 'facility-type')"
                        class="h-20 w-20 p-4 leading-none text-white border-2 border-facilityEaseWhite bg-facilityEaseSecondary rounded-full shadow-lg hover:bg-facilityEaseMain hover:ring-2 hover:ring-facilityEaseMain hover:ring-offset-2 transition ease-in-out duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>


                    </button>
                </div>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="ml-auto flex flex-row justify-center mr-2">
                    <div class="flex flex-row items-center px-2">
                        <div class="p-3 rounded-md bg-facilityEaseTeal border border-facilityEaseWhite"></div>
                        <span class="ml-2 italic ">Ongoing</span>
                    </div>
                    <div class="flex flex-row items-center px-2">
                        <div class="p-3 rounded-md bg-facilityEaseGreen border border-facilityEaseWhite"></div>
                        <span class="ml-2 italic ">Approved</span>
                    </div>
                    <div class="flex flex-row items-center px-2">
                        <div class="p-3 rounded-md bg-facilityEaseBlue border border-facilityEaseWhite"></div>
                        <span class="ml-2 italic ">Pencil Booked</span>
                    </div>
                    <div class="flex flex-row items-center px-2">
                        <div class="p-3 rounded-md bg-facilityEaseMain border border-facilityEaseWhite"></div>
                        <span class="ml-2 italic ">Rescheduled</span>
                    </div>

                </div>
            </div>


            <x-long-modal name="facility-type" focusable class="max-w-md">
                <div class="p-4 flex flex-wrap justify-center items-center w-full rounded-lg bg-white shadow">
                    @foreach ($facilitiesData as $facility)
                        <div
                            class="w-md h-md m-2 flex flex-col justify-between text-center rounded-md shadow-md hover:shadow-facilityEaseSecondary bg-gray-200 transition ease-in-out duration-300">
                            <div class="block w-56 h-64">
                                <div class="relative items-center justify-center rounded-full">
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
                                        class="flex flex-col items-center justify-between hover:text-facilityEaseBlue transition ease-in-out duration-300">

                                        <div class="mt-3 px-1 justify-center text-lg">
                                            {{ $facility->facility }}
                                        </div>

                                        <div class="justify-center items-center w-32 mt-3">
                                            <img class="" src="{{ asset('images/FacilityEaseLogo-BG.png') }}"
                                                alt="FacilityEase Logo">
                                        </div>

                                        <div class="flex flex-col justify-end mt-3">
                                            <div>
                                                <i class="fas fa-bookmark mr-1"></i>Book
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </x-long-modal>

            <div>
                <div class="relative overflow-y-auto sm:rounded-lg bg-white scrollbar-none p-4">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = @json($convertedDatas);

            const reservationColorMap = {};
            const selectedFacilityId = '{{ $selectedFacility }}';
            const filteredData = data.filter(event => ['PENCILBOOKED', 'APPROVED', 'OCCUPIED', 'RESCHEDULED']
                .includes(event
                    .extendedProps.status));

            function getColorByStatus(status) {
                if (status === 'APPROVED') {
                    return '#34d399';
                } else if (status === 'PENCILBOOKED') {
                    return '#3e7ce1';
                } else if (status === 'RESCHEDULED') {
                    return '#fcb316';
                } else if (status === 'OCCUPIED') {
                    return '#008080';
                } else {
                    return '#CC3333';
                }
            }

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: "auto",
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: filteredData,
                eventContent: function(info) {
                    var event = info.event;
                    var reservationId = event.extendedProps.reservationID;

                    var eventColor = reservationColorMap[reservationId];

                    if (!eventColor) {
                        eventColor = getColorByStatus(event.extendedProps.status);
                        reservationColorMap[reservationId] = eventColor;
                    }


                    var customElement = document.createElement('div');
                    customElement.style.backgroundColor = eventColor;
                    customElement.style.color = 'black';
                    customElement.style.padding = '3px';
                    customElement.style.whiteSpace = 'nowrap';
                    customElement.style.overflow = 'hidden';
                    customElement.style.textOverflow = 'ellipsis';
                    customElement.style.textAlign = 'center';
                    customElement.style.width = '100%';
                    customElement.innerHTML = `${event.title}`;

                    return {
                        domNodes: [customElement]
                    };

                },
                eventDidMount: function(arg) {
                    arg.el.style.backgroundColor = getColorByStatus(arg.event.extendedProps.status);
                },
                eventClick: function(info) {
                    openEventDetailsOverlay(info.event);
                }
            });
            calendar.render();

            document.getElementById('facilitySelect').addEventListener('change', function() {
                var newSelectedFacilityId = this.value;

                // Filter events based on the selected facility
                var filteredEvents = data.filter(function(event) {
                    if (newSelectedFacilityId === 'all') {
                        return true; // Show all events
                    } else {
                        // Check if the event belongs to the selected facility
                        return event.extendedProps.facilityID == newSelectedFacilityId;
                    }
                });

                // Update the calendar events
                calendar.removeAllEvents();
                calendar.addEventSource(filteredEvents);
            });

        });
    </script>
@endsection
