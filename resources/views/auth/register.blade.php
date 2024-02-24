<x-guest-layout>


    <div class="lg:w-1/2 md:w-full">
        <div class="w-full bg-gray-800 border-gray-700 rounded-lg p-4 m-6 shadow-lg">
            <!--Logo-->
            <div class="text-center">
                <img class="mx-auto w-48" src="{{ asset('images/FacilityEaseLogo.png') }}" alt="FacilityEase Logo" />
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="flex">
                    <!-- First Name -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex">
                            <x-input-label style="color:white" class="font-bold" for="fName" :value="__('First name')" />
                            <span class="text-red-500 ml-1">*</span>
                        </div>
                        <x-text-input id="fName" class="block mt-1 w-full " type="text" name="fName"
                            :value="old('fName')" autofocus autocomplete="off" />
                        <x-input-error :messages="$errors->get('fName')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                    <!-- Middle Name -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex">
                            <x-input-label style="color:white" class="font-bold" for="mName" :value="__('Middle name')" />
                            <span class="text-red-500 ml-1 opacity-0">*</span>
                        </div>
                        <x-text-input id="mName" class="block mt-1 w-full " type="text" name="mName"
                            :value="old('mName')" autofocus autocomplete="off" />
                        <x-input-error :messages="$errors->get('mName')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                    <!-- Last Name -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex">
                            <x-input-label style="color:white" class="font-bold" for="lName" :value="__('Last name')" />
                            <span class="text-red-500 ml-1">*</span>
                        </div>
                        <x-text-input id="lName" class="block mt-1 w-full " type="text" name="lName"
                            :value="old('lName')" autofocus autocomplete="off" />
                        <x-input-error :messages="$errors->get('lName')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>
                </div>

                <div class="flex">
                    <!-- User Type -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between my-1">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="userType" :value="__('User Type')" />
                                <span class="text-red-500 ml-1">*</span>
                            </div>
                            <span class="italic text-xs text-facilityEaseDarkGrey ml-1">select user type to display
                                additional fields</span>

                        </div>
                        <select name="userType" id="userType" class="cursor-pointer block mt-1 w-full" autofocus
                            autocomplete="off">
                            <option value="" hidden>Select User type</option>
                            @foreach ($roleData['roles']->reverse() as $data)
                                <option value="{{ $data->id }}"
                                    {{ old('userType') == $data->id ? 'selected' : '' }}>
                                    {{ $data->role }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('userType')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                    <!-- Campus -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between my-1">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="campus"
                                    :value="__('Campus')" />
                                <span class="text-red-500 ml-1">*</span>
                            </div>
                        </div>
                        <select name="campus" id="campus" class="cursor-pointer block mt-1 w-full" autofocus
                            autocomplete="off">
                            <option value="" hidden>Select Campus</option>
                            @foreach ($campusData['campuses'] as $data)
                                <option value="{{ $data->id }}" {{ old('campus') == $data->id ? 'selected' : '' }}>
                                    {{ $data->campus }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('campus')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                </div>

                <div id="academic-container">
                    <!-- Colleges -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between my-1">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="college"
                                    :value="__('College')" />
                                <span class="text-red-500 ml-1">*</span>
                            </div>
                            <span class="italic text-xs text-facilityEaseDarkGrey ml-1">select a campus first to load
                                colleges</span>
                        </div>
                        <select name="college" id="college" class="cursor-pointer block mt-1 w-full" autofocus
                            autocomplete="off">
                            <option value="" hidden>Select College</option>
                        </select>
                        <x-input-error :messages="$errors->get('college')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                    <!-- Departments -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between my-1">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="department"
                                    :value="__('Department')" />
                                <span class="text-red-500 text-opacity-0 ml-1">*</span>
                            </div>
                            <span class="italic text-xs text-facilityEaseDarkGrey ml-1">select a college first to load
                                departments, some colleges might not have departments</span>

                        </div>
                        <select name="department" id="department" class="cursor-pointer block mt-1 w-full" autofocus
                            autocomplete="off">
                            <option value="" hidden>Select Department</option>
                        </select>
                        <x-input-error :messages="$errors->get('department')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                </div>

                <div id="organization-container">
                    <!-- Organizations -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between my-1">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="organization"
                                    :value="__('Organization')" />
                                <span class="text-red-500 ml-1">*</span>
                            </div>
                            <span class="italic text-xs text-facilityEaseDarkGrey ml-1">some organizations might now
                                show up due to them not being accredited</span>
                        </div>
                        <select name="organization" id="organization" class="cursor-pointer block mt-1 w-full"
                            autofocus autocomplete="off">
                            <option value="" hidden>Select Organization</option>
                            @foreach ($organizationData['organizations'] as $data)
                                <option value="{{ $data->id }}"
                                    {{ old('organization') == $data->id ? 'selected' : '' }}>
                                    {{ $data->orgName }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('organization')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                    <!-- Org Position -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex">
                            <x-input-label style="color:white" class="font-bold" for="orgPosition"
                                :value="__('Position')" />
                            <span class="text-red-500 ml-1">*</span>
                        </div>
                        <x-text-input id="orgPosition" class="block mt-1 w-full " type="text" name="orgPosition"
                            :value="old('orgPosition')" autofocus autocomplete="off" />
                        <x-input-error :messages="$errors->get('orgPosition')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>
                    {{-- @endif --}}
                </div>


                <div id="nonacademic-container">
                    <!-- Offices -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between my-1">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="office"
                                    :value="__('Office')" />
                                <span class="text-red-500 ml-1">*</span>
                            </div>
                            <span class="italic text-xs text-facilityEaseDarkGrey ml-1">select a campus first to load
                                offices</span>

                        </div>
                        <select name="office" id="office" class="cursor-pointer block mt-1 w-full">
                            <option value="" hidden>Select Office</option>
                        </select>
                        <x-input-error :messages="$errors->get('office')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                    <!-- Positions -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between my-1">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="position"
                                    :value="__('Position')" />
                                <span class="text-red-500 text-opacity-0 ml-1">*</span>
                            </div>
                            <span class="italic text-xs text-facilityEaseDarkGrey ml-1">select an office first to load
                                positions, some offices might not have positions</span>

                        </div>
                        <select name="position" id="position" class="cursor-pointer block mt-1 w-full">
                            <option value="" hidden>Select Position</option>
                        </select>
                        <x-input-error :messages="$errors->get('position')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                </div>

                <div class="flex">
                    <!-- UniversityID -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex">
                            <x-input-label style="color:white" class="font-bold" for="universityID"
                                :value="__('University ID')" />
                            <span class="text-red-500 ml-1">*</span>
                        </div>
                        <x-text-input id="universityID" class="block mt-1 w-full " type="text"
                            name="universityID" :value="old('universityID')" autocomplete="off" />
                        <x-input-error :messages="$errors->get('universityID')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                    <!-- Contact Number -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="cNumber"
                                    :value="__('Contact number')" />
                                <span class="text-red-500 ml-1">*</span>
                            </div>
                        </div>
                        <x-text-input id="cNumber" class="block mt-1 w-full " type="text" name="cNumber"
                            :value="old('cNumber')" autocomplete="off" />
                        <x-input-error :messages="$errors->get('cNumber')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>
                </div>


                <!-- Email Address -->
                <div class="mt-3 mx-1">
                    <div class="flex items-end justify-between my-1">
                        <div class="flex">
                            <x-input-label style="color:white" class="font-bold" for="email" :value="__('Email')" />
                            <span class="text-red-500 ml-1">*</span>
                        </div>
                        <span class="italic text-xs text-facilityEaseDarkGrey ml-1">email should be your current active
                            email</span>
                    </div>
                    <x-text-input id="email" class="block mt-1 w-full " type="text" type="email"
                        name="email" :value="old('email')" autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')"
                        class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                </div>

                <div class="flex">
                    <!-- Password -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between my-1">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="password"
                                    :value="__('Password')" />
                                <span class="text-red-500 ml-1">*</span>
                            </div>
                            <span class="italic text-xs text-facilityEaseDarkGrey ml-1">password should have at least 8
                                characters</span>
                        </div>

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                            autocomplete="new-password" :value="old('password')" />

                        <x-input-error :messages="$errors->get('password')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-3 flex-1 mx-1">
                        <div class="flex items-end justify-between my-1">
                            <div class="flex">
                                <x-input-label style="color:white" class="font-bold" for="password_confirmation"
                                    :value="__('Confirm Password')" />
                                <span class="text-red-500 ml-1">*</span>
                            </div>
                            <span class="italic text-xs text-facilityEaseDarkGrey ml-1">confirm password should have the same value of password</span>
                        </div>

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" autocomplete="new-password" :value="old('password_confirmation')" />

                        <x-input-error :messages="$errors->get('password_confirmation')"
                            class="mt-2 text-facilityEaseRed font-bold italic text-sm text-right my-1" />
                    </div>
                </div>


                <!-- Error Session handler -->
                @if (session('error'))
                    <div class="mt-2 alert alert-danger alert-right">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mt-3 mx-1">
                    <x-primary-button style="padding: 0.75rem; font-size: 1rem;"
                        class="mt-3 flex items-center justify-center w-full text-facilityease border-facilityEaseDarkGrey hover:border-facilityEaseSecondary hover:text-facilityEaseWhite bg-facilityEaseMain hover:bg-facilityEaseBlue focus:bg-facilityEaseBlue focus:text-facilityEaseWhite text-gray-800 transition ease-in-out duration-300 ">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>


                <p class="mt-6 text-center text-sm text-gray-400">
                    Already registered?
                    <a href="{{ route('login') }}"
                        class="font-semibold leading-6 text-indigo-400 hover:text-facilityEaseMain transition ease-in-out duration-300">Let's
                        get you inside, Trailblazer!</a>
                </p>
            </form>

        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#userType').select2({
                    theme: 'bootstrap-5',
                    minimumResultsForSearch: -1
                });
                $('#campus').select2({
                    theme: 'bootstrap-5',
                    minimumResultsForSearch: -1
                });

                $('#campus').on('change', function() {
                    var campusID = this.value;
                    $("#college").html('<option value="" hidden>Select College</option>');
                    $.ajax({
                        url: "{{ url('api/getColleges') }}",
                        type: "POST",
                        data: {
                            campusID: campusID
                        },
                        dataType: 'json',
                        success: function(result) {
                            $.each(result, function(key, value) {
                                $("#college").append('<option value="' + value.id + '">' +
                                    value.college + '</option>');
                            });
                        }
                    });
                });


                $('#campus').on('change', function() {
                    var campusID = this.value;
                    $("#office").html('<option value="" hidden>Select Office</option>');
                    $.ajax({
                        url: "{{ url('api/getOffices') }}",
                        type: "POST",
                        data: {
                            campusID: campusID
                        },
                        dataType: 'json',
                        success: function(result) {
                            $.each(result, function(key, value) {
                                $("#office").append(
                                    '<option value="' + value
                                    .id + '">' + value.office +
                                    '</option>');
                            });
                        }


                    });
                });

                $('#userType').change(function() {
                    var userType = this.value;
                    var studentLeader;

                    if (userType == 5) {
                        studentLeader = true;
                    }

                    $('#academic-container').hide();
                    $('#nonacademic-container').hide();
                    $('#organization-container').hide();

                    if (userType == 6 || userType == 4 || userType == 5) {
                        $('#college').select2({
                            theme: 'bootstrap-5'
                        });

                        $('#department').select2({
                            theme: 'bootstrap-5'
                        });

                        $('#academic-container').show();
                        $('#nonacademic-container').hide();
                        $('#organization-container').hide();

                        if (studentLeader == true) {
                            $('#organization').select2({
                                theme: 'bootstrap-5'
                            });

                            $('#organization-container').show();
                        }




                        $('#college').on('change', function() {
                            var departmentID = this.value;
                            $("#department").html('<option value="" hidden>Select Department</option>');
                            $.ajax({
                                url: "{{ url('api/getDepartments') }}",
                                type: "POST",
                                data: {
                                    departmentID: departmentID
                                },
                                dataType: 'json',
                                success: function(result) {
                                    $.each(result, function(key, value) {
                                        $("#department").append('<option value="' +
                                            value
                                            .id + '">' + value.department +
                                            '</option>');
                                    });
                                }
                            });
                        });

                        var oldCampusID = "{{ old('campus') }}";
                        var oldCollegeID = "{{ old('college') }}";
                        var oldDepartmentID = "{{ old('department') }}";

                        if (oldCampusID) {
                            $.ajax({
                                url: "{{ url('api/getColleges') }}",
                                type: "POST",
                                data: {
                                    campusID: oldCampusID
                                },
                                dataType: 'json',
                                success: function(result) {
                                    $.each(result, function(key, value) {
                                        $("#college").append('<option value="' + value.id +
                                            '" ' + (
                                                oldCollegeID == value.id ? 'selected' :
                                                '') + '>' +
                                            value.college + '</option>');
                                    });
                                }
                            });

                            if (oldCollegeID) {
                                $.ajax({
                                    url: "{{ url('api/getDepartments') }}",
                                    type: "POST",
                                    data: {
                                        departmentID: oldCollegeID
                                    },
                                    dataType: 'json',
                                    success: function(result) {
                                        $.each(result, function(key, value) {
                                            $("#department").append('<option value="' +
                                                value.id + '" ' + (
                                                    oldDepartmentID == value.id ?
                                                    'selected' : '') +
                                                '>' + value.department + '</option>');
                                        });
                                    }
                                });
                            }
                        }
                    }
                    if (userType == 3 || userType == 2 || userType == 1) {
                        $('#office').select2({
                            theme: 'bootstrap-5'
                        });

                        $('#position').select2({
                            theme: 'bootstrap-5'
                        });

                        $('#academic-container').hide();
                        $('#nonacademic-container').show();
                        $('#organization-container').hide();

                        $('#office').on('change', function() {
                            var positionID = this.value;
                            $("#position").html('<option value="" hidden>Select Position</option>');
                            $.ajax({
                                url: "{{ url('api/getPositions') }}",
                                type: "POST",
                                data: {
                                    positionID: positionID
                                },
                                dataType: 'json',
                                success: function(result) {
                                    $.each(result, function(key, value) {
                                        $("#position").append(
                                            '<option value="' + value
                                            .id + '">' + value.position +
                                            '</option>');
                                    });
                                }
                            });
                        });

                        var oldCampusID = "{{ old('campus') }}";
                        var oldOfficeID = "{{ old('office') }}";
                        var oldPositionID = "{{ old('position') }}";

                        if (oldCampusID) {
                            $.ajax({
                                url: "{{ url('api/getOffices') }}",
                                type: "POST",
                                data: {
                                    campusID: oldCampusID
                                },
                                dataType: 'json',
                                success: function(result) {
                                    $.each(result, function(key, value) {
                                        $("#office").append('<option value="' + value.id +
                                            '" ' + (
                                                oldOfficeID == value.id ? 'selected' :
                                                '') + '>' +
                                            value.office + '</option>');
                                    });
                                }
                            });

                            if (oldOfficeID) {
                                $.ajax({
                                    url: "{{ url('api/getPositions') }}",
                                    type: "POST",
                                    data: {
                                        positionID: oldOfficeID
                                    },
                                    dataType: 'json',
                                    success: function(result) {
                                        $.each(result, function(key, value) {
                                            $("#position").append('<option value="' +
                                                value.id + '" ' + (
                                                    oldPositionID == value.id ?
                                                    'selected' : '') +
                                                '>' + value.position + '</option>');
                                        });
                                    }
                                });
                            }
                        }
                    }
                }).change();

                $('#building').select2({
                    theme: 'bootstrap-5'
                });
                $('#floors').select2({
                    theme: 'bootstrap-5'
                });
                $('#userRoleID').select2({
                    theme: 'bootstrap-5'
                });
                $('#facilities').select2({
                    theme: 'bootstrap-5'
                });

                $('#building').on('change', function() {
                    var buildingID = this.value;
                    $("#floors").html('<option value="" hidden>Select Floors</option>');
                    $.ajax({
                        url: "{{ url('api/getFloors') }}",
                        type: "POST",
                        data: {
                            buildingID: buildingID
                        },
                        dataType: 'json',
                        success: function(result) {
                            $.each(result, function(key, value) {
                                var ordinalFloor = getOrdinal(value.floorNumber) + ' Floor';
                                $("#floors").append('<option value="' + value.id + '">' +
                                    ordinalFloor + '</option>');
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-guest-layout>
