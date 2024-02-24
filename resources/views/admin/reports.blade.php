@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Success!</strong> {{ session('success') }}.
        </div>
    @endif

    <div class="my-6">
        <div class="flex flex-row max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="lg:w-1/2 p-4 sm:p-8 bg-white shadow sm:rounded-lg h-fit mr-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Generate Reports') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('This page is a comprehensive way to generate the peak utilization rate of all reservation queries in a specific time frame.') }}
                    </p>
                </header>
                <div class="flex flex-col">
                    <div class="flex-1">
                        <form
                            action="@if (Auth::user()->user_role->where('roleID', 1)->count() > 0) {{ route('result') }}
                    @elseif (Auth::user()->user_role->where('roleID', 2)->count() > 0){{ route('fic.result') }} @endif"
                            method="post">
                            @csrf
                            <div class="flex flex-row justify-evenly mt-10">
                                <div class="flex-1 w-full sm:w-100">
                                    <div class="mt-2">
                                        <label for="filter" class="block text-base font-medium">
                                            Filter by:
                                        </label>
                                        <select name="filter" id="filter"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md cursor-pointer"
                                            required>
                                            <option value="">Select an option</option>
                                            <option value="custom">Daily</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="yearly">Yearly</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('filter'))
                                        <div class="mt-2 text-facilityEaseRed font-bold italic text-sm">
                                            {{ $errors->first('filter') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 ml-3 w-full sm:w-1/2">
                                    <div class="mt-2">
                                        <label for="startDate" class="block text-base font-medium">
                                            Start Date:
                                        </label>
                                        <input type="date" name="startDate" id="startDate" value="{{ old('startDate') }}"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                            required />
                                    </div>
                                    @if ($errors->has('startDate'))
                                        <div class="mt-2 text-facilityEaseRed font-bold italic text-sm">
                                            {{ $errors->first('startDate') }}</div>
                                    @endif
                                </div>
                                <div class="flex-1 ml-3 w-full sm:w-1/2">
                                    <div class="mt-2">
                                        <label for="endDate" class="block text-base font-medium">
                                            End Date:
                                        </label>
                                        <input type="date" name="endDate" id="endDate" value="{{ old('endDate') }}"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                    </div>
                                    @if ($errors->has('endDate'))
                                        <div class="mt-2 text-facilityEaseRed font-bold italic text-sm">
                                            {{ $errors->first('endDate') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="my-3">
                                <button type="submit"
                                    class="hover:ring-2 hover:ring-facilityEaseGreen hover:ring-offset-2 flex w-full justify-center rounded-md bg-facilityEaseGreen text-white px-3 py-2 text-sm font-semibold hover:bg-facilityEaseGreen transition ease-in-out duration-300">
                                    RUN REPORTS
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="flex-1">
                        <div>
                            <canvas id="myChart" class="min-h-fit"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/2 p-4 sm:p-8 bg-white shadow sm:rounded-lg h-fit ml-2">
                <div
                        class="relative max-h-[520px] overflow-y-auto shadow-md sm:rounded-lg bg-gray-300 mt-2 scrollbar-none">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Reserved By
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Facility
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Event
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Days
                                    </th>
                                    <th scope="col" class="flex justify-center lg:justify-end px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $index => $reservation)
                                    <tr
                                        class="{{ $index % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }} border-b">
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $reservation->user->fName }} {{ $reservation->user->lName }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $reservation->facility->facility }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white max-w-sm overflow-hidden overflow-ellipsis">
                                            {{ $reservation->event }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $reservation->noOfdays }}
                                        </td>
                                        <td class="flex justify-between lg:justify-end px-6 py-4">
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
                                                    class="w-32 mx-2 px-4 py-2 leading-none text-white bg-facilityEaseBlue rounded-md hover:bg-indigo-600 transition ease-in-out duration-300">
                                                    View
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($peakUtilizationData->keys()),
                    datasets: [{
                        label: 'Peak Utilization Rate (%)',
                        data: @json($peakUtilizationData->values()), // Make sure this is the peak utilization data
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        xAxes: [{ // Change from 'x' to 'xAxes'
                            type: 'time',
                            time: {
                                unit: 'day', // Default to day; can be dynamically adjusted based on the user's selection
                                displayFormats: {
                                    day: 'MMM DD', // Format for days
                                    week: 'MMM DD', // Format for weeks
                                    month: 'MMM YYYY', // Format for months
                                    year: 'YYYY' // Format for years
                                }
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endpush
