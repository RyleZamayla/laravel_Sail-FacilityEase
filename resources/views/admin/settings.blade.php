@extends('layouts.app')

@section('content')
    @if (session('role-toggle-status-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('Role status updated successfully!') }}
            </p>
        </div>
    @endif
    @if (session('campus-toggle-status-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('Campus status updated successfully!') }}
            </p>
        </div>
    @endif
    @if (session('building-data-edit-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('Building data updated successfully!') }}
            </p>
        </div>
    @endif
    @if (session('user-organization-toggle-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('Organization status updated successfully!') }}
            </p>
        </div>
    @endif
    @if (session('org-data-edit-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('Organization data updated successfully!') }}
            </p>
        </div>
    @endif
    @if (session('user-data-edit-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('User Information updated successfully!') }}
            </p>
        </div>
    @endif
    @if (session('user-status-toggle-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('User status updated successfully!') }}
            </p>
        </div>
    @endif
    @if (session('building-toggle-status-success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseGreen justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('Building status updated successfully!') }}
            </p>
        </div>
    @endif
    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95"
            class="flex w-full bg-facilityEaseRed justify-end items-center">
            <p class="text-lg text-white mr-10 py-2">
                {{ __('There was a problem processing your action!') }}
            </p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl p-4">
                    @include('admin.partials.roles')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl p-4">
                    @include('admin.partials.campus')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-5xl p-4">
                    @include('admin.partials.buildings')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    @include('admin.partials.users')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    @include('admin.partials.organizations')
                </div>
            </div>
        </div>
    </div>
@endsection

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
            $('.userType').select2({
                theme: 'bootstrap-5',
                minimumResultsForSearch: -1
            });
            $('.campus').select2({
                theme: 'bootstrap-5',
                minimumResultsForSearch: -1
            });

            $('.campus').on('change', function() {
                var campusID = this.value;
                $(".college").html('<option value="" hidden>Select College</option>');
                $.ajax({
                    url: "{{ url('api/getColleges') }}",
                    type: "POST",
                    data: {
                        campusID: campusID
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result, function(key, value) {
                            $(".college").append('<option value="' + value.id + '">' +
                                value.college + '</option>');
                        });
                    }
                });
            });


            $('.campus').on('change', function() {
                var campusID = this.value;
                $(".office").html('<option value="" hidden>Select Office</option>');
                $.ajax({
                    url: "{{ url('api/getOffices') }}",
                    type: "POST",
                    data: {
                        campusID: campusID
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result, function(key, value) {
                            $(".office").append(
                                '<option value="' + value
                                .id + '">' + value.office +
                                '</option>');
                        });
                    }


                });
            });

            $('.userType').change(function() {
                var userType = this.value;
                var studentLeader;

                if (userType == 5) {
                    studentLeader = true;
                }

                $('.academic-container').hide();
                $('.nonacademic-container').hide();
                $('.organization-container').hide();

                if (userType == 6 || userType == 4 || userType == 5) {
                    $('.college').select2({
                        theme: 'bootstrap-5'
                    });

                    $('.department').select2({
                        theme: 'bootstrap-5'
                    });

                    $('.academic-container').show();
                    $('.nonacademic-container').hide();
                    $('.organization-container').hide();

                    if (studentLeader == true) {
                        $('.organization').select2({
                            theme: 'bootstrap-5'
                        });

                        $('.organization-container').show();
                    }




                    $('.college').on('change', function() {
                        var departmentID = this.value;
                        $(".department").html('<option value="" hidden>Select Department</option>');
                        $.ajax({
                            url: "{{ url('api/getDepartments') }}",
                            type: "POST",
                            data: {
                                departmentID: departmentID
                            },
                            dataType: 'json',
                            success: function(result) {
                                $.each(result, function(key, value) {
                                    $(".department").append('<option value="' +
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
                                    $(".college").append('<option value="' + value.id +
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
                                        $(".department").append('<option value="' +
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
                    $('.office').select2({
                        theme: 'bootstrap-5'
                    });

                    $('.position').select2({
                        theme: 'bootstrap-5'
                    });

                    $('.academic-container').hide();
                    $('.nonacademic-container').show();
                    $('.organization-container').hide();

                    $('.office').on('change', function() {
                        var positionID = this.value;
                        $(".position").html('<option value="" hidden>Select Position</option>');
                        $.ajax({
                            url: "{{ url('api/getPositions') }}",
                            type: "POST",
                            data: {
                                positionID: positionID
                            },
                            dataType: 'json',
                            success: function(result) {
                                $.each(result, function(key, value) {
                                    $(".position").append(
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
                                    $(".office").append('<option value="' + value.id +
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
                                        $(".position").append('<option value="' +
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

        });
    </script>
@endpush

