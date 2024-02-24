<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academics extends Model
{
    use HasFactory;

    protected $table = 'academics';

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }


    protected $fillable = [
        'userID',
        'college',
        'department',
    ];
}
