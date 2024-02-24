@extends('layouts.app')

@section('content')
    <div class="my-6">
        <div class="flex flex-row max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="w-full p-4 sm:p-8 bg-white shadow sm:rounded-lg h-fit mr-2">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Scan Reservations QR Code') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('This page scans the QR code generated within the system to be able to implement 2-step verififcation if the facility is not currently in use.') }}
                    </p>
                </header>
                <div class="relative overflow-y-auto shadow-md sm:rounded-lg bg-gray-300 mt-2 scrollbar-none">
                    <div class="col-md-8">
                        <div class="flex flex-row w-full">
                            <div class="flex flex-col">
                                <div id="reader"></div>
                            </div>
                            <div class="flex flex-col flex-grow bg-facilityEaseWhite">
                                <div class="flex flex-col p-3">
                                    <div class="bg-white h-full rounded-md p-3">
                                        <span class="font-semibold text-md">SCAN RESULT</span>
                                        <div class="w-full">
                                            <span id="result">Results here:</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .result {
            color: #2c313a;
            font-weight: 600;
        }

        .row {
            display: flex;
        }

        #reader {
            background: #2c313a;
            width: 500px;
        }

        #reader__status_span {
            border-radius: 6px;
            padding: 5px;
        }

        #reader__header_message {
            color: #e5e7eb !important;
            background-color: #ef4444 !important;
            transition: 0ms;
            border-radius: 6px;
            margin-top: 10px;
        }

        #reader__dashboard_section_fsr {
            display: inline-block;
            padding: 5px;
            background-color: #d1d5db;
            border-radius: 6px;
            margin: 4px 2px;
            cursor: pointer;
            width: 100%;
        }

        #reader__filescan_input {
            width: 70% !important;
            padding: 2px;
        }

        #reader__filescan_input span {
            width: 30% !important;
        }

        #qr-canvas-visible {
            margin-top: 12px;
        }

        button {
            background-color: #34d399;
            /* Green */
            border: none;
            color: #e5e7eb;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 6px;
            width: 100%;
        }

        a#reader__dashboard_section_swaplink {
            background-color: #3e7ce1;
            /* Green */
            border: none;
            color: #e5e7eb;
            padding: 10px;
            text-align: center;
            text-decoration: none !important;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 6px;
            width: 100%;
        }

        span a {
            color: #e5e7eb;
            padding: 5px;
            font-weight: 600;
        }

        #reader__camera_selection {
            background: #fcb316;
            color: #2c313a;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 6px;
            display: flex;
            width: 100%;
        }

        #reader__dashboard_section_csr span {
            margin: 4px 2px;
            display: flex;
            color: #e5e7eb;
            width: 100%;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://reeteshghimire.com.np/wp-content/uploads/2021/05/html5-qrcode.min_.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script type="text/javascript">
        function onScanSuccess(data) {
            $.ajax({
                type: "POST",
                cache: false,
                url: "{{ action('App\Http\Controllers\Admin\ReservationController@checkQrcode') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    data: data
                },
                success: function(data) {
                    if (data?.reservation.event) {
                        document.getElementById('result').innerHTML = '<span class="result">' + 'Event: ' + data
                            .reservation.event + '</span>';
                    }
                    return confirm(data.message);
                }
            })
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endpush
