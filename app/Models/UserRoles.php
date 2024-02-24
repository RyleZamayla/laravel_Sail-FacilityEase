<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'roleID', 'id');
    }

    protected $fillable = [
        'userID',
        'roleID',
        'created_by'
    ];

}
