<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;

class ReservationDays extends Model
{
    use HasFactory;

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservationID', 'id');
    }

    protected $table = 'reservation_days';

    protected $casts = [
        'startTime' => 'datetime:H:i',
        'endTime' => 'datetime:H:i',
    ];


    protected $fillable = [
        'reservationID',
        'days',
        'date',
        'startTime',
        'endTime',
    ];

    public function getDurationAttribute()
    {
        $start = new DateTime($this->startTime);
        $end = new DateTime($this->endTime);

        $interval = $start->diff($end);

        return $interval->h;
    }
}
