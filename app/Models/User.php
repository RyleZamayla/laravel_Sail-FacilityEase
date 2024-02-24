<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

        protected $table = 'users';

    public function academic()
    {
        return $this->hasOne(Academics::class, 'userID', 'id');
    }

    public function nonacademic()
    {
        return $this->hasOne(Nonacademics::class, 'userID', 'id');
    }

    public function org_role()
    {
        return $this->hasMany(OrgRoles::class, 'userID', 'id');
    }

    public function user_role()
    {
        return $this->hasMany(UserRoles::class, 'userID', 'id', 'roleID');
    }

    public function facilities() //Ang purpose ani kay para ang makita lang sa facility incharge kay iyang assigned facility PS: DO NOT DELETE
    {
        return $this->hasMany(Facility::class, 'userRoleID', 'id');
    }

    public function facilityReservations() // for FIC, ang makita nga reservations kay sa iyang assigned facility
    {
        return $this->hasManyThrough(Reservation::class, Facility::class, 'userRoleID', 'facilityID', 'id', 'id');
    }

    public function getProfileImageAttribute() {
        if($this->img_url) {
            return config('app.url') . '/storage/' . $this->img_url;
        }

        return config('app.url') . '/images/profile.png';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'img_url',
        'email',
        'universityID',
        'name',
        'fName',
        'mName',
        'lName',
        'cNumber',
        'campus',
        'status',
        'provider',
        'provider_id',
        'provider_token',
        'email_verified_at',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
