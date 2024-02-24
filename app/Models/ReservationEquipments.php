<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Reservation;
use App\Models\Equipment;

class ReservationEquipments extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function reservation(){
        return $this->belongsTo(Reservation::class, 'reservationID', 'id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipmentID', 'id');
    }

    protected $fillable = [
        'reservationID',
        'equipmentID',
      
    ];

    protected $dates = ['deleted_at'];
    protected $table = 'reservation_equipments';
    protected $primaryKey = 'id';
}
