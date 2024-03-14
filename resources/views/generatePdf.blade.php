<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation Form</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 200px;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
</style>

<body>
    <div style="position:absolute; top:0; left:0;">
            {{-- <img src="{{ $imagePath }}" alt="iso-header" style="width: 120px;"> --}}
    </div>

    <div style="position: absolute; top:30px; left:112px; align-items:center; justify-alignment:center; text-align:center; width:430px;">
        UNIVERSITY OF SCIENCE AND TECHNOLOGY OF SOUTHERN PHILIPPINES
    </div>

    <div style="position: absolute; top:70px; left:112px; align-items:center; justify-alignment:center; text-align:center; width:430px; font-size: 11px;">
        Alubijid | Balubal | Cagayan de Oro | Claveria | Jasaan | Oroquieta | Panaon | Villianueva
    </div>
    

    <div style="position: absolute; top:20; right:0; width: 160px">
        <div style="border: 1px solid black; background-color: rgb(0, 32, 96); padding: 10px; height: 2px; ">
            <p style="color: white; text-align: center; font-size: 12px; margin-top: -6px;">Document Code No.</p>
        </div>
        <div style="border: 1px solid black; padding: 10px; height: 2px;">
            <p style="text-align: center; font-size: 12px; margin-top: -6px;">FM-USTP-LIB-10</p>
        </div>
        <div style="font-size:8px; width: 50px; text-align: center; color:white;">
            <div style="border: 1px solid black;  background-color: rgb(0, 32, 96);">
                Rev. No.
            </div>
            <div style="border: 1px solid black; width: 60px; margin-top:-12px; margin-left:49px;  background-color: rgb(0, 32, 96);">
                Effective date
            </div>
            <div style="border: 1px solid black; width: 48px; margin-top:-14px; margin-left:110px;  background-color: rgb(0, 32, 96);">
                Page No.
            </div>
        </div>
        <div style="font-size:10px; width: 50px; text-align: center;">
            <div style="border: 1px solid black;">
                01
            </div>
            <div style="border: 1px solid black; width: 60px; margin-top:-14px; margin-left:49px;">
                09-01-23
            </div>
            <div style="border: 1px solid black; width: 48px; margin-top:-16px; margin-left:110px;">
                1 of 2
            </div>
        </div>
    </div>

    <div style="position: absolute; top:130px; left:145px; align-items:center; justify-alignment:center; text-align:center; width:430px;">
        AUDIO VISUAL SERVICES RESERVATION FORM 
    </div>
    <div style="position: absolute; top:150px; left:145px; align-items:center; justify-alignment:center; text-align:center; width:430px;">
        (for CDO Campus Only)
    </div>
    <div style="position: absolute; top:160px; left:145px; align-items:center; justify-alignment:center; text-align:center; width:430px; font-weight: 700;">
        _________________________________________________________________________________________
    </div>

    @foreach ($reservations as $index => $reservation)
    <div style="position: absolute; top:180px; left:145px; align-items:center; justify-alignment:center; text-align:center; width:430px; ">
       Number of participants: {{$reservation->reservation->occupants}}
    </div>
    <div style="position: absolute; top:200px; left:145px; align-items:center; justify-alignment:center; text-align:center; width:430px; ">
        {{$reservation->reservation->facility->facility}}
     </div>
     <div style="position: absolute; top:220px; left:145px; align-items:center; justify-alignment:center; text-align:center; width:430px; ">
        {{$reservation->reservation->user->fName}} {{$reservation->reservation->user->lName}}, {{ optional(optional($reservation->reservation->user->academic)->first())->department ?? (optional(optional($reservation->reservation->user->nonacademic)->first())->position ?? 'N/A') }}
     </div>
     <div style="position: absolute; top:240px; left:145px; align-items:center; justify-alignment:center; text-align:center; width:430px; ">
        {{ optional(optional($reservation->reservation->user->academic)->first())->college ?? (optional(optional($reservation->reservation->user->nonacademic)->first())->office ?? 'N/A') }}
     </div>
     <div style=" top:400px; left:145px; width:430px; ">
       <ul>
        <li>{{$reservation->date}}</li>
        </ul> 
    </div> 
    @endforeach
    <div style="position: absolute; top:260px; left:145px; align-items:center; justify-alignment:center; text-align:center; width:430px; ">
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
    {{-- <table>
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
                    Dates
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
                                {{ $reservation->reservation->event }}
                            </div>

                            <div class="font-normal text-gray-500">
                                {{ $reservation->reservation->facility->facility }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="">
                            <div class="text-base font-semibold max-w-sm overflow-hidden overflow-ellipsis"
                                id="NameContainer">
                                {{ $reservation->reservation->user->fName }} {{ $reservation->reservation->user->lName }}
                            </div>
                            <div class="font-normal text-gray-500">
                                {{ $reservation->reservation->user_role->role->role }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $reservation->days }}
                    </td>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $reservation->reservation->user->cNumber }}
                    </td>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($reservation->reservation->status == 'APPROVED')
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseGreen me-2"></div>
                                Approved
                            </div>
                        @elseif ($reservation->reservation->status == 'PENDING')
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseMain me-2"></div>
                                Pending
                            </div>
                        @elseif ($reservation->reservation->status == 'PENCILBOOKED')
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseBlue me-2"></div>
                                Pencil Booked
                            </div>
                        @elseif ($reservation->reservation->status == 'DECLINED')
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseRed me-2"></div>
                                Declined
                            </div>
                        @elseif ($reservation->reservation->status == 'CANCELLED')
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseRed me-2"></div>
                                Cancelled
                            </div>
                        @elseif ($reservation->reservation->status == 'OCCUPIED')
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseTeal me-2"></div>
                                Ongoing
                            </div>
                        @elseif ($reservation->reservation->status == 'REVOKED')
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseRed me-2"></div>
                                Revoked
                            </div>
                        @elseif ($reservation->reservation->status == 'RESCHEDULED')
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-facilityEaseMain me-2"></div>
                                Rescheduled
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $reservation->date }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</body>

</html>
