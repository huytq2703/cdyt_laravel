<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', [TestController::class, 'index'])->name('test');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Module Giới thiệu
Route::group(['prefix' => 'gioi-thieu'], function () {
    Route::get('/gioi-thieu-chung', function () {
        return Inertia::render("About/GeneralInfo");
    })->name('general_info');
    Route::get('/chuc-nang-nhiem-vu', function () {
        return Inertia::render("About/TaskFunction");
    })->name('task_function');
    Route::get('/co-cau-to-chuc', function () {
        return Inertia::render("About/OrganizationalStructure");
    })->name('organizational_structure');
    Route::get('/cong-khai-chat-luong', function () {
        return Inertia::render("About/PublicQuality");
    })->name('public_quality');
});

// Module Phòng khoa
Route::group(['prefix' => 'phong-khoa'], function () {
    Route::get('/phong-to-chuc-hanh-chinh', function () {
        return Inertia::render("DepartmentRoom/AdministrativeAffairsRoom");
    })->name('administrative_affairs_room');
    Route::get('/phong-dao-tao', function () {
        return Inertia::render("DepartmentRoom/TrainingRoom");
    })->name('training_room');
    Route::get('/phong-tai-chinh-ke-toan', function () {
        return Inertia::render("DepartmentRoom/FinanceAccountingRoom");
    })->name('finance_accounting_room');
    Route::get('/phong-cong-tac-hoc-sinh-sinh-vien', function () {
        return Inertia::render("DepartmentRoom/StudentAffairsRoom");
    })->name('student_affairs_room');
    Route::get('/phong-khao-thi-va-kiem-dinh-chat-luong', function () {
        return Inertia::render("DepartmentRoom/ExaminationRoom");
    })->name('examination_room');
    Route::get('/khoa-co-ban', function () {
        return Inertia::render("DepartmentRoom/BasicDepartment");
    })->name('basic_department');
    Route::get('/khoa-y', function () {
        return Inertia::render("DepartmentRoom/MedicalDepartment");
    })->name('medical_department');
    Route::get('/khoa-dieu-duong', function () {
        return Inertia::render("DepartmentRoom/NursingDepartment");
    })->name('nursing_department');
    Route::get('/khoa-duoc', function () {
        return Inertia::render("DepartmentRoom/PharmacyDepartment");
    })->name('pharmacy_department');
});

require __DIR__ . '/auth.php';
