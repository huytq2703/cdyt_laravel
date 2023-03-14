<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Majors;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class Admissions extends Model
{
    use HasFactory, SoftDeletes;

    const default = 0;
    const processed = 1;

    protected $fillable = [
        "full_name" ,
        "birthday",
        "gender",
        "religion",
        "nation",
        "level",
        "priority_object",
        "majors_id",
        "email",
        "phone_number",
        "address",
        "province_id",
        "district_id",
        "ward_id",
        "adviser_id",
        "adviser_name",
        "adviser_email",
        "adviser_phone_number",
        "processor_id",
        "processor_name",
        "processor_email",
        "processor_phone_number",
        "fist_send_email",
        "status",
        "verify_email_code",
        "notes"
    ];

    public function majors ()
    {
        return $this->hasOne(Majors::class, 'id', 'majors_id');
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
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }
}
