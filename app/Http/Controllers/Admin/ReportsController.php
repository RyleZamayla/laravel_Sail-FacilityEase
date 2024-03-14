<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\ReservationDays;
use App\Models\ReservationEquipments;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportsController extends Controller
{
    public function report(Request $request)
    {
        $reservations = Reservation::all();
        $peakUtilizationData = collect([]);
        return view('admin.reports', compact('reservations', 'peakUtilizationData'));
    }

    public function result(Request $request)
    {
        $startDate = $request->has('startDate') ? Carbon::parse($request->input('startDate')) : null;
        $endDate = $request->has('endDate') ? Carbon::parse($request->input('endDate')) : null;
        $filter = $request->input('filter', 'default');

        // Validate input data
        $request->validate([
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after_or_equal:startDate',
        ]);

        $peakUtilizationData = [];

        // Weekly Filter
        if ($filter === 'weekly' && $startDate && $endDate) {
            $startDate = $startDate->startOfWeek();
            $endDate = $endDate->endOfWeek();

            foreach (CarbonPeriod::create($startDate, '1 week', $endDate) as $week) {
                $weekStart = $week->format('Y-m-d');
                $weekEnd = $week->copy()->endOfWeek()->format('Y-m-d');
                $weekRange = "{$weekStart} to {$weekEnd}";

                $ids = Reservation::whereBetween('startDate', [$weekStart, $weekEnd])
                    ->pluck('id')
                    ->unique();

                $days = ReservationDays::with('reservation.facility')->whereIn('reservationID', $ids)->get();

                $totalHours = 0;
                $totalHoursSpend = 0;
                foreach ($days as $day) {
                    $totalHours += $day->reservation->facility->noOfHours;
                    $totalHoursSpend += $day->duration;
                }

                $peakUtilization = ($totalHours > 0) ? ($totalHoursSpend / $totalHours) * 100 : 0;
                $peakUtilizationData[$weekRange] = $peakUtilization;
            }
        }

        // Monthly Filter
        else if ($filter === 'monthly' && $startDate && $endDate) {
            $startDate = $startDate->startOfMonth();
            $endDate = $endDate->endOfMonth();

            foreach (CarbonPeriod::create($startDate, '1 month', $endDate) as $month) {
                $monthStart = $month->format('Y-m-d');
                $monthEnd = $month->copy()->endOfMonth()->format('Y-m-d');
                $monthNameYear = $month->format('F Y');

                $ids = Reservation::whereBetween('startDate', [$monthStart, $monthEnd])
                    ->pluck('id')
                    ->unique();

                $days = ReservationDays::with('reservation.facility')->whereIn('reservationID', $ids)->get();

                $totalHours = 0;
                $totalHoursSpend = 0;
                foreach ($days as $day) {
                    $totalHours += $day->reservation->facility->noOfHours;
                    $totalHoursSpend += $day->duration;
                }

                $peakUtilization = ($totalHours > 0) ? ($totalHoursSpend / $totalHours) * 100 : 0;
                $peakUtilizationData[$monthNameYear] = $peakUtilization;
            }
        }

        // Yearly Filter
        else if ($filter === 'yearly' && $startDate && $endDate) {
            $startDate = $startDate->startOfYear();
            $endDate = $endDate->endOfYear();

            foreach (CarbonPeriod::create($startDate, '1 year', $endDate) as $year) {
                $yearStart = $year->format('Y-m-d');
                $yearEnd = $year->copy()->endOfYear()->format('Y-m-d');
                $yearLabel = $year->format('Y');

                $ids = Reservation::whereBetween('startDate', [$yearStart, $yearEnd])
                    ->pluck('id')
                    ->unique();

                $days = ReservationDays::with('reservation.facility')->whereIn('reservationID', $ids)->get();

                $totalHours = 0;
                $totalHoursSpend = 0;
                foreach ($days as $day) {
                    $totalHours += $day->reservation->facility->noOfHours;
                    $totalHoursSpend += $day->duration;
                }

                $peakUtilization = ($totalHours > 0) ? ($totalHoursSpend / $totalHours) * 100 : 0;
                $peakUtilizationData[$yearLabel] = $peakUtilization;
            }
        } else {
            if ($startDate && $endDate) {
                foreach (CarbonPeriod::create($startDate, $endDate) as $date) {
                    $dateString = $date->format('Y-m-d');

                    $ids = Reservation::where('startDate', $dateString)
                        ->pluck('id')
                        ->unique();

                    $days = ReservationDays::with('reservation.facility')->whereIn('reservationID', $ids)->get();

                    $totalHours = 0;
                    $totalHoursSpend = 0;
                    foreach ($days as $day) {
                        $totalHours += $day->reservation->facility->noOfHours;
                        $totalHoursSpend += $day->duration;
                    }

                    $peakUtilization = ($totalHours > 0) ? ($totalHoursSpend / $totalHours) * 100 : 0;
                    $peakUtilizationData[$dateString] = $peakUtilization;
                }
            }

            $reservations = Reservation::with('facility')
                ->when($startDate, function ($query) use ($startDate) {
                    return $query->where('startDate', '>=', $startDate->format('Y-m-d'));
                })
                ->when($endDate, function ($query) use ($endDate) {
                    return $query->where('endDate', '<=', $endDate->format('Y-m-d'));
                })
                ->get();
        }

        $peakUtilizationData = collect($peakUtilizationData);

        return view('admin.reports', [
            'reservations' => $reservations ?? collect(),
            'peakUtilizationData' => $peakUtilizationData
        ])->withInput($request->all());
    }

    // Helper function to determine the appropriate grouping based on the date range
    private function determineGrouping($startDate, $endDate)
    {
        $dateDiff = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate));

        if ($dateDiff <= 7) {
            return 'days'; // Less than or equal to 7 days, group by days
        } elseif ($dateDiff <= 30) {
            return 'weeks'; // Less than or equal to 30 days, group by weeks
        } elseif ($dateDiff <= 365) {
            return 'months'; // Less than or equal to 365 days, group by months
        } else {
            return 'years'; // More than 365 days, group by years
        }
    }

    public function pdfGenerator(Request $request, $id){
        $reservations = ReservationDays::with('reservation')->where('reservationID', $id)->get();
        $imagePath = public_path('images/ustp.png');
        $reservationEquipments = ReservationEquipments::where('reservationID', $id)->get();
        $data = [
            'reservations' => $reservations,
            'imagePath' => $imagePath,
            'reservationEquipments' => $reservationEquipments,
        ];
        $pdf = Pdf::loadView('generatePdf', $data);
    
        // Use stream() to display the PDF in the browser
        return $pdf->stream('test.pdf');
    }
}
