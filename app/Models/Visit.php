<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Visit extends Model
{
    use HasFactory;

    const today = 1;
    const total = 0;

    public function getVisitorsToday()
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');

        $v = Visit::where('date', $dt->toDateString())->where('status',self::today)->first();

        return $v?->count;
    }

    public function getTotalVisitor()
    {
        $v = Visit::whereNull('date')->where('status',self::total)->first();

        return $v?->count;
    }

    public function getVisitorsTomorrow()
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');

        $v = Visit::where('date', $dt->subDay()->toDateString())->where('status',self::today)->first();
        return $v?->count;
    }
}
