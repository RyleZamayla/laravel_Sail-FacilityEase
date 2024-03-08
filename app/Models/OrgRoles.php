<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgRoles extends Model
{
    use HasFactory;

    protected $table = 'org_roles';

    public function user()
    {
        return $this->hasMany(User::class, 'userID', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'orgID', 'id');
    }


    protected $fillable = [
        'userID',
        'orgID',
        'orgName',
        'orgPosition',
        'created_by'
    ];
}
