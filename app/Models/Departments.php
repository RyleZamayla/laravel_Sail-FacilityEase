<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;

    protected $table = 'departments';

    public function college()
    {
        return $this->belongsTo(Colleges::class, 'collegeID', 'id');
    }


    protected $fillable = [
        'collegeID',
        'department',
        'created_by',
        'status'
    ];

    public static function getDepartments ($collegeID) {
        return Departments::where([
            ['collegeID', $collegeID],
            ['status', 'ACTIVE'],
        ])->select('id', 'department')->get();
    }
}
