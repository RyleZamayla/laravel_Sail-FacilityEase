<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BuildingFloors;
use App\Models\UserRoles;
use Carbon\Carbon;
use DateTime;

class Facility extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function building(){
        return $this->belongsTo(Buildings::class, 'buildingID');
    }

    public function building_floor(){
        return $this->belongsTo(BuildingFloors::class, 'buildingFloorID');
    }

    public function user_role()
    {
        return $this->belongsTo(UserRoles::class, 'userRoleID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID','userRoleID');
    }

    public function getStorageImageUrlAttribute() {
        return config('app.url') . '/storage/' . $this->img_url;
    }

    protected $fillable=[
        'buildingID',
        'buildingFloorID',
        'userRoleID',
        'facility',
        'capacity',
        'status',
        'noOfHours',
        'openTime',
        'closeTime',
        'maxDays',
        'maxHours',
        'img_url',
        'created_by',
    ];

    protected $casts = [
        'openTime' => 'datetime:H:i',
        'closeTime' => 'datetime:H:i',
    ];

    protected $dates = ['deleted_at'];
    protected $table = 'facilities';
    protected $primaryKey = 'id';

    public function getDurationAttribute()
    {
        $open = new DateTime($this->openTime);
        $close = new DateTime($this->closeTime);

        $interval = $start->diff($end);

        return $interval->h;
    }
}
