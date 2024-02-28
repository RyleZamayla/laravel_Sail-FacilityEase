@extends('layouts.app')

@section('content')
    <div class="py-12 h-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="realtive w-auto rounded-lg bg-white overflow-y-auto scrollbar-none">
                <div class="{{ $reservation->bgColor }} py-4 px-6 rounded-t-md flex justify-between shadow-lg">

                    <header class="flex items-center">

                        <h2 class="text-black text-2xl font-bold">RESERVATION DETAILS</h2>
                        <a
                            href="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
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
                            <div
                                class="ml-4 font-semibold flex flex-row items-center cursor-pointer hover:text-facilityEaseWhite transition ease-in-out duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <h2 class="text-md ml-1">reading mode</h2>
                            </div>
                        </a>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    </header>
                    <div class="py-2 px-6 text-gray-900 whitespace-nowrap bg-white rounded-lg cursor-pointer">
                        @if ($reservation->status == 'APPROVED')
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full bg-facilityEaseGreen me-2"></div>
                                Approved
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
                                <div class="h-3 w-3 rounded-full bg-facilityEaseTeal me-2"></div>
                                Ongoing
                            </div>
                        @endif
                    </div>
                </div>
                <div class="w-full py-6 px-4">
                    <form action="" method="">
                        @csrf
                        <div class="flex flex-wrap">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="fName" class="mt-3 block text-base font-medium text-black">
                                        Applicant:
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="fName" id="fName" placeholder="First Name"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        value="{{ $reservation->user->fName }} {{ $reservation->user->lName }}" disabled />
                                </div>
                            </div>

                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="lName" class="mt-3 block text-base font-medium text-black">
                                        College/Office
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="" id="college"
                                        value="{{ optional(optional($reservation->user->academic)->first())->college ?? (optional(optional($reservation->user->nonacademic)->first())->office ?? 'N/A') }}"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        disabled />
                                </div>
                            </div>
                        </div>

                        <div class="w-full px-3">
                            <div class="">
                                <label for="guest" class="mt-3 block text-base font-medium text-black">
                                    Venue:
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="facilityID" id="guest"
                                    value="{{ $reservation->facility->facility }}"
                                    class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                    disabled />
                            </div>
                        </div>

                        <div class="w-full px-3">
                            <div class="">
                                <label for="guest" class="mt-3 block text-base font-medium text-black">
                                    {{ $reservation->facility->facility }} in charge:
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="facilityID" id="guest"
                                    value="{{ $reservation->facility->user_role->user->fName }} {{ $reservation->facility->user_role->user->lName }}"
                                    class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
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
                                    <input type="text" name="event" id="guest" value=" {{ $reservation->event }}"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        disabled />
                                </div>
                            </div>

                            <div class="w-full px-3 sm:w-1/2">
                                <label for="guest" class="mt-3 block text-base font-medium text-black">
                                    Expected No. of Attendees:
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="occupants" id="guest" value="{{ $reservation->occupants }}"
                                    min="0"
                                    class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                    disabled />
                            </div>
                        </div>

                        <div class="flex flex-wrap mt-10">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="date" class="mt-3 block text-base font-medium text-black">
                                        Start Date
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input name="startDate" id="date"
                                        value=" {{ old('startDate', \Carbon\Carbon::createFromFormat('m-d-Y', $reservation->formattedStartDate)->format('Y-m-d')) }}"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        disabled />
                                </div>
                            </div>

                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="time" class="mt-3 block text-base font-medium text-black">
                                        No. of Days
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input name="days" id= "days" min="1"
                                        value=" {{ $reservation->noOfdays }}"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        disabled />
                                </div>
                            </div>
                        </div>


                        <div class="flex flex-wrap mt-10">
                            @foreach ($reservationDays as $days)
                                <div class="w-full px-3 sm:w-1/2">

                                    <div class="flex flex-col justify-start p-4 mt-4 border border-gray-300 rounded-md">
                                        <label for="time" class="mt-3 block text-base font-medium text-black">
                                            Day {{ $days->days }}
                                            <span class="text-red-500">*</span>
                                        </label>
                                        {{-- <div class="gap-4"> --}}
                                        <div class="mt-2">
                                            <label for="startTime" class="block text-sm font-medium text-gray-700">Start
                                                Time</label>
                                            <input name="startTime" id="days"
                                                value="{{ $days->startTime->format('h:i A') }}"
                                                class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-sm font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                                disabled />
                                        </div>
                                        <div class="mt-2">
                                            <label for="endTime" class="block text-sm font-medium text-gray-700">End
                                                Time</label>
                                            <input name="endTime" id="days"
                                                value="{{ $days->endTime->format('h:i A') }}"
                                                class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-sm font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                                disabled />
                                        </div>
                                        {{-- </div> --}}
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        <div class="flex flex-wrap">
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="date" class="mt-3 block text-base font-medium text-black">
                                        End Date
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input name="endDate" id="endDate"
                                        value="{{ old('endDate', \Carbon\Carbon::createFromFormat('m-d-Y', $reservation->formattedEndDate)->format('Y-m-d')) }}"
                                        class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed"
                                        disabled />
                                </div>
                            </div>
                            <div class="w-full px-3 sm:w-1/2">
                                <div class="">
                                    <label for="cNumber" class="mt-3 block text-base font-medium ">
                                        Contact Number
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="cNumber"
                                        value="{{ Auth::user()->cNumber }}" class="mt-2 w-full rounded-md border border-[#e0e0e0] bg-facilityEaseLightGrey py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-not-allowed" disabled />`
                                </div>
                            </div>
                        </div>

                        <div class ="mt-10 px-3">
                            <h1 class="text-lg font-medium">Selected Equipments | this field is non-editable:
                                <span class="text-red-500">*</span>
                            </h1>
                            <div class="pl-5">
                                @if (count($reservationEquipments) > 0)
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
                                @else
                                    <div
                                        class="mt-3 text-facilityEaseMain font-bold cursor-pointer hover:text-facilityEaseBlue transition ease-in-out duration-300">
                                        <a href="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0)
                            {{ route('fic.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 3)->count() > 0)
                            {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 4)->count() > 0)
                            {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 5)->count() > 0)
                            {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 6)->count() > 0)
                            {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }} @endif"
                                            class="flex flex-row ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                            </svg>

                                            <p class="ml-3">No selected equipments.</p>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class ="mt-10 px-3">
                            <h1 class="text-lg font-medium">Attached Requirements | this field is non-editable:
                                <span class="text-red-500">*</span>
                            </h1>
                            <div class="pl-5">
                                @if (count($reservationDocuments) > 0)
                                    <ul>
                                        @foreach ($reservationDocuments as $document)
                                            <li class="mt-3">
                                                <a href="{{ asset('storage/' . $document->file) }}" target="_blank"
                                                    class="flex flex-row">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="mr-3 w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                                                    </svg>
                                                    {{ basename($document->file) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div
                                        class="mt-3 text-facilityEaseMain font-bold cursor-pointer hover:text-facilityEaseBlue transition ease-in-out duration-300">
                                        <a href="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0)
                            {{ route('fic.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 3)->count() > 0)
                            {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 4)->count() > 0)
                            {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 5)->count() > 0)
                            {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }}
                            @elseif (Auth::user()->user_role->where('roleID', 6)->count() > 0)
                            {{ route('user.updateReservation', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id]) }} @endif"
                                            class="flex flex-row ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                            </svg>

                                            <p class="ml-3">No attached documents.</p>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="w-full px-3">
                            <div class="mt-10">
                                <h1 class="mb-3 text-lg font-medium">Remarks:</h1>
                                <div class="pl-5">
                                    @if ($reservation->reason)
                                        <div class="flex flex-row font-bold text-facilityEaseRed">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                            </svg>
                                            <p class="ml-3">{{ $reservation->reason }}</p>
                                        </div>
                                    @else
                                        <div class="flex flex-row font-bold text-facilityEaseRed">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                            </svg>

                                            <p class="ml-3">No remarks.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                            <div class="grid grid-cols-3 gap-6 md:grid-cols-5 p-2 mt-10">
                        @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0 ||
                                Auth::User()->User_Role->where('roleID', 2)->count() > 0)
                                <form>
                                    <button hidden type="submit"
                                        class=" text-base py-3 px-10 border-b-4 border-yellow-600 bg-yellow-500 hover:bg-yellow-400"
                                        disabled style="cursor: not-allowed;">
                                        Pencil Book
                                    </button>
                                </form>
                                @if ($reservation->status !== 'DECLINED' && $reservation->status !== 'REVOKED' && $reservation->status !== 'OCCUPIED'  )
                                    <form
                                        action= "@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservationStatus', ['id' => $reservation->id, 'status' => 'APPROVED']) }}
                                    @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                    {{ route('fic.updateReservationStatus', ['id' => $reservation->id, 'status' => 'APPROVED']) }} @endif"
                                        method="post">
                                        @csrf
                                        @method('patch')
                                        @if ($reservation->status !== 'APPROVED')
                                            <button type="submit"
                                                class="text-white hover:ring-2 hover:ring-facilityEaseGreen hover:ring-offset-2  rounded-lg text-base py-3 px-10 bg-facilityEaseGreen transition ease-in-out duration-300"
                                                {{ in_array($reservation->status, ['APPROVED', 'CANCELLED', 'DECLINED']) ? 'disabled' : '' }}
                                                style="{{ in_array($reservation->status, ['APPROVED', 'CANCELLED', 'DECLINED']) ? 'cursor: not-allowed;' : '' }}">
                                                Approve
                                            </button>
                                        @endif
                                    </form>
                                @endif

                                @if (
                                    $reservation->status !== 'PENCILBOOKED' &&
                                        $reservation->status !== 'APPROVED' &&
                                        $reservation->status !== 'REVOKED' &&
                                        $reservation->status !== 'OCCUPIED' &&
                                        $reservation->status !== 'DECLINED')
                                    <form
                                        action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservationStatus', ['id' => $reservation->id, 'status' => 'PENCILBOOKED']) }} @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0) {{ route('fic.updateReservationStatus', ['id' => $reservation->id, 'status' => 'PENCILBOOKED']) }} @endif"
                                        method="post">
                                        @csrf
                                        @method('patch')
                                        <button type="button" x-data=""
                                            x-on:click="$dispatch('open-modal', 'pencilbook')" {{-- onclick="{{ $reservation->status === 'CANCELLED' ? 'null' : 'openPencilReasonOverlay()' }}" --}}
                                            class="text-white hover:ring-2 hover:ring-facilityEaseBlue hover:ring-offset-2 rounded-lg w-full text-base py-3 px-10 bg-facilityEaseBlue transition ease-in-out duration-300"
                                            {{ in_array($reservation->status, ['APPROVED', 'CANCELLED', 'DECLINED',]) ? 'disabled' : '' }}
                                            style="{{ in_array($reservation->status, ['APPROVED', 'CANCELLED', 'DECLINED']) ? 'cursor: not-allowed;' : '' }}">
                                            Pencil Book
                                        </button>
                                        <x-long-modal name="pencilbook" focusable class="max-w-md">
                                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                                <div class="block w-full justify-items-start">
                                                    <div class="w-full">
                                                        <h2 class="text-lg font-bold font-lg text-gray-900 text-left">
                                                            {{ __('Remarks for the Reservation') }}
                                                        </h2>
                                                    </div>
                                                    <div class="w-full">
                                                        <p class="mt-1 text-medium text-gray-600 text-left">
                                                            {{ __('Please be detailed when adding in remarks, this is to make the student understand what they need to comply for the reservation process to be complete:') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <form class="space-y-4 md:space-y-6"
                                                    action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservationStatus', ['id' => $reservation->id, 'status' => 'PENCILBOOKED']) }}
                                        @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                          {{ route('fic.updateReservationStatus', ['id' => $reservation->id, 'status' => 'PENCILBOOKED']) }} @endif"
                                                    method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="flex-grow">
                                                        <textarea type="text" name="reason"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark: dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Enter message" required=""></textarea>
                                                    </div>
                                                    <div class="mt-4">
                                                        <button type="submit"
                                                            class="hover:ring-2 hover:ring-facilityEaseBlue hover:ring-offset-2 text-white flex w-full justify-center rounded-md bg-facilityEaseBlue px-3 py-2 font-semibold hover:bg-facilityEaseBlue transition ease-in-out duration-300">ADD
                                                            REMARKS</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </x-long-modal>
                                    </form>
                                @endif

                                @if ($reservation->status == 'PENDING' || $reservation->status == 'PENCILBOOKED' || $reservation->status == 'DECLINED')
                                    <form
                                        action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservationStatus', ['id' => $reservation->id, 'status' => 'DECLINED']) }} @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0) {{ route('fic.updateReservationStatus', ['id' => $reservation->id, 'status' => 'DECLINED']) }} @endif"
                                        method="post">
                                        @csrf
                                        @method('patch')
                                        @if ($reservation->status !== 'DECLINED')
                                            <button type="submit" x-data=""
                                                x-on:click="$dispatch('open-modal', 'decline')"
                                                class="text-white hover:ring-2 hover:ring-facilityEaseRed hover:ring-offset-2  rounded-lg text-base py-3 px-10 bg-facilityEaseRed transition ease-in-out duration-300"
                                                {{ in_array($reservation->status, ['APPROVED', 'CANCELLED', 'DECLINED']) ? 'disabled' : '' }}
                                                style="{{ in_array($reservation->status, ['APPROVED', 'CANCELLED', 'DECLINED']) ? 'cursor: not-allowed;' : '' }}">
                                                Decline
                                            </button>
                                        @else
                                            <button type="button"
                                                class="text-white ring-2 ring-facilityEaseRed bg-facilityEaseRed ring-offset-2 rounded-lg text-base cursor-not-allowed py-3 px-10"
                                                disabled style="cursor: not-allowed;">
                                                Reservation Declined
                                            </button>
                                        @endif
                                        <x-long-modal name="decline" focusable class="max-w-md">
                                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                                <div class="block w-full justify-items-start">
                                                    <div class="w-full">
                                                        <h2 class="text-lg font-bold font-lg text-gray-900 text-left">
                                                            {{ __('Remarks for the Reservation') }}
                                                        </h2>
                                                    </div>
                                                    <div class="w-full">
                                                        <p class="mt-1 text-medium text-gray-600 text-left">
                                                            {{ __('Please be detailed when adding in remarks, this is to make the student understand what they need to comply for the reservation process to be complete:') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <form class="space-y-4 md:space-y-6"
                                                    action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservationStatus', ['id' => $reservation->id, 'status' => 'DECLINED']) }}
                                                    @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                                      {{ route('fic.updateReservationStatus', ['id' => $reservation->id, 'status' => 'DECLINED']) }} @endif"
                                                    method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="flex-grow">
                                                        <textarea type="text" name="reason"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark: dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Enter message" required=""></textarea>
                                                    </div>
                                                    <div class="mt-4">
                                                        <button type="submit"
                                                            class="hover:ring-2 hover:ring-facilityEaseRed hover:ring-offset-2 text-white flex w-full justify-center rounded-md bg-facilityEaseRed px-3 py-2 font-semibold hover:bg-facilityEaseRed transition ease-in-out duration-300">ADD
                                                            REMARKS</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </x-long-modal>
                                    </form>
                                @endif

                                @if ($reservation->status == 'APPROVED' || $reservation->status == 'REVOKED')
                                    <form
                                        action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservationStatus', ['id' => $reservation->id, 'status' => 'REVOKED']) }} @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0) {{ route('fic.updateReservationStatus', ['id' => $reservation->id, 'status' => 'REVOKED']) }} @endif"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        @if ($reservation->status !== 'REVOKED')
                                            <button type="submit" x-data=""
                                                x-on:click="$dispatch('open-modal', 'revoke')"
                                                class="text-white hover:ring-2 hover:ring-facilityEaseRed hover:ring-offset-2  rounded-lg text-base py-3 px-10 bg-facilityEaseRed transition ease-in-out duration-300">
                                                Revoke
                                            </button>

                                        @endif
                                        <x-long-modal name="revoke" focusable class="max-w-md">
                                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                                <div class="block w-full justify-items-start">
                                                    <div class="w-full">
                                                        <h2 class="text-lg font-bold font-lg text-gray-900 text-left">
                                                            {{ __('Remarks for the Reservation') }}
                                                        </h2>
                                                    </div>
                                                    <div class="w-full">
                                                        <p class="mt-1 text-medium text-gray-600 text-left">
                                                            {{ __('Please be detailed when adding in remarks, this is to make the student understand what they need to comply for the reservation process to be complete:') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <form class="space-y-4 md:space-y-6"
                                                    action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservationStatus', ['id' => $reservation->id, 'status' => 'REVOKED']) }}
                                                    @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                                      {{ route('fic.updateReservationStatus', ['id' => $reservation->id, 'status' => 'REVOKED']) }} @endif"
                                                    method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="flex-grow">
                                                        <textarea type="text" name="reason"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark: dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Enter message" required=""></textarea>
                                                            <h1 class="text-lg font-medium">Please attach required documents | optional:</h1>
                                                        <div class="mt-2 rounded p-2">
                                                            <div class="form-group">
                                                                <input type="file" name="file[]" class="form-control" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-10 px-3">

                                                    </div>
                                                    <div class="mt-4">
                                                        <button type="submit"
                                                            class="hover:ring-2 hover:ring-facilityEaseRed hover:ring-offset-2 text-white flex w-full justify-center rounded-md bg-facilityEaseRed px-3 py-2 font-semibold hover:bg-facilityEaseRed transition ease-in-out duration-300">ADD
                                                            REMARKS</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </x-long-modal>
                                    </form>
                                @endif
                        @endif


                                @if (($reservation->status == 'PENDING' || $reservation->status == 'PENCILBOOKED' || $reservation->status == 'APPROVED' || $reservation->status == 'RESCHEDULED') &&
                                    (Auth::user()->user_role->where('roleID', 3)->count() > 0 ||
                                    Auth::user()->user_role->where('roleID', 4)->count() > 0 ||
                                    Auth::user()->user_role->where('roleID', 5)->count() > 0 ||
                                    Auth::user()->user_role->where('roleID', 6)->count() > 0))
                                    <form>
                                        <button hidden type="submit"
                                            class=" text-base py-3 px-10 border-b-4 border-yellow-600 bg-yellow-500 hover:bg-yellow-400"
                                            disabled style="cursor: not-allowed;">
                                            Pencil Book
                                        </button>
                                    </form>
                                    <form
                                        action="@if (Auth::user()->user_role->where('roleID', 3)->count() > 0) {{ route('user.updateReservationStatus', ['id' => $reservation->id, 'status' => 'CANCELLED']) }}
                                            @elseif (Auth::user()->user_role->where('roleID', 4)->count() > 0)
                                                {{ route('user.updateReservationStatus', ['id' => $reservation->id, 'status' => 'CANCELLED']) }}
                                            @elseif (Auth::user()->user_role->where('roleID', 5)->count() > 0)
                                                {{ route('user.updateReservationStatus', ['id' => $reservation->id, 'status' => 'CANCELLED']) }}
                                            @elseif (Auth::user()->user_role->where('roleID', 6)->count() > 0)
                                                {{ route('user.updateReservationStatus', ['id' => $reservation->id, 'status' => 'CANCELLED']) }} @endif"
                                        method="post">
                                        @csrf
                                        @method('patch')
                                        @if ($reservation->status !== 'CANCELLED')
                                            <button type="submit" x-data=""
                                                x-on:click="$dispatch('open-modal', 'cancel')"
                                                class="text-white hover:ring-2 hover:ring-facilityEaseRed hover:ring-offset-2  rounded-lg text-base py-3 px-10 bg-facilityEaseRed transition ease-in-out duration-300"
                                                {{ in_array($reservation->status, ['CANCELLED', 'DECLINED']) ? 'disabled' : '' }}
                                                style="{{ in_array($reservation->status, ['CANCELLED', 'DECLINED']) ? 'cursor: not-allowed;' : '' }}">
                                                Cancel
                                            </button>
                                        @else
                                            <button type="button"
                                                class="text-white ring-2 ring-facilityEaseRed bg-facilityEaseRed ring-offset-2 rounded-lg text-base cursor-not-allowed py-3 px-10"
                                                disabled style="cursor: not-allowed;">
                                                Reservation Cancelled
                                            </button>
                                        @endif
                                        <x-long-modal name="cancel" focusable class="max-w-md">
                                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                                <div class="block w-full justify-items-start">
                                                    <div class="w-full">
                                                        <h2 class="text-lg font-bold font-lg text-gray-900 text-left">
                                                            {{ __('Remarks for the Reservation') }}
                                                        </h2>
                                                    </div>
                                                    <div class="w-full">
                                                        <p class="mt-1 text-medium text-gray-600 text-left">
                                                            {{ __('Please be detailed when adding in remarks, this is to make the student understand what they need to comply for the reservation process to be complete:') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <form class="space-y-4 md:space-y-6"
                                                    action="@if (Auth::user()->user_role->where('roleID', 3)->count() > 0) {{ route('user.updateReservationStatus', ['id' => $reservation->id, 'status' => 'CANCELLED']) }}
                                                        @elseif (Auth::user()->user_role->where('roleID', 4)->count() > 0)
                                                            {{ route('user.updateReservationStatus', ['id' => $reservation->id, 'status' => 'CANCELLED']) }}
                                                        @elseif (Auth::user()->user_role->where('roleID', 5)->count() > 0)
                                                            {{ route('user.updateReservationStatus', ['id' => $reservation->id, 'status' => 'CANCELLED']) }}
                                                        @elseif (Auth::user()->user_role->where('roleID', 6)->count() > 0)
                                                            {{ route('user.updateReservationStatus', ['id' => $reservation->id, 'status' => 'CANCELLED']) }} @endif"
                                                    method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="flex-grow">
                                                        <textarea type="text" name="reason"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark: dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Enter message" required=""></textarea>
                                                    </div>
                                                    <div class="mt-4">
                                                        <button type="submit"
                                                            class="hover:ring-2 hover:ring-facilityEaseRed hover:ring-offset-2 text-white flex w-full justify-center rounded-md bg-facilityEaseRed px-3 py-2 font-semibold hover:bg-facilityEaseRed transition ease-in-out duration-300">ADD
                                                            REMARKS</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </x-long-modal>
                                    </form>
                                @endif
                            </div>
                    </form>
                    @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0 ||
                                Auth::User()->User_Role->where('roleID', 2)->count() > 0)

                                @if ($reservation->status == 'REVOKED')

                                    <div class="flex flex-grow justify-end">
                                                    <button x-data="" x-on:click="$dispatch('open-modal', 'facility-type')"
                                                    class="text-white hover:ring-2 hover:ring-facilityEaseMain hover:ring-offset-2  rounded-lg text-base py-3 px-10 bg-facilityEaseMain transition ease-in-out duration-300">
                                                    Reschedule
                                                    </button>
                                    </div>
                                            <x-long-modal name="facility-type" focusable class="max-w-md">
                                                <div class="p-4 flex flex-wrap justify-center items-center w-full rounded-lg bg-white shadow">
                                                    @foreach ($facilities as $facility)
                                                        <div class="w-md h-md m-2 flex flex-col justify-between text-center rounded-md shadow-md hover:shadow-facilityEaseSecondary bg-gray-200 transition ease-in-out duration-300">
                                                            <div class="block w-56 h-64">
                                                                <div class="relative items-center justify-center rounded-full">
                                                                    <a href="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('updateReservationFormReschedule', ['universityID' => Auth::User()->universityID, 'id' => $reservation->id ,'facilityId' => $facility->id]) }}
                                                                        @elseif(Auth::user()->user_role->where('roleID', 2)->count() > 0)
                                                                            {{ route('fic.updateReservationFormReschedule', ['universityID' => Auth::User()->universityID,  'id' => $reservation->id ,'facilityId' => $facility->id]) }}
                                                                        @endif"
                                                                        class="flex flex-col items-center justify-between hover:text-facilityEaseBlue transition ease-in-out duration-300">

                                                                        <div class="mt-3 px-1 justify-center text-lg font-semibold">
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
                                @endif
                    @endif
                </div>
            </div>
        </div>
    </div>



    <style>
        .grid {
            text-align: right;
            display: flex;
            justify-content: flex-end;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 999;
        }

        .overlay-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            width: 50%;
            height: 100%;
            transform: translate(-50%, -50%);
            overflow-y: auto;
        }
    </style>
    <script>
        function openDeclineReasonOverlay() {
            var addDeclineReasonOverlay = document.getElementById('addDeclineReasonOverlay');
            addDeclineReasonOverlay.style.display = 'block';
        }

        function closeDeclineReasonOverlay() {
            var addDeclineReasonOverlay = document.getElementById('addDeclineReasonOverlay');
            addDeclineReasonOverlay.style.display = 'none';
        }

        function openPencilReasonOverlay() {
            var addPencilReasonOverlay = document.getElementById('addPencilReasonOverlay');
            addPencilReasonOverlay.style.display = 'block';
        }

        // Handle form submission after entering a reason
        function submitDeclineForm() {
            document.getElementById('declineForm').submit();
        }

        function submitPencilForm() {
            document.getElementById('pencilForm').submit();
        }

        function openCancelReasonOverlay() {
            var addCancelReasonOverlay = document.getElementById('addCancelReasonOverlay');
            addCancelReasonOverlay.style.display = 'block';
        }

        function closeCancelReasonOverlay() {
            var addCancelReasonOverlay = document.getElementById('addCancelReasonOverlay');
            addCancelReasonOverlay.style.display = 'none';
        }

        // Handle form submission after entering a reason
        function submitCancelForm() {
            document.getElementById('cancelForm').submit();
        }
    </script>
@endsection
