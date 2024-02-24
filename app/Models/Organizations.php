<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{
    use HasFactory;

    protected $table = 'organizations';

    public function org_role()
    {
        return $this->hasMany(OrgRoles::class, 'orgID', 'id');
    }


    protected $fillable = [
        'orgName',
        'moderator',
        'status',
        'created_by',
    ];
}
