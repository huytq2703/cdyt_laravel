<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Province;
use app\Models\Ward;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'gso_id',
        'published',
        'province_id',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function wards()
    {
        return $this->hasMany(Ward::class, 'district_id');
    }
}
