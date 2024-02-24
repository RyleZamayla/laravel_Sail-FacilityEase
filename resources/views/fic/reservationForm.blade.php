@extends('layouts.app')

@section('content')
    @if ($errors->has('conflict'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseRed justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ $errors->first('conflict') }}
            </p>
        </div>
    @endif

    @if ($errors->has('maxHours'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseRed justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ $errors->first('maxHours') }}
            </p>
        </div>
    @endif

    @if ($errors->timeErrors->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseRed justify-end items-center">
            <p>
            <ul>
                @foreach ($errors->timeErrors->all() as $error)
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
                        <div
                            class="ml-4 text-gray-600 font-semibold flex flex-row items-center cursor-pointer hover:text-facilityEaseWhite transition ease-in-out duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            <h2 class="text-md ml-1">read & write mode</h2>
                        </div>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    </header>
                </div>
                <div class="w-full py-6 px-4">
                    <form
                        action= "@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('createReservation', ['id' => $facility->id]) }}
                    @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0) {{ route('fic.createReservation', ['id' => $facility->id]) }}
                    @elseif (Auth::user()->user_role->where('roleID', 3)->count() > 0) {{ route('user.createReservation', ['id' => $facility->id]) }}
                    @elseif (Auth::user()->user_role->where('roleID', 4)->count() > 0) {{ route('user.createReservation', ['id' => $facility->id]) }}
                    @elseif (Auth::user()->user_role->where('roleID', 5)->count() > 0) {{ route('user.createReservation', ['id' => $facility->id]) }}
                    @elseif (Auth::user()->user_role->where('roleID', 6)->count() > 0) {{ route('user.createReservation', ['id' => $facility->id]) }} @endif"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-wrap">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="fName" class="mt-3 block text-base font-medium ">
                                        Applicant:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="fName" id="fName"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        value="{{ Auth::User()->fName }} {{ Auth::User()->lName }}" disabled />
                                </div>
                            </div>

                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="lName" class="mt-3 block text-base font-medium ">
                                        College | Office
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="" id="college"
                                        value="{{ optional(Auth::user()->academic)->first()->college ?? (optional(Auth::user()->nonacademic)->first()->office ?? 'N/A') }}"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed "
                                        disabled />
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
                                    <label for="guest" class="mt-3 block text-base font-medium ">
                                        Event Name:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="event" id="guest" placeholder="e.g. Week of Welcome"
                                        value="{{ old('event') }}"
                                        class="mt-2 w-full appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-black font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                                @if ($errors->has('event'))
                                    <div class="mt-2 text-facilityEaseRed font-bold italic text-sm">
                                        {{ $errors->first('event') }}</div>
                                @endif
                            </div>

                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="guest" class="mt-3 block text-base font-medium ">
                                        Expected No. of Attendees | maximum capacity is <strong
                                            class="text-facilityEaseBlue">{{ $facility->capacity }}</strong>:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="occupants" id="guest" placeholder="e.g. 50, 100"
                                        min="0"
                                        class="mt-2 w-full sm:w-30 appearance-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-black font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        value="{{ old('occupants') }}" />
                                </div>
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
                                        value="{{ old('startDate') }}"class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-black font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md cursor-pointer" />
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
                                    <input type="number" name="noOfdays" value="{{ old('noOfdays') }}" id="days"
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
                        </div>

                        <div class="flex flex-wrap">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="date" class="mt-3 block text-base font-medium ">
                                        End Date:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="endDate" id="endDate"
                                        value="{{ old('endDate') }}"class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium  outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        readonly />`
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

                        <div class="mt-10 px-3">
                            <h1 class="text-lg font-medium">Equipments | toggle checkbox when not needed :
                                <span class="text-red-500">*</span>
                            </h1>
                            <div class="pl-5">
                                @foreach ($equipments as $equipment)
                                    <div class="flex items-center mt-4">
                                        <input type="checkbox" checked name="selectedEquipments[]"
                                            value="{{ $equipment->id }}" id="{{ $equipment->id }}"
                                            class="w-6 h-6 bg-green-200 border-green-800 rounded-lg cursor-pointer" />
                                        <label for="{{ $equipment->id }}" class="pl-2 text-slate-400">
                                            {{ $equipment->equipment }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="mt-10 px-3">
                            <h1 class="text-lg font-medium">Please attach required documents | optional:</h1>
                            <div class="mt-2 rounded p-2">
                                <div class="form-group">
                                    <input type="file" name="file[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>


                        <div class="mt-10">
                            <button type="submit"
                                class="hover:ring-2 hover:ring-facilityEaseGreen hover:ring-offset-2 flex w-full justify-center rounded-md bg-facilityEaseGreen text-white px-3 py-3 text-sm font-semibold hover:bg-facilityEaseGreen transition ease-in-out duration-300">RESERVE</button>
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

                    @for ($day = 1; $day <= old('noOfdays', 1); $day++)
                        document.querySelector('input[name="startTime[{{ $day }}]"]').value =
                            '{{ old("startTime.$day") }}';
                        document.querySelector('input[name="endTime[{{ $day }}]"]').value =
                            '{{ old("endTime.$day") }}';
                    @endfor
                }
            }

            function addDayInputs(startDate, dayNumber) {
                var container = document.getElementById('dayInputsContainer');

                var dayDiv = document.createElement('div');
                dayDiv.className = 'w-full px-3 sm:w-1/2';


                var boxContainer = document.createElement('div');
                boxContainer.className = 'border border-gray-300 p-4 mt-4 rounded-md';

                var dayLabel = document.createElement('label');
                dayLabel.className = 'mt-3 block text-base font-medium ';
                dayLabel.innerHTML = 'Day ' + dayNumber + ':';

                var startTimeLabel = document.createElement('label');
                startTimeLabel.className = 'mt-2 block text-base font-medium ';
                startTimeLabel.innerHTML = 'Start Time:';

                // Start Time Input
                var startTimeInput = document.createElement('input');
                startTimeInput.type = 'time';
                startTimeInput.name = 'startTime[' + dayNumber + ']'; // Use dayNumber to create unique input names
                startTimeInput.className =
                    'mt-2 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#6A64F1] focus:shadow-md';
                startTimeInput.required = true;
                startTimeInput.value = '{{ old("startTime.$day") }}';

                // End Time Label
                var endTimeLabel = document.createElement('label');
                endTimeLabel.className = 'mt-2 block text-base font-medium ';
                endTimeLabel.innerHTML = 'End Time:';

                // End Time Input
                var endTimeInput = document.createElement('input');
                endTimeInput.type = 'time';
                endTimeInput.name = 'endTime[' + dayNumber + ']'; // Use dayNumber to create unique input names
                endTimeInput.className =
                    'mt-2 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-black outline-none focus:border-[#6A64F1] focus:shadow-md';
                endTimeInput.required = true;

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
    </script>
@endpush
