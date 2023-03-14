<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use App\Models\Setting;
use Analytics as GA;
use App\Models\Visit;


class Analytics extends Controller
{
    public function getTotalVisitorsToday()
    {
        try {
            $v = new Visit();
            return $v->getVisitorsToday() ?? 1;
        } catch (\Throwable $th) {
            return 1;
        }
    }

    public function getTotalVisitors ()
    {
        try {
            $v = new Visit();

            return $v->getTotalVisitor() ?? 300000;
        } catch (\Throwable $th) {

            return 300000;
        }
    }

    public function getTotalVisitorsTomorrow()
    {
        try {
            $v = new Visit();

            return $v->getVisitorsTomorrow() ?? 0;
        } catch (\Throwable $th) {
            //throw $th
            return 0;
        }
    }
}
