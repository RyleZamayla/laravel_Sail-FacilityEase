<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
    use HasFactory;

    protected $table = 'offices';

    public function position()
    {
        return $this->hasMany(Positions::class, 'positionID', 'id');
    }

    public function campus()
    {
        return $this->belongsTo(Campuses::class, 'campusID', 'id');
    }


    protected $fillable = [
        'campusID',
        'office',
        'status',
        'created_by'
    ];

    public static function getOffices ($campusID) {
        return Offices::where([
            ['campusID', $campusID],
            ['status', 'ACTIVE'],
        ])->select('id', 'office')->get();
    }
}
