<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QAController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
|
*/

Route::middleware('auth')->group(function () {
    // Module Sinh viên
    Route::group(['prefix' => 'sinh-vien'], function () {
        Route::get('/tra-cuu-diem', function () {
            return Inertia::render("Student/ScoreLookup");
        })->name('score_lookup');
        Route::get('/tra-cuu-lich-hoc', function () {
            return Inertia::render("Student/ClassTimetableLookup");
        })->name('class_timetable_lookup');
        Route::get('/tai-lieu-hoc-tap', function () {
            return Inertia::render("Student/LearningResources");
        })->name('learning_resources');
        Route::get('/thu-vien-bai-giang', function () {
            return Inertia::render("Student/LectureLibrary");
        })->name('lecture_library');
    });


});

require __DIR__ . '/auth.php';
