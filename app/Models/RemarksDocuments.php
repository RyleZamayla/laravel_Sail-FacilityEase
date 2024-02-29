<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Reservation;

class RemarksDocuments extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function reservation(){
        return $this->belongsTo(Reservation::class, 'reservationID', 'id');
    }

    protected $fillable = [
        'reservationID',
        'remarksFiles',
      
    ];

    protected $dates = ['deleted_at'];
    protected $table = 'remarks_documents';
    protected $primaryKey = 'id';
}
