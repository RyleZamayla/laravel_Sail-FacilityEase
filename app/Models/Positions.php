<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    use HasFactory;

    protected $table = 'positions';

    public function office()
    {
        return $this->belongsTo(Offices::class, 'officeID', 'id');
    }


    protected $fillable = [
        'officeID',
        'position',
        'status',
        'created by'
    ];

    public static function getPositions($officeID) {
        return Positions::where([
            ['officeID', $officeID],
            ['status', 'ACTIVE'],
        ])->select('id', 'position')->get();
    }
}
