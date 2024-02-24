<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colleges extends Model
{
    use HasFactory;

    protected $table = 'colleges';

    public function departments()
    {
        return $this->hasMany(Departments::class, 'departmentID', 'id');
    }

    public function campus()
    {
        return $this->belongsTo(Campuses::class, 'campusID', 'id');
    }


    protected $fillable = [
        'campusID',
        'college',
        'dean',
        'status',
        'created_by'
    ];

    public static function getColleges ($campusID) {
        return Colleges::where([
            ['campusID', $campusID],
            ['status', 'ACTIVE'],
        ])->select('id', 'college')->get();
    }
}
