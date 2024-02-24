<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Facility;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function facility(){
        return $this->belongsTo(Facility::class, 'facilityID');
    }
    
    protected $fillable = [
        'facilityID',
        'equipment',
        'brand',
        'model',
        'quantity',
        'status',
        'created_by'
    ];

    protected $dates = ['deleted_at'];
    protected $table = 'equipment';
    protected $primaryKey = 'id';
}
