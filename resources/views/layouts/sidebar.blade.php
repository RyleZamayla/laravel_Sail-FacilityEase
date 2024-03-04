<div id="sidebar" class="px-3">
    <div class="block font-bold pt-3 pb-4">
        <img class="mx-auto h-auto w-auto "src="{{ asset('images/dark_noBG_FacilityEase_logo.png') }}">
    </div>

    <div id="profile" class="space-y-3">

        <div class="flex items-start justify-center">
            <a href="{{ route('profile.edit') }}">
                <div
                    class="relative inline-flex items-center justify-center p-1 overflow-hidden bg-facilityEaseMain rounded-full">
                    <div
                        class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full">
                        <img src="{{ old('img', Auth::user()->profile_image) }}" alt="Avatar user" />
                    </div>
                </div>
            </a>
        </div>

        <div>
            <h2 class="font-medium text-base text-center text-white">
                {{ Auth::User()->fName }} {{ substr(Auth::User()->mName, 0, 1) }}.
                {{ Auth::User()->lName }}
            </h2>
            <p class="text-xs text-facilityEaseMain text-bold text-center">
                @if (Auth::User()->Academic)
                    @if (Auth::User()->Academic->college == 'College of Technology')
                        COT - {{ Auth::User()->Academic->department }}
                    @elseif (Auth::User()->Academic->college == 'College of Engineering and Architecture')
                        CEA - {{ Auth::User()->Academic->department }}
                    @elseif (Auth::User()->Academic->college == 'College of Science and Mathematics')
                        CSM - {{ Auth::User()->Academic->department }}
                    @elseif (Auth::User()->Academic->college == 'College of Science and Technology Education')
                        CSTE - {{ Auth::User()->Academic->department }}
                    @elseif (Auth::User()->Academic->college == 'College of Information Technology and Computing')
                        CITC - {{ Auth::User()->Academic->department }}
                    @elseif (Auth::User()->Academic->college == 'Senior High School Department')
                        {{ Auth::User()->Academic->college }}
                    @endif
                    {{-- {{ Auth::User()->Academic->first()->college }} - --}}
                @endif

                @if (Auth::User()->Nonacademic)
                    {{ Auth::User()->Nonacademic->office }} -
                    {{ Auth::User()->Nonacademic->position }}
                @endif
            </p>
            <p class="text-xs text-white text-center">
                @if (Auth::User()->User_Role->count() > 0)
                    @php
                        $roleID = Auth::User()->User_Role->first()->roleID;
                    @endphp

                    @if ($roleID == 1)
                        Admin
                    @elseif($roleID == 2)
                        Facility in-charge
                    @elseif($roleID == 3)
                        Staff
                    @elseif($roleID == 4)
                        Faculty
                    @elseif($roleID == 5)
                        Student Leader
                    @elseif($roleID == 6)
                        Student
                    @endif
                @endif
            </p>
        </div>
    </div>
    <!-- Only show icons for the menu items -->
    <ul class="flex flex-col py-4 space-y-1">
        <li class="px-2">
            <div class="flex flex-row items-center h-8">
                <div class="text-sm font-light tracking-wide text-gray-300">Menu</div>
            </div>
        </li>
        <li>
            <a href="{{ route('dashboard') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                {{ request()->routeIs('dashboard') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
            </a>
        </li>
        <li>
            @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0 || Auth::User()->User_Role->where('roleID', 2)->count() > 0)
                @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0)
                 <a href=" {{ route('scanner') }}"
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                    {{ request()->routeIs('scanner') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                    ">
                    <span class="inline-flex justify-center items-center ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">QRcode Scanner</span>
                </a>
                @elseif (Auth::User()->User_Role->where('roleID', 2)->count() > 0)
                <a href=" {{ route('fic.scanner') }}"
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                    {{ request()->routeIs('fic.scanner') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                    ">
                    <span class="inline-flex justify-center items-center ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">QRcode Scanner</span>
                </a>
                @endif
            @endif
        </li>
        <li>
            @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0)
            <a href= "{{ route('showReservations', ['universityID' => Auth::User()->universityID]) }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                {{ request()->routeIs('showReservations') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                {{ request()->routeIs('reservationForm') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                {{ request()->routeIs('showReservationById') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                {{ request()->routeIs('updateReservation') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                {{ request()->routeIs('updateReservationFormReschedule') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Reservations</span>
            </a>
            @elseif (Auth::User()->User_Role->where('roleID', 2)->count() > 0)
            <a href= "{{ route('fic.showReservations', ['universityID' => Auth::User()->universityID]) }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                {{ request()->routeIs('fic.showReservations') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                {{ request()->routeIs('fic.reservationForm') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                {{ request()->routeIs('showReservationById') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                {{ request()->routeIs('fic.updateReservation') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                {{ request()->routeIs('fic.updateReservationFormReschedule') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Reservations</span>
            </a>
            @elseif (Auth::User()->User_Role->where('roleID', 3 || 4 || 5)->count() > 0)
            <a href= "{{ route('user.showReservations', ['universityID' => Auth::User()->universityID]) }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                {{ request()->routeIs('user.showReservations') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                {{ request()->routeIs('user.reservationForm') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                {{ request()->routeIs('user.showReservationById') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                {{ request()->routeIs('user.updateReservation') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Reservations</span>
            </a>
            @endif
        </li>
        <li>
            @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0)
            <a href="{{ route('facilities') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                {{ request()->routeIs('facilities') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Facilities</span>
            </a>
            @elseif (Auth::User()->User_Role->where('roleID', 2)->count() > 0)
            <a href="{{ route('fic.facilities') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                {{ request()->routeIs('fic.facilities') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Facilities</span>
            </a>
            @elseif (Auth::User()->User_Role->where('roleID', 3 || 4 || 5)->count() > 0)
            <a href="{{ route('user.facilities') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                {{ request()->routeIs('user.facilities') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Facilities</span>
            </a>
            @endif
        </li>
        @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0 || Auth::User()->User_Role->where('roleID', 2)->count() > 0)
            <li>
                @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0)
                    <a href="{{ route('equipment') }}"
                        class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                        {{ request()->routeIs('equipment') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                        ">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Equipments</span>
                    </a>
                @endif
                @if (Auth::User()->User_Role->where('roleID', 2)->count() > 0)
                    <a href="{{ route('fic.equipment') }}"
                        class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                        {{ request()->routeIs('fic.equipment') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                        ">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Equipments</span>
                    </a>
                @endif
            </li>
            <li>
                @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0)
                    <a href="{{ route('report') }}"
                        class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                        {{ request()->routeIs('report') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                        ">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Reports</span>
                    </a>
                @elseif (Auth::User()->User_Role->where('roleID', 2)->count() > 0)
                    <a href="{{ route('fic.report') }}"
                        class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                        {{ request()->routeIs('fic.report') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                        ">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Reports</span>
                    </a>
                @endif
            </li>
        @endif
        <li class="px-2">
            <div class="flex flex-row items-center h-8">
                <div class="text-sm font-light tracking-wide text-gray-300">Configurations</div>
            </div>
        </li>
        <li>
            <a href="{{ route('profile.edit') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                {{ request()->routeIs('profile.edit') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                ">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Profile</span>
            </a>
        </li>
        @if (Auth::User()->User_Role->where('roleID', 1)->count() > 0)
            <li>
                <a href="{{ route('admin.settings') }}"
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white hover:text-facilityEaseSecondary border-l-4 border-transparent hover:border-facilityEaseMain pr-6 w-full transition ease-in-out duration-300
                    {{ request()->routeIs('admin.settings') ? 'bg-facilityEaseDarkGrey text-facilityEaseSecondary border-l-4 border-facilityEaseBlue' : '' }}
                    ">
                    <span class="inline-flex justify-center items-center ml-4">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate" sidebar-toggle-item>Settings</span>


                </a>
            </li>
        @endif

        <li class="pt-12 pb-10">
            <form method="POST" action="{{ route('logout') }}"
                class="cursor-pointer">
                @csrf
                <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-facilityEaseDarkGrey text-white border-l-4 border-transparent hover:border-facilityEaseMain hover:text-facilityEaseSecondary pr-6 w-full transition ease-in-out duration-300">
                    <span class="inline-flex justify-center items-center ml-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Logout</span>
                </a>
            </form>
        </li>
    </ul>
</div>
