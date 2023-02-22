<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TimeSlot;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;


class CareerDirectionProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone_number',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'free_date',
        'time_slot_id',
    ];

    public function time ()
    {
        return $this->hasOne(TimeSlot::class, 'id', 'time_slot_id');
    }

    public function province ()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function district ()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function ward ()
    {
        return $this->hasOne(ward::class, 'id', 'ward_id');
    }
}
