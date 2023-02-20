<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemDefine extends Model
{
    use HasFactory;

    protected $casts = [
        'values' => 'array',
    ];
}
