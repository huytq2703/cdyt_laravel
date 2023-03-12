<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Inertia\Inertia;

class TrainingController extends Controller
{
    public function schedulesIndex()
    {
        $postModel = Posts::whereType(Posts::schedules_type)->first();
        return Inertia::render('Training/FinalExamAndLeturerSchedule', [
            'post'   => $postModel
        ]);
    }

    public function lecturerScheduleIndex()
    {
        $postModel = Posts::whereType(Posts::lecturerSchedule_Type)->first();
        return Inertia::render('Training/FinalExamAndLeturerSchedule', [
            'post'   => $postModel
        ]);
    }

    public function finalExamScheduleIndex()
    {
        $postModel = Posts::whereType(Posts::lecturerSchedule_Type)->first();
        return Inertia::render('Training/FinalExamAndLeturerSchedule', [
            'post'   => $postModel
        ]);
    }
}
