<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Auth\SendActionLink\FailedToSendActionLink;

class TimeSlot extends Model
{
    use HasFactory;

    public $timestamps = false;
}
