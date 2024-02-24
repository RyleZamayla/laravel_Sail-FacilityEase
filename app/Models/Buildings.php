<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buildings extends Model
{
    use HasFactory, SoftDeletes;

    public function campus(){
        return $this->belongsTo(Campuses::class, 'campusID');
    }

    protected $fillable = [
        'campusID',
        'buildingNumber',
        'building',
        'floor',
        'status',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
    protected $table = 'buildings';
    protected $primaryKey = 'id';

    public static function getBuildings ($buildingNumber) {
        return Buildings::where([
            ['buildingNumber', $buildingNumber],
        ])->select('id', 'buildingNumber', 'building')->get();
    }
}
