<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminReservationStatusMail;
use App\Mail\ReservartionStatusMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Facility;
use App\Models\Reservation;
use App\Models\Equipment;
use App\Models\ReservationEquipments;
use App\Models\ReservationDocuments;
use App\Models\RemarksDocuments;
use App\Models\ReservationDays;
use App\Models\ReservationView;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Mail\ReservationMail;
use App\Models\UserRoles;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{
    public function setReservationIdAsViewed(Request $request, $id)
    {

        $user = Auth::user();

        $reservationView = ReservationView::where('userID', $user->id)
            ->where('reservationID', $id)
            ->first();

        if (!$reservationView) {
            ReservationView::create([
                'userID' => $user->id,
                'reservationID' => $id,
                'is_viewed' => true,
            ]);

            return response()->json(['success' => true, 'message' => 'Successfully marked as viewed']);
        }

        return response()->json(['success' => false, 'message' => 'Reservation already viewed by this user']);
    }

    public function showReservations($universityID)
    {
        $userUniversityID = User::where('universityID', $universityID)->first();
        $facilitiesData = Facility::where('status', 'ACTIVE')->select('id', 'buildingID', 'buildingFloorID', 'facility', 'capacity')->get();
        $user = Auth::user();

        if ($user->user_role->contains('roleID', 2)) {
            $reservations = $user->facilityReservations()
                ->orderBy('created_at', 'desc')
                ->get();

            $facilities = Facility::where('status', 'ACTIVE')->get();

            return view('fic.reservations', compact('user', 'reservations', 'facilities'));
        } elseif ($user->user_role->contains('roleID', 1)) {
            $reservations = Reservation::with('facility', 'user.academic', 'user_role', 'role')
                ->orderBy('created_at', 'desc')
                ->get();

            $facilities = Facility::where('status', 'ACTIVE')->get();

            return view('fic.reservations', compact('userUniversityID', 'reservations', 'facilities'))
                ->with('error', 'Access denied. You are not a Facility Incharge.');
        } else {
            $reservations = Reservation::with('facility', 'user.academic', 'user_role', 'role')
                ->where('userID', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            $facilities = Facility::where('status', 'ACTIVE')->get();
            return view('fic.reservations', compact('user', 'reservations', 'facilities'));
        }
    }

    public function reservationForm($universityID, $id)
    {
        $userUniversityID = User::where('universityID', $universityID)->first();
        $facility = Facility::with('user_role', 'user')->find($id);

        if (!$facility) {
            abort(404);
        }

        $equipments = Equipment::where('facilityID', $id)->where('status', 'SERVICEABLE')->get();

        $reservations = Reservation::where('facilityID', $id)
        ->whereIn('status', ['PENCILBOOKED', 'APPROVED', 'OCCUPIED', 'RESCHEDULED'])
        ->with('reservation_days')
        ->get();



        return view('fic.reservationForm', compact('facility', 'equipments', 'reservations'));
    }

    // public function createReservation(Request $request, $id)
    // {
    //     $user = Auth::user();
    //     $userRole = $user->user_role->first();

    //     $facilities = Facility::findOrFail($id);
    //     $maxDays = $facilities->maxDays;
    //     $maxHours = $facilities->maxHours;

    //     $requestData = Validator::make($request->all(), [
    //         'event' => 'required|string|max:255',
    //         'startDate' => 'required|date',
    //         'startDate' => 'required|date|after_or_equal:today',
    //         'noOfdays' => "integer|min:1|max:$maxDays",
    //         'endDate' => 'required|date',
    //         'endDate' => 'required|date|after_or_equal:startDate',
    //         'occupants' => [
    //             'required',
    //             'integer',
    //             function ($attribute, $value, $fail) use ($id) {
    //                 $facility = Facility::findOrFail($id);
    //                 if ($value > $facility->capacity) {
    //                     $fail("The number of attendees exceeds the capacity of the facility (Capacity: {$facility->capacity}).");
    //                 }
    //             },
    //         ],
    //     ], [
    //         'noOfdays.min' => 'The number of days must be at least 1.',
    //         'noOfdays.required' => 'The number of days is required.',
    //         'occupants.integer' => 'The number of attendees must be an integer.',
    //         'startDate.after_or_equal' => 'The start date must be today or a future date.',
    //     ]);

    //     if ($requestData->fails()) {
    //         return redirect()
    //             ->back()
    //             ->withErrors($requestData)
    //             ->withInput();
    //     }

    //     $requestData = $requestData->validated();

    //     for ($day = 1; $day <= $requestData['noOfdays']; $day++) {
    //         $requestData["startTime_$day"] = 'required|date_format:H:i';
    //         $requestData["endTime_$day"] = 'required|date_format:H:i';
    //     }

    //     if ($requestData['noOfdays'] == 1) {
    //         $requestData['endDate'] = $requestData['startDate'];
    //     } else {
    //         $endDate = Carbon::parse($requestData['startDate'])->addDays($requestData['noOfdays'] - 1)->toDateString();
    //         $requestData['endDate'] = $endDate;
    //     }

    //     $requestData['facilityID'] = $id;
    //     $requestData['userID'] = $user->id;
    //     $requestData['roleID'] = $user->id;

    //     $dateRange = [];
    //     for ($i = 0; $i < $requestData['noOfdays']; $i++) {
    //         $currentDate = Carbon::parse($requestData['startDate'])->addDays($i)->toDateString();
    //         $dateRange[] = $currentDate;
    //     }
    //     info($dateRange);
    //     $conflictingReservations = [];
    //     for ($day = 1; $day <= $request->input('noOfdays'); $day++) {
    //         $dayConflicts = ReservationDays::with('reservation.facility')
    //             ->whereHas('reservation', function ($q) use ($requestData) {
    //                 $q->where('facilityID', $requestData['facilityID'])
    //                     ->whereIn('status', ['APPROVED', 'PENCILBOOKED', 'RESCHEDULED', 'OCCUPIED']);
    //             })
    //             ->where(function ($query) use ($request, $day, $dateRange) {
    //                 $startTime = $request->input("startTime.$day") . ':00';
    //                 $endTime = $request->input("endTime.$day") . ':00';
    //                 $query->where(function ($subquery) use ($day, $startTime, $endTime, $dateRange) {
    //                     $subquery
    //                         ->where(function ($timeQuery) use ($day, $startTime, $endTime, $dateRange) {
    //                             $timeQuery
    //                                 ->orWhere(function ($q) use ($startTime, $endTime, $dateRange, $day) {
    //                                     $q->where('date', $dateRange[$day - 1])
    //                                         ->where('startTime', '<=', $startTime)
    //                                         ->where('endTime', '>', $startTime);
    //                                 })
    //                                 ->orWhere(function ($q) use ($startTime, $endTime, $dateRange, $day) {
    //                                     $q->where('date', $dateRange[$day - 1])
    //                                         ->where('startTime', '<', $endTime)
    //                                         ->where('endTime', '=>', $endTime);
    //                                 });
    //                         });
    //                 });
    //             })
    //             ->get();

    //         if (count($dayConflicts) > 0) {
    //             $conflictingReservations[] = [
    //                 'date' => $dayConflicts[0]['startTime'] . ' - ' . $dayConflicts[0]['endTime']
    //             ];
    //         }
    //     }

    //     if (count($conflictingReservations)) {
    //         return redirect()->back()->withErrors([
    //             'conflict' => 'The selected date and time slot is not available.'
    //         ])->withInput();
    //     }


    //     $openTime = Carbon::parse($facilities->openTime)->format('H:i');
    //     $closeTime = Carbon::parse($facilities->closeTime)->format('H:i');

    //     $validationRules = [];
    //     $validationMessages = [];


    //     for ($day = 1; $day <= $requestData['noOfdays']; $day++) {
    //         $validationRules["startTime.$day"] = [
    //             'required',
    //             'date_format:H:i',
    //             function ($attribute, $value, $fail) use ($facilities, $day) {
    //                 $openTime = Carbon::parse($facilities->openTime)->format('H:i');
    //                 if ($value < $openTime) {
    //                     $fail("The start time for day $day must be after or equal to the opening time of the facility ($openTime).");
    //                 }
    //             },
    //         ];
    //         $validationRules["endTime.$day"] = [
    //             'required',
    //             'date_format:H:i',
    //             'after:startTime.' . $day,
    //             function ($attribute, $value, $fail) use ($facilities, $day, &$totalHoursPerDay) {
    //                 $closeTime = Carbon::parse($facilities->closeTime)->format('H:i');
    //                 if ($value > $closeTime) {
    //                     $fail("The end time for day $day must be before or equal to the closing time of the facility ($closeTime).");
    //                 }

    //                 $totalHoursPerDay = 0;
    //                 $startTime = request()->input("startTime.$day");
    //                 $totalHoursPerDay += Carbon::parse($startTime)->diffInHours(Carbon::parse($value));

    //                 if ($totalHoursPerDay > $facilities->maxHours) {
    //                     $fail("The total duration for day $day exceeds the maximum allowed hours of {$facilities->maxHours}.");
    //                 }
    //             },
    //         ];

    //         $validationMessages += [
    //             "startTime.$day.after_or_equal" => "The start time for day $day must be after or equal to the opening time of the facility ($openTime).",
    //             "startTime.$day.before_or_equal" => "The start time for day $day must be before or equal to the closing time of the facility ($closeTime).",
    //             "endTime.$day.after" => "The end time for day $day must be greater than the start time.",
    //             "endTime.$day.before_or_equal" => "The end time for day $day must be before or equal to the closing time of the facility ($closeTime).",
    //         ];
    //     }

    //     $validator = Validator::make($request->all(), $validationRules, $validationMessages);

    //     if ($validator->fails()) {
    //         return redirect()
    //             ->back()
    //             ->withErrors($validator, 'timeErrors')
    //             ->withInput();
    //     }

    //     $reservation = Reservation::create($requestData);

    //     for ($day = 1; $day <= $requestData['noOfdays']; $day++) {
    //         $startTime = $request->input("startTime.$day");
    //         $endTime = $request->input("endTime.$day");


    //         ReservationDays::create([
    //             'reservationID' => $reservation->id,
    //             'days' => $day,
    //             'date' => $dateRange[$day - 1],
    //             'startTime' => $startTime,
    //             'endTime' => $endTime,
    //         ]);
    //     }

    //     $fileData = $request->validate([
    //         'file.*' => 'nullable|file|max:2048',
    //     ]);

    //     if ($request->hasFile('file') && count($request->file('file')) > 0) {
    //         foreach ($request->file('file') as $file) {
    //             if ($file->isValid()) {
    //                 $originalFileName = $file->getClientOriginalName();
    //                 $filePath = $file->storeAs('reservation_files', $originalFileName, 'public');

    //                 ReservationDocuments::create([
    //                     'reservationID' => $reservation->id,
    //                     'file' => $filePath,
    //                 ]);
    //             } else {
    //                 return redirect()->back()->withErrors(['file' => 'One or more files are not valid.']);
    //             }
    //         }
    //     }

    //     $selectedEquipmentIds = $request->input('selectedEquipments') ?? [];
    //     foreach ($selectedEquipmentIds as $equipmentId) {
    //         ReservationEquipments::create([
    //             'reservationID' => $reservation->id,
    //             'equipmentID' => $equipmentId,
    //         ]);
    //     }

    //     $data = Reservation::with('facility.user_role.user', 'user', 'reservation_days', 'equipment')->find($reservation->id);
    //     try {
    //         Mail::to(auth()->user()->email)->send(new ReservationMail($data));
    //         $facilitator = $data->facility->user_role->user;
    //         Mail::to($facilitator->email)->send(new AdminReservationStatusMail($facilitator, $data));
    //         // $admins = UserRoles::with('user')->where('roleID', 2)->get();
    //         // foreach ($admins as $admin) {
    //         //     Mail::to($admin->user->email)->send(new AdminReservationStatusMail($admin->user, $data));
    //         // }
    //     } catch (\Throwable $e) {
    //         info($e);
    //     }

    //     if (Auth::user()->user_role->where('roleID', 2)->count() > 0) {
    //         return redirect('/dashboard');
    //     } elseif (Auth::user()->user_role->whereIn('roleID', [3, 4, 5, 6])->count() > 0) {
    //         return redirect()->route('user.showReservations', ['universityID' => Auth::user()->universityID])->with('success', 'Your reservation is PENDING');
    //     } else {
    //         return redirect()->route('showReservations', ['universityID' => Auth::user()->universityID])->with('success', 'Your reservation is PENDING');
    //     }
    // }

    public function createReservation(Request $request, $id)
    {
        $user = Auth::user();
        $userRole = $user->user_role->first();

        $validatedData = $request->validate([
            'event' => 'required|string|max:255',
            'occupants' => 'required|integer|min:0',
            'noOfdays' => 'required|integer|min:1',
        ]);

        $facility = Facility::findOrFail($id);

        $reservation = new Reservation();

        $reservation->event = $validatedData['event'];
        $reservation->occupants = $validatedData['occupants'];
        $reservation->noOfdays = $validatedData['noOfdays'];

        $reservation->facilityID = $facility->id; 
        $reservation->userID = Auth::id(); 
        $reservation->roleID = $user->id;

        $reservation->save();

        for ($i = 1; $i <= $validatedData['noOfdays']; $i++) {
            $dateForDay = $request->input('dateForDay' . $i);
            $startTimeForDay = $request->input('startTimeForDay' . $i);
            $endTimeForDay = $request->input('endTimeForDay' . $i);

            $reservationDay = new ReservationDays();

            $reservationDay->date = $dateForDay;
            $reservationDay->startTime = $startTimeForDay;
            $reservationDay->endTime = $endTimeForDay;

            $reservation->reservation_days()->save($reservationDay);
        }

        $fileData = $request->validate([
                    'file.*' => 'nullable|file|max:2048',
                ]);
        
                if ($request->hasFile('file') && count($request->file('file')) > 0) {
                    foreach ($request->file('file') as $file) {
                        if ($file->isValid()) {
                            $originalFileName = $file->getClientOriginalName();
                            $filePath = $file->storeAs('reservation_files', $originalFileName, 'public');
        
                            ReservationDocuments::create([
                                'reservationID' => $reservation->id,
                                'file' => $filePath,
                            ]);
                        } else {
                            return redirect()->back()->withErrors(['file' => 'One or more files are not valid.']);
                        }
                    }
                }
        
                $selectedEquipmentIds = $request->input('selectedEquipments') ?? [];
                foreach ($selectedEquipmentIds as $equipmentId) {
                    ReservationEquipments::create([
                        'reservationID' => $reservation->id,
                        'equipmentID' => $equipmentId,
                    ]);
                }

        $data = Reservation::with('facility.user_role.user', 'user', 'reservation_days', 'equipment')->find($reservation->id);
        try {
            Mail::to(auth()->user()->email)->send(new ReservationMail($data));
            $facilitator = $data->facility->user_role->user;
            Mail::to($facilitator->email)->send(new AdminReservationStatusMail($facilitator, $data));
            // $admins = UserRoles::with('user')->where('roleID', 2)->get();
            // foreach ($admins as $admin) {
            //     Mail::to($admin->user->email)->send(new AdminReservationStatusMail($admin->user, $data));
            // }
        } catch (\Throwable $e) {
            info($e);
        }

        if (Auth::user()->user_role->where('roleID', 2)->count() > 0) {
            return redirect('/dashboard');
        } elseif (Auth::user()->user_role->whereIn('roleID', [3, 4, 5, 6])->count() > 0) {
            return redirect()->route('user.showReservations', ['universityID' => Auth::user()->universityID])->with('success', 'Your reservation is PENDING');
        } else {
            return redirect()->route('showReservations', ['universityID' => Auth::user()->universityID])->with('success', 'Your reservation is PENDING');
        }
    }

    public function showReservationsInCalendar(Request $request)
    {
        $selectedFacility = $request->input('facilityID');
        $facilitiesData = Facility::where('status', 'ACTIVE')->select('id', 'buildingID', 'buildingFloorID', 'facility', 'capacity')->get();
        $convertedDatas = [];

        $reservationDays = ReservationDays::select('reservationID', 'date', 'startTime', 'endTime')
            ->with(['reservation' => function ($query) use ($selectedFacility) {
                $query->whereIn('status', ['PENCILBOOKED', 'APPROVED', 'OCCUPIED', 'RESCHEDULED']);
                if ($selectedFacility && $selectedFacility != 'all') {
                    $query->where('facilityID', $selectedFacility);
                }
            }])
            ->whereHas('reservation', function ($query) use ($selectedFacility) {
                if ($selectedFacility && $selectedFacility != 'all') {
                    $query->where('facilityID', $selectedFacility);
                }
            })
            ->get();

        foreach ($reservationDays as $reservation) {

            $startTime = Carbon::parse($reservation->startTime)->format('H:i');
            $endTime = Carbon::parse($reservation->endTime)->format('H:i');
            $date = Carbon::parse($reservation->date)->format('Y-m-d');
            $startDate =  $date;
            $endDate =  $date;

            $facility = $reservation->reservation ? $facilitiesData->where('id', $reservation->reservation->facilityID)->first() : null;
            // $days = $reservation->pluck('days')->toArray();

            $dayStartTime = $reservation->pluck('startTime')->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })->toArray();

            $dayEndTime = $reservation->pluck('endTime')->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })->toArray();



            if ($facility) {
                $facilityName = $reservation->reservation->facility->facility;
            } else {
                $facilityName = 'Facility Not Found';
            }

            $data = [
                'title' => $reservation->reservation ? $reservation->reservation->event : 'Event Not Found',
                'start' => "{$startDate}T{$startTime}",
                'end' => "{$endDate}T{$endTime}",
                'extendedProps' => [
                    'reservationID' => $reservation->reservationID,
                    'facilityID' => $reservation->reservation->facilityID ?? null,
                    'facilityName' => $facilityName,
                    'startTime' => $dayStartTime,
                    'endTime' =>  $dayEndTime,
                    'status' => $reservation->reservation->status ?? null,
                    // 'days' => $days,
                ],
            ];

            $convertedDatas[] = $data;
        }

        return view('dashboard', compact('convertedDatas', 'facilitiesData', 'selectedFacility'));
    }

    public function showQrcodeScanner()
    {
        return view('admin.scanner');
    }

    public function checkQrcode(Request $request)
    {
        info($request->data);
        $result = 0;
        if ($request->data) {
            $reservation = Reservation::with('reservation_days', 'facility.user_role.user', 'equipment')->find($request->data);

            $reserveToday = ReservationDays::where('reservationID', $reservation->id)
            ->whereDate('date', now()->setTimezone('UTC')->toDateString())
            ->get();

            // if ($reserveToday->count() === 0) {
            //     $result = 'This reservation is not for today';
            //     return [
            //         'message' => $result,
            //         'reservation' => $reservation
            //     ];
            // }

            if ($reservation->status === "APPROVED") {
                $reservation->update([
                    'status' => 'OCCUPIED'
                ]);
                $result = 'Facility Reserved';
                try {
                    Mail::to($reservation->user->email)->send(new ReservartionStatusMail($reservation->user, $reservation));
                    $facilititor = $reservation->facility->user_role->user;
                    Mail::to($facilititor->email)->send(new ReservartionStatusMail($facilititor, $reservation));
                    // $admins = UserRoles::with('user')->where('roleID', 1)->get();
                    // foreach ($admins as $admin) {
                    //     Mail::to($admin->user->email)->send(new ReservartionStatusMail($admin->user, $reservation));
                    // }
                } catch (\Throwable $e) {
                    info($e);
                }
            } else if ($reservation->status === "OCCUPIED") {
                $result = "Reservation for '{$reservation->event}' is already Reserved";
            } else if ($reservation->status === "PENDING") {
                $result = "Reservation is still PENDING";
            } else {
                $result = "There is no reservation on this QR code";
            }
        }
        return [
            'message' => $result,
            'reservation' => $reservation
        ];
    }

    public function showReservationById($universityID, $id)
    {
        $userUniversityID = User::where('universityID', $universityID)->first();

        $reservation = Reservation::with(['facility', 'user', 'user_role', 'role'])
            ->findOrFail($id);

        $facilities = Facility::with('building', 'user_role', 'user')->where('status', 'ACTIVE')->get();

        $reservationEquipments = ReservationEquipments::where('reservationID', $id)->get();
        $reservationDocuments = ReservationDocuments::where('reservationID', $id)->get();
        $reservationDays = ReservationDays::where('reservationID', $id)->get();
        $remarksDocuments = RemarksDocuments::where('reservationID', $id)->get();


        $reservation->formattedStartDate = Carbon::parse($reservation->startDate)->format('m-d-Y');
        $reservation->formattedStartTime = Carbon::parse($reservation->startTime)->format('h:i A');
        $reservation->formattedEndDate = Carbon::parse($reservation->endDate)->format('m-d-Y');
        $reservation->formattedEndTime = Carbon::parse($reservation->endTime)->format('h:i A');

        return view('fic.viewReservation', compact('reservation', 'reservationEquipments', 'reservationDocuments', 'reservationDays', 'facilities', 'remarksDocuments'));
    }

    public function updateReservationStatus(Request $request, $id, $status)
    {
        $request->validate([
            'reason' => 'nullable|string',
            'file.*' => 'nullable|file|max:2048',
        ]);

        $reservation = Reservation::with('facility.user_role.user', 'user', 'reservation_days')->findOrFail($id);

        // HELL
        $dateRange = [];
        for ($i = 0; $i < $reservation->noOfDays; $i++) {
            $currentDate = Carbon::parse($reservation->startDate)->addDays($i)->toDateString();
            $dateRange[] = $currentDate;
        }

        $conflictingReservations = [];
        // for ($day = 1; $day <= $reservation->noOfDays; $day++) {
        foreach ($reservation->reservation_days as $res) {
            $dayConflicts = ReservationDays::with('reservation.facility')
                ->whereHas('reservation', function ($q) use ($reservation) {
                    $q->where('facilityID', $reservation->facilityID)
                        ->whereIn('status', ['PENDING']);
                })
                ->where(function ($query) use ($res, $dateRange) {
                    // $startTime = $reservation->input("startTime.$day") . ':00';
                    // $endTime = $reservation->input("endTime.$day") . ':00';
                    $query->where(function ($subquery) use ($res, $dateRange) {
                        $subquery
                            ->where(function ($timeQuery) use ($res, $dateRange) {
                                $timeQuery
                                    ->orWhere(function ($q) use ($res) {
                                        $q->where('startTime', '<=', $res->startTime)
                                            ->where('endTime', '>', $res->startTime);
                                    })
                                    ->orWhere(function ($q) use ($res) {
                                        $q
                                            // ->where('date', $dateRange[$day - 1])
                                            ->where('startTime', '<', $res->endTime)
                                            ->where('endTime', '=>', $res->endTime);
                                    });
                            });
                    });
                })
                ->get();
            info($dayConflicts);
            if (count($dayConflicts) > 0) {
                foreach ($dayConflicts as $conflict) {
                    $conflictingReservations[] = $conflict->reservationID;
                }
            }
        }

        $toDecline = Reservation::with('reservation_days', 'facility.user_role.user', 'equipment')->where('status', 'PENDING')->whereIn('id', $conflictingReservations)->get();
        $toDecline->each->update([
            'status' => 'DECLINED'
        ]);

        foreach ($toDecline as $re) {
            // EMAIL for DECLINED RESERVATION
            try {
                Mail::to($re->user->email)->send(new ReservartionStatusMail($re->user, $re));
                sleep(2);
                $facilitator = $re->facility->user_role->user;
                Mail::to($facilitator->email)->send(new ReservartionStatusMail($facilitator, $re));
                sleep(2);
                // $admins = UserRoles::with('user')->where('roleID', 1)->get();
                // foreach ($admins as $admin) {
                //     Mail::to($admin->user->email)->send(new ReservartionStatusMail($admin->user, $re));
                //     sleep(2);
                // }
            } catch (\Throwable $e) {
                info($e);
            }
        }

        if ($request->hasFile('remarksFiles') && count($request->file('remarksFiles')) > 0) {
            foreach ($request->file('remarksFiles') as $file) {
                if ($file->isValid()) {
                    $originalFileName = $file->getClientOriginalName();
                    $filePath = $file->storeAs('reservation_files', $originalFileName, 'public');

                    RemarksDocuments::create([
                        'reservationID' => $reservation->id,
                        'remarksFiles' => $filePath,
                    ]);
                } else {
                    return redirect()->back()->withErrors(['file' => 'One or more files are not valid.']);
                }
            }
        }

        $reservation->status = $status;
        $reservation->reason = $request->input('reason');

        try {
            // Save reservation after handling conflicts, declines, and file upload
            $reservation->save();

            // Send emails
            Mail::to($reservation->user->email)->send(new ReservartionStatusMail($reservation->user, $reservation));
            sleep(2);
            $facilitator = $reservation->facility->user_role->user;
            Mail::to($facilitator->email)->send(new ReservartionStatusMail($facilitator, $reservation));
            sleep(2);
            // $admins = UserRoles::with('user')->where('roleID', 1)->get();
            // foreach ($admins as $admin) {
            //     Mail::to($admin->user->email)->send(new ReservartionStatusMail($admin->user, $reservation));
            //     sleep(2);
            // }

            return redirect()->back()->with('success', 'Reservation status updated successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update reservation status.']);
        }
    }


    public function updateReservation($universityID, $id)
    {
        $userUniversityID = User::where('universityID', $universityID)->first();

        $reservation = Reservation::with(['facility', 'user', 'user_role', 'role'])
            ->findOrFail($id);

        $facility = $reservation->facility->id;

        if (!$facility) {
            abort(404);
        }

        $equipments = Equipment::where('facilityID', $facility)->get();

        $facilities = Facility::with('building', 'user_role', 'user')->where('status', 'ACTIVE')->get();


        $reservationEquipments = ReservationEquipments::where('reservationID', $id)->get();
        $reservationDocuments = ReservationDocuments::where('reservationID', $id)->get();
        $reservationDays = ReservationDays::where('reservationID', $id)->get();

        $reservation->formattedStartDate = Carbon::parse($reservation->startDate)->format('m-d-Y');
        $reservation->formattedStartTime = Carbon::parse($reservation->startTime)->format('h:i A');
        $reservation->formattedEndDate = Carbon::parse($reservation->endDate)->format('m-d-Y');
        $reservation->formattedEndTime = Carbon::parse($reservation->endTime)->format('h:i A');

        if (!in_array($reservation->status, ['PENDING', 'PENCILBOOKED'])) {
            return redirect()->back()->with('error', 'Cannot update reservation with status: ' . $reservation->status);
        }

        $viewName = in_array($reservation->status, ['PENDING', 'PENCILBOOKED']) ? 'fic.editReservationForm' : 'fic.editReservationFormResched';

        return view($viewName, compact('reservation', 'reservationEquipments', 'reservationDocuments', 'reservationDays', 'facility', 'equipments', 'facilities'));
    }


    public function updateReservationDetailsPending(Request $request, $id)
    {

        $reservation = Reservation::findOrFail($id);
        $user = Auth::user();

        $requestData = Validator::make($request->all(), [
            'event' => 'required|string|max:255',
            'startDate' => 'required|date',
            'facilityID' => 'required|exists:facilities,id',
            'noOfdays' => 'integer|min:1',
            'endDate' => 'required|date',
            'occupants' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($id) {
                    $reservation = Reservation::findOrFail($id);
                    $facility = Facility::findOrFail($reservation->facilityID);

                    if ($value > $facility->capacity) {
                        $fail("The number of attendees exceeds the capacity of the facility (Capacity: {$facility->capacity}).");
                    }
                },
            ],
        ], [
            'noOfdays.min' => 'The number of days must be at least 1.',
            'noOfdays.required' => 'The number of days is required.',
            'occupants.integer' => 'The number of attendees must be an integer.',
        ]);

        if ($requestData->fails()) {
            return redirect()
                ->back()
                ->withErrors($requestData)
                ->withInput();
        }

        $requestData = $requestData->validated();
        $reservation->update($requestData);

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $files = is_array($files) ? $files : [$files]; // Ensure $files is always an array

            if (count($files) > 0) {
                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $originalFileName = $file->getClientOriginalName();
                        $filePath = $file->storeAs('reservation_files', $originalFileName, 'public');

                        ReservationDocuments::create([
                            'reservationID' => $reservation->id,
                            'file' => $filePath,
                        ]);
                    } else {
                        return redirect()->back()->withErrors(['file' => 'One or more files are not valid.']);
                    }
                }
            }
        }

        $deletedDocumentIds = $request->input('deletedDocuments');

        if (is_string($deletedDocumentIds)) {
            $deletedDocumentIds = json_decode($deletedDocumentIds, true);
        }

        if (!empty($deletedDocumentIds)) {
            ReservationDocuments::whereIn('id', $deletedDocumentIds)->delete();
        }

        $selectedEquipmentIds = $request->input('selectedEquipments');

        if ($selectedEquipmentIds !== null) {
            ReservationEquipments::where('reservationID', $id)->delete();
            foreach ($selectedEquipmentIds as $equipmentId) {
                ReservationEquipments::create([
                    'reservationID' => $reservation->id,
                    'equipmentID' => $equipmentId,
                ]);
            }
        }

        $dateRange = [];
        for ($i = 0; $i < $requestData['noOfdays']; $i++) {
            $currentDate = Carbon::parse($requestData['startDate'])->addDays($i)->toDateString();
            $dateRange[] = $currentDate;
        }
        for ($day = 1; $day <= $requestData['noOfdays']; $day++) {
            $request->validate([
                "startTime.$day" => "required|date_format:H:i",
                "endTime.$day" => "required|date_format:H:i",
            ]);

            $startTime = $request->input("startTime.$day");
            $endTime = $request->input("endTime.$day");

            ReservationDays::updateOrCreate(
                [
                    'reservationID' => $reservation->id,
                    'days' => $day,
                ],
                [
                    'date' => $dateRange[$day - 1],
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                ]
            );
        }

        if ($user->user_role->contains('roleID', 2)) {
            return redirect()->route('fic.showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id])->with('success', 'Reservation updated successfully')->withInput();
        } elseif ($user->user_role->whereIn('roleID', [3, 4, 5, 6])->count() > 0) {
            return redirect()->route('user.showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id])->with('success', 'Reservation updated successfully');
        } else {
            return redirect()->route('showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id])->with('success', 'Reservation updated successfully');
        }
    }

    public function updateReschedule(Request $request, $id, $facilityID)
    {
        info($request->all());
        info($id);
        info($facilityID);
        DB::beginTransaction();

        $reservation = Reservation::findOrFail($id);
        $user = Auth::user();
        $request->merge(['facilityID' => $facilityID]);
        $requestData = Validator::make($request->all(), [
            'event' => 'required|string|max:255',
            'startDate' => 'required|date',
            'facilityID' => 'required|exists:facilities,id',
            'noOfdays' => 'integer|min:1',
            'endDate' => 'required|date',
            'occupants' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($facilityID) {
                    $facility = Facility::findOrFail($facilityID);
                    if ($value > $facility->capacity) {
                        $fail("The number of attendees exceeds the capacity of the facility (Capacity: {$facility->capacity}).");
                    }
                },
            ],
        ], [
            'noOfdays.min' => 'The number of days must be at least 1.',
            'noOfdays.required' => 'The number of days is required.',
            'occupants.integer' => 'The number of attendees must be an integer.',
        ]);

        if ($requestData->fails()) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withErrors($requestData)
                ->withInput();
        }

        $requestData = $requestData->validated();
        $requestData['facilityID'] = $request->input('facilityID');

        $selectedEquipmentIds = $request->input('selectedEquipments');

        if ($selectedEquipmentIds !== null) {
            ReservationEquipments::where('reservationID', $id)->delete();
            foreach ($selectedEquipmentIds as $equipmentId) {
                ReservationEquipments::create([
                    'reservationID' => $reservation->id,
                    'equipmentID' => $equipmentId,
                ]);
            }
        }

        if ($request->hasFile('file')) {
            $fileData = $request->validate([
                'file.*' => 'nullable|file|max:2048',
            ]);

            foreach ($request->file('file') as $file) {
                $originalFileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('reservation_files', $originalFileName, 'public');

                ReservationDocuments::create([
                    'reservationID' => $reservation->id,
                    'file' => $filePath,
                ]);
            }
        }


        $deletedDocumentIds = $request->input('deletedDocuments');

        if (is_string($deletedDocumentIds)) {
            $deletedDocumentIds = json_decode($deletedDocumentIds, true);
        }

        if (!empty($deletedDocumentIds)) {
            ReservationDocuments::whereIn('id', $deletedDocumentIds)->delete();
        }

        $dateRange = [];
        for ($i = 0; $i < $requestData['noOfdays']; $i++) {
            $currentDate = Carbon::parse($requestData['startDate'])->addDays($i)->toDateString();
            $dateRange[] = $currentDate;
        }

        $conflictingReservations = [];
        for ($day = 1; $day <= $request->input('noOfdays'); $day++) {
            $dayConflicts = ReservationDays::with('reservation.facility')
                ->whereHas('reservation', function ($q) use ($requestData) {
                    $q->where('facilityID', $requestData['facilityID'])
                        ->whereIn('status', ['APPROVED', 'PENCILBOOKED', 'REVOKED']);
                })
                ->where(function ($query) use ($request, $day, $dateRange) {
                    $startTime = $request->input("startTime.$day") . ':00';
                    $endTime = $request->input("endTime.$day") . ':00';
                    $query->where(function ($subquery) use ($day, $startTime, $endTime, $dateRange) {
                        $subquery
                            ->where(function ($timeQuery) use ($day, $startTime, $endTime, $dateRange) {
                                $timeQuery
                                    ->orWhere(function ($q) use ($startTime, $endTime, $dateRange, $day) {
                                        $q->where('date', $dateRange[$day - 1])
                                            ->where('startTime', '<=', $startTime)
                                            ->where('endTime', '>', $startTime);
                                    })
                                    ->orWhere(function ($q) use ($startTime, $endTime, $dateRange, $day) {
                                        $q->where('date', $dateRange[$day - 1])
                                            ->where('startTime', '<', $endTime)
                                            ->where('endTime', '=>', $endTime);
                                    });
                            });
                    });
                })
                ->get();

            if (count($dayConflicts) > 0) {
                $conflictingReservations[] = [
                    'date' => $dayConflicts[0]['startTime'] . ' - ' . $dayConflicts[0]['endTime']
                ];
            }
        }

        if (count($conflictingReservations)) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'conflict_resched' => 'The selected date and time slot is not available.'
            ])->withInput();
        }

        $reservation->update($requestData);

        $validationRules = [];
        $validationMessages = [];
        for ($day = 1; $day <= $requestData['noOfdays']; $day++) {
            $validationRules["startTime.$day"] = "required|date_format:H:i";
            $validationRules["endTime.$day"] = "required|date_format:H:i|after:startTime.$day";

            $validationMessages += [
                "endTime.$day.after" => "The end time for day $day must be greater than the start time.",
            ];
        }

        $validator = Validator::make($request->all(), $validationRules, $validationMessages);

        if ($validator->fails()) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withErrors($validator, 'timeErrors_resched')
                ->withInput();
        }

        ReservationDays::where('reservationID', $reservation->id)->delete();

        for ($day = 1; $day <= $requestData['noOfdays']; $day++) {
            $startTime = $request->input("startTime.$day");
            $endTime = $request->input("endTime.$day");


            ReservationDays::create([
                'reservationID' => $reservation->id,
                'days' => $day,
                'date' => $dateRange[$day - 1],
                'startTime' => $startTime,
                'endTime' => $endTime,
            ]);
        }


        $reservation->status = 'RESCHEDULED';
        $reservation->save();

        try {
            Mail::to($reservation->user->email)->send(new ReservartionStatusMail($reservation->user, $reservation));
            sleep(2);
            $facilititor = $reservation->facility->user_role->user;
            Mail::to($facilititor->email)->send(new ReservartionStatusMail($facilititor, $reservation));
            sleep(2);
            // $admins = UserRoles::with('user')->where('roleID', 1)->get();
            // foreach ($admins as $admin) {
            //     Mail::to($admin->user->email)->send(new ReservartionStatusMail($admin->user, $reservation));
            //     sleep(2);
            // }
        } catch (\Throwable $e) {
            info($e);
        }

        DB::commit();
        if ($user->user_role->contains('roleID', 2)) {
            return redirect()->route('fic.showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id])->with('success', 'Reservation updated successfully')->withInput();
        } elseif ($user->user_role->whereIn('roleID', [3, 4, 5, 6])->count() > 0) {
            return redirect()->route('user.showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id])->with('success', 'Reservation updated successfully');
        } else {
            return redirect()->route('showReservationById', ['universityID' => Auth::user()->universityID, 'id' => $reservation->id])->with('success', 'Reservation updated successfully');
        }
    }

    public function updateReservationFormReschedule($universityID, $id, $facilityId)
    {
        $userUniversityID = User::where('universityID', $universityID)->first();

        $reservation = Reservation::with(['facility', 'user', 'user_role', 'role'])
            ->findOrFail($id);

        $facility = Facility::with('user_role', 'user')->find($facilityId);
        $equipments = Equipment::where('facilityID', $id)->get();


        if (!$facility) {
            abort(404);
        }

        $equipments = Equipment::where('facilityID', $facility)->get();

        $facilities = Facility::with('building', 'user_role', 'user')->where('status', 'ACTIVE')->get();


        $reservationEquipments = ReservationEquipments::where('reservationID', $id)->get();
        $reservationDocuments = ReservationDocuments::where('reservationID', $id)->get();
        $reservationDays = ReservationDays::where('reservationID', $id)->get();

        $reservation->formattedStartDate = Carbon::parse($reservation->startDate)->format('m-d-Y');
        $reservation->formattedStartTime = Carbon::parse($reservation->startTime)->format('h:i A');
        $reservation->formattedEndDate = Carbon::parse($reservation->endDate)->format('m-d-Y');
        $reservation->formattedEndTime = Carbon::parse($reservation->endTime)->format('h:i A');

        if (!in_array($reservation->status, ['PENDING', 'PENCILBOOKED', 'REVOKED'])) {
            return redirect()->back()->with('error', 'Cannot update reservation with status: ' . $reservation->status);
        }

        $viewName = in_array($reservation->status, ['REVOKED']) ? 'fic.editReservationFormResched' : 'fic.editReservationForm';

        return view($viewName, compact('reservation', 'reservationEquipments', 'reservationDocuments', 'reservationDays', 'facility', 'equipments', 'facilities'));
    }

    public function downloadQRCode($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            abort(404, 'Reservation not found');
        }

        $qrCode = QrCode::format('png')->size(400)->generate(strval($reservation->id));

        return response($qrCode)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="qrcode.png"');
    }
}
