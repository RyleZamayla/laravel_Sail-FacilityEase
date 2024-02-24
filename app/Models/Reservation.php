<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facilityID', 'id', 'userRoleID');
    }
    public function user_role()
    {
        return $this->belongsTo(UserRoles::class, 'roleID', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'roleID', 'id');
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class, 'reservation_equipments', 'reservationID', 'equipmentID')
            ->withTimestamps();
    }

    public function documents()
    {
        return $this->hasMany(ReservationDocuments::class, 'reservationID', 'id');
    }

    public function reservation_equipment()
    {
        return $this->belongsToMany(ReservationEquipments::class, 'id', 'equipmentID')
            ->withTimestamps();
    }

    public function reservation_days()
    {
        return $this->hasMany(ReservationDays::class, 'reservationID', 'id');
    }

    public function reservation_view()
    {
        return $this->hasOne(ReservationView::class, 'reservationID', 'id');
    }

    public function getBgColorAttribute()
    {
        switch ($this->status) {
            case 'APPROVED':
                return 'bg-facilityEaseGreen';
            case 'PENCILBOOKED':
                return 'bg-facilityEaseBlue';
            case 'CANCELLED':
            case 'DECLINED':
            case 'REVOKED':
                return 'bg-facilityEaseRed';
            case 'PENDING':
            case 'RESCHEDULED':
                return 'bg-facilityEaseMain';
            case 'OCCUPIED':
                    return 'bg-facilityEaseTeal';
        
            default:
                return 'bg-facilityEaseYellow';
        }
    }

    protected $casts = [
        'startDate' => 'datetime:Y-m-d',
        'endDate' => 'datetime:Y-m-d',

    ];


    protected $fillable = [
        'userID',
        'facilityID',
        'roleID',
        'event',
        'startDate',
        'noOfdays',
        'endDate',
        'occupants',
        'status',
        'is_viewed'
    ];
}
