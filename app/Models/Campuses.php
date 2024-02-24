<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campuses extends Model
{
    use HasFactory;

    protected $table = 'campuses';

    public function college()
    {
        return $this->hasMany(College::class, 'campusID', 'id');
    }

    public function office()
    {
        return $this->hasMany(Office::class, 'campusID', 'id');
    }

    public function user_role()
    {
        return $this->hasMany(User_role::class, 'campusID', 'id');
    }


    protected $fillable = [
        'campus',
        'status',
        'created_by'
    ];
}
