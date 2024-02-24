<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;



class ReservationView extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function reservation(){
        return $this->belongsTo(Reservation::class, 'reservationID', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }


    protected $fillable = [
        'userID',
        'reservationID',
        'is_viewed'
      
    ];

    protected $dates = ['deleted_at'];
    protected $table = 'reservation_view';
    protected $primaryKey = 'id';
}
