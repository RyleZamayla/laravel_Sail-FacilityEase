@extends('layouts.app')

@section('content')
    @if ($errors->has('conflict_resched'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseRed justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ $errors->first('conflict_resched') }}
            </p>
        </div>
    @endif

    @if ($errors->timeErrors_resched->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseRed justify-end items-center">
            <p>
            <ul>
                @foreach ($errors->timeErrors_resched->all() as $error)
                    <li class="text-lg text-white mr-10 py-2">{{ $error }}</li>
                @endforeach
            </ul>
            </p>
        </div>
    @endif
    <div class="py-12 h-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="w-auto rounded-lg bg-white">
                <div class=" bg-facilityEaseDarkGrey py-4 px-6 rounded-t-md flex justify-between shadow-lg">
                    <header class="flex items-center">
                        <h2 class="text-black text-2xl font-bold">RESERVATION DETAILS</h2>
                        <a
                            href="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id]) }}
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
                            <div
                                class="ml-4 text-gray-600 font-semibold flex flex-row items-center cursor-pointer hover:text-facilityEaseWhite transition ease-in-out duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                <h2 class="text-md ml-1">read & write mode</h2>
                            </div>
                        </a>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    </header>
                    <div class="py-2 px-6 text-gray-900 whitespace-nowrap bg-white rounded-lg cursor-pointer">
                        @if ($reservation->status == 'APPROVED')
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full bg-facilityEaseGreen me-2"></div>
                                Active
                            </div>
                        @elseif ($reservation->status == 'PENDING')
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full bg-facilityEaseMain me-2"></div>
                                Pending
                            </div>
                        @elseif ($reservation->status == 'PENCILBOOKED')
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full bg-facilityEaseBlue me-2"></div>
                                Pencil Booked
                            </div>
                        @elseif ($reservation->status == 'DECLINED')
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full bg-facilityEaseRed me-2"></div>
                                Declined
                            </div>
                        @elseif ($reservation->status == 'CANCELLED')
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full bg-facilityEaseRed me-2"></div>
                                Cancelled
                            </div>
                        @elseif ($reservation->status == 'REVOKED')
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full bg-facilityEaseRed me-2"></div>
                                Revoked
                            </div>
                        @elseif ($reservation->status == 'RESCHEDULED')
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full bg-facilityEaseMain me-2"></div>
                                Rescheduled
                            </div>
                        @elseif ($reservation->status == 'OCCUPIED')
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full bg-facilityEaseMain me-2"></div>
                                Ongoing
                            </div>
                        @endif
                    </div>
                </div>
                <div class="w-full py-6 px-4">
                    <form
                        action="{{ route('updateReschedule', ['id' => $reservation->id, 'facilityID' => $facility->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-wrap">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="fName" class="mt-3 block text-base font-medium text-black">
                                        Applicant:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="fName" id="fName"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        value="{{ $reservation->user->fName }} {{ $reservation->user->lName }}"
                                        readonly />
                                </div>
                            </div>

                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="lName" class="mt-3 block text-base font-medium text-black">
                                        College/Office
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="" id="college"
                                        value="{{ optional(Auth::user()->academic)->first()->college ?? (optional(Auth::user()->nonacademic)->first()->office ?? 'N/A') }}"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        readonly />
                                </div>
                            </div>
                        </div>

                        <div class="w-full px-3">
                            <div class="">
                                <label for="guest" class="mt-3 block text-base font-medium ">
                                    Venue:
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="facilityID" id="guest" value="{{ $facility->facility }}"
                                    class="mt-2 w-full appearance-none rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                    disabled />
                            </div>
                        </div>

                        <div class="w-full px-3">
                            <div class="">
                                <label for="guest" class="mt-3 block text-base font-medium ">
                                    {{ $facility->facility }} in charge:
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="facilityID" id="guest"
                                    value="{{ $facility->user_role->user->fName }} {{ $facility->user_role->user->lName }}"
                                    class="mt-2 w-full appearance-none rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                    disabled />
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="guest" class="mt-3 block text-base font-medium text-black">
                                        Event Name:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="event" placeholder="(e.g. Week of Welcome)"
                                        value=" {{ $reservation->event }}"
                                        class="mt-2 w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                                @if ($errors->has('event'))
                                    <div class="text-facilityEaseSecondary font-bold italic text-xs">
                                        {{ $errors->first('event') }}</div>
                                @endif
                            </div>

                            <div class="w-full px-3 sm:w-1/2">
                                <label for="guest" class="mt-3 block text-base font-medium text-black">
                                    Expected No. of Attendees | maximum capacity is <strong
                                        class="text-facilityEaseBlue">{{ $facility->capacity }}</strong>:
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="occupants" placeholder="(e.g. 50, 100)" min="0"
                                    value ="{{ $reservation->occupants }}"
                                    class="mt-2 w-full sm:w-30 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                @if ($errors->has('occupants'))
                                    <div class="mt-2 text-facilityEaseRed font-bold italic text-sm">
                                        {{ $errors->first('occupants') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap mt-10">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="date" class="block text-base font-medium ">
                                        Start Date:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="startDate" id="date"
                                        value ="{{ old('startDate', \Carbon\Carbon::createFromFormat('m-d-Y', $reservation->formattedStartDate)->format('Y-m-d')) }}"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-black font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md cursor-pointer" />
                                </div>
                                @if ($errors->has('startDate'))
                                    <div class="mt-2 text-facilityEaseRed font-bold italic text-sm">
                                        {{ $errors->first('startDate') }}</div>
                                @endif
                            </div>
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="time" class="block text-base font-medium ">
                                        No. of Days:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="noOfdays"
                                        value="{{ old('noOfdays', $reservation->noOfdays) }}" id="days"
                                        placeholder="e.g. 1,2,3"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                                @if ($errors->has('noOfdays'))
                                    <div class="mt-2 text-facilityEaseRed font-bold italic text-sm">
                                        {{ $errors->first('noOfdays') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap mt-10" id="dayInputsContainer">
                            <div class="flex flex-wrap mt-5" id="dayInputsContainer">
                                @foreach ($reservationDays as $days)
                                    <!-- Day inputs will be dynamically added here -->
                                @endforeach
                            </div>
                        </div>

                        <div class="flex flex-wrap">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="date" class="mt-3 block text-base font-medium ">
                                        End Date:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="endDate" id="endDate"
                                        value="{{ old('endDate', \Carbon\Carbon::createFromFormat('m-d-Y', $reservation->formattedEndDate)->format('Y-m-d')) }}"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                                @if ($errors->has('endDate'))
                                    <div class="mt-2 text-facilityEaseRed font-bold italic text-sm">
                                        {{ $errors->first('endDate') }}</div>
                                @endif
                            </div>
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="cNumber" class="mt-3 block text-base font-medium ">
                                        Contact Number
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="cNumber" value="{{ Auth::user()->cNumber }}"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        disabled />`
                                </div>

                                @if ($errors->has('cNumber'))
                                    <div class="mt-2 text-facilityEaseRed font-bold italic text-sm">
                                        {{ $errors->first('cNumber') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class ="mt-10 px-3">
                            <h1>Selected Equipments | this field is non-editable:
                                <span class="text-red-500">*</span>
                            </h1>
                            <div class="pl-5">
                                @foreach ($reservationEquipments as $equipment)
                                    <div class="flex items-center mt-3 ">
                                        <input type="checkbox"checked name="selectedEquipments[]"
                                            value="{{ $equipment->id }}" id="{{ $equipment->id }}"
                                            class="w-6 h-6 bg-green-200 border-green-800 rounded-lg cursor-not-allowed"
                                            disabled />
                                        <label for="{{ $equipment->id }}" class="pl-2 text-slate-400">
                                            {{ $equipment->equipment->equipment }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-10 px-3">

                            <div class="mt-10">
                                <h1 class="text-lg font-medium">Attachments:</h1>
                            </div>

                            <div class="mt-2 rounded p-2">
                                @if (count($reservationDocuments) > 0)
                                    <ul>
                                        @foreach ($reservationDocuments as $document)
                                            <div class="flex flex-row" id="document_{{ $document->id }}">
                                                <div class="flex flex-row">
                                                    <a class="flex flex-row-reverse"
                                                        href="{{ asset('storage/' . $document->file) }}" target="_blank"
                                                        class="">{{ basename($document->file) }}
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="mr-3 w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                                                        </svg>
                                                    </a>
                                                    <button
                                                        class="ml-5 text-facilityEaseRed font-medium button button-delete hover:underline transition ease-in-out duration-300"
                                                        data-document-id="{{ $document->id }}">
                                                        <i class="fas fa-trash mr-2"></i>Delete
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </ul>
                                @else
                                    <div
                                        class="flex flex-row mt-3 text-facilityEaseMain font-bold cursor-pointer transition ease-in-out duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                        </svg>

                                        <p class="ml-3">No attached documents.</p>
                                    </div>
                                @endif
                            </div>

                            <input type="hidden" id="deletedDocumentsInput" name="deletedDocuments" value="">


                            <div class="mt-10">
                                <h1 class="text-lg font-medium">Please attach required documents:</h1>
                            </div>
                            <div class="mt-2 rounded p-2">
                                <div class="form-group">
                                    <input type="file" name="file[]"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        multiple>
                                </div>
                            </div>

                            <div class = "mt-10">
                                <button type="submit"
                                    class="hover:ring-2 hover:ring-facilityEaseGreen hover:ring-offset-2 flex w-full justify-center rounded-md bg-facilityEaseGreen text-white px-3 py-3 text-sm font-semibold hover:bg-facilityEaseGreen transition ease-in-out duration-300">UPDATE
                                    RESERVATION</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://unpkg.com/create-file-list"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateEndDate() {
                var startDateValue = document.getElementById('date').value;
                var daysValue = document.getElementById('days').value;

                if (startDateValue && daysValue) {
                    var startDate = new Date(startDateValue);

                    // Clear existing day inputs
                    document.getElementById('dayInputsContainer').innerHTML = '';

                    // Generate day inputs based on the number of days
                    for (let i = 1; i <= parseInt(daysValue); i++) {
                        addDayInputs(startDate, i);
                    }

                    // Calculate and update the end date
                    var endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + parseInt(daysValue) - 1);

                    // Format the end date in the local time zone
                    var endDateFormatted = endDate.toISOString().split('T')[0];
                    document.getElementById('endDate').value = endDateFormatted;
                }
            }

            function addDayInputs(startDate, dayNumber) {
                var container = document.getElementById('dayInputsContainer');

                var dayDiv = document.createElement('div');
                dayDiv.className = 'w-full px-3 sm:w-1/2';

                // Box Container
                var boxContainer = document.createElement('div');
                boxContainer.className = 'border border-gray-300 p-4 mt-4 rounded-md';

                // Day Label
                var dayLabel = document.createElement('label');
                dayLabel.className = 'mt-3 block text-base font-medium text-black';
                dayLabel.innerHTML = 'Day ' + dayNumber + ':';

                // Start Time Label
                var startTimeLabel = document.createElement('label');
                startTimeLabel.className = 'mt-2 block text-base font-medium text-black';
                startTimeLabel.innerHTML = 'Start Time:';

                // Start Time Input
                var startTimeInput = document.createElement('input');
                startTimeInput.type = 'time';
                startTimeInput.name = 'startTime[' + dayNumber + ']'; // Use dayNumber to create unique input names
                startTimeInput.className =
                    'mt-2 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md';
                startTimeInput.value = @json(old('startTime', optional($days->startTime)->format('H:i')));


                // End Time Label
                var endTimeLabel = document.createElement('label');
                endTimeLabel.className = 'mt-2 block text-base font-medium text-black';
                endTimeLabel.innerHTML = 'End Time:';

                // End Time Input
                var endTimeInput = document.createElement('input');
                endTimeInput.type = 'time';
                endTimeInput.name = 'endTime[' + dayNumber + ']'; // Use dayNumber to create unique input names
                endTimeInput.className =
                    'mt-2 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md';
                endTimeInput.value = @json(old('endTime', optional($days->endTime)->format('H:i')));


                // Append elements
                boxContainer.appendChild(dayLabel);
                boxContainer.appendChild(startTimeLabel);
                boxContainer.appendChild(startTimeInput);
                boxContainer.appendChild(endTimeLabel);
                boxContainer.appendChild(endTimeInput);
                dayDiv.appendChild(boxContainer);
                container.appendChild(dayDiv);
            }

            // Attach the event listeners
            document.getElementById('date').addEventListener('input', updateEndDate);
            document.getElementById('days').addEventListener('input', updateEndDate);

            // Trigger the update on page load if values are pre-filled
            updateEndDate();
        });

        $(document).ready(function() {
            var deletedDocuments = [];

            $('.button-delete').on('click', function() {
                var documentId = $(this).data('document-id');
                $('#document_' + documentId).remove();
                deletedDocuments.push(documentId);

                // Add an input field to store deleted document IDs
                $('#deletedDocumentsInput').val(JSON.stringify(deletedDocuments));
            });
        });
    </script>
@endpush
