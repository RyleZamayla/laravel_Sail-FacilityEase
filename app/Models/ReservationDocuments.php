<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Reservation;

class ReservationDocuments extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function reservation(){
        return $this->belongsTo(Reservation::class, 'reservationID', 'id');
    }

    protected $fillable = [
        'reservationID',
        'file',
      
    ];

    protected $dates = ['deleted_at'];
    protected $table = 'reservation_documents';
    protected $primaryKey = 'id';
}
