<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nonacademics extends Model
{
    use HasFactory;

    protected $table = 'nonacademics';

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    protected $fillable = [
        'userID',
        'office',
        'position',
    ];
}
