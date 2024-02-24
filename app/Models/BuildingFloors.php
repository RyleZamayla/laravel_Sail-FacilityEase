<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuildingFloors extends Model
{
    use HasFactory, SoftDeletes;

    public function building()
    {
        return $this->belongsTo(Buildings::class, 'buildingID');
    }


    protected $fillable = [
        'buildingID',
        'floorNumber',
        'created_by',
        'status'
    ];

    public static function getFloors($buildingID)
    {
        return BuildingFloors::where([
            ['buildingID', $buildingID],
        ])->select('id', 'buildingID', 'floorNumber')->get();
    }
}
