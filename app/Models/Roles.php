<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    public function user_role()
    {
        return $this->hasMany(UserRoles::class, 'roleID', 'id');
    }

    protected $fillable = [
        'role',
        'status',
        'created_by'
    ];
}
