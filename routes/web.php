<?php

use App\Http\Controllers\Admin\CareerDirectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QAController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\AdmissionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/test', [TestController::class, 'index'])->name('test');
Route::middleware('auth')->group(function () {
    Route::post('dang-xuat', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
Route::get('dang-nhap', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('dang-nhap', [AuthenticatedSessionController::class, 'store']);

Route::get('/hoi-dap', [QAController::class, 'index'])->name('qaform');
Route::post('/hoi-dap/gui-cau-hoi', [QAController::class, 'submitQuestions'])->name('qaform.submit');

Route::get('lien-he', [ContactController::class, 'index'])->name('contact');
Route::post('lien-he/gui-thong-tin', [ContactController::class, 'createContact'])->name('contact.create');

Route::middleware('visit_counter')->get('/', [HomeController::class, 'index'])->name('home');
Route::middleware('visit_counter')->get('/trang-chu', [HomeController::class, 'index']);
// Hướng nghiệp
Route::get('/huong-nghiep', function () {
    return Inertia::render("CareerDirection/CareerDirection");
})->name('career_direction');
Route::post('/huong-nghiep/dang-ky',[CareerDirectionController::class, 'create'])->name('career_direction.register');

// Module Tuyển sinh
Route::group(['prefix' => ''], function () {
    Route::get('/thong-bao-tuyen-sinh', [AdmissionsController::class, 'noticeAdmission'])->name('enrollment_notice');
    Route::get('/dang-ky-tuyen-sinh', [AdmissionsController::class, 'registerAdmissions'])->name('online_enrollment_registration');
    Route::post('/dang-ky-tuyen-sinh', [AdmissionsController::class, 'registerAdmissions'])->name('online_enrollment_registration.action');

    Route::get('/ket-qua-tuyen-sinh', function () {
        return Inertia::render("Enrollment/OnlineEnrollmentRegistration");
    })->name('enrollment_result');
});

// Module Đào tạo
Route::group(['prefix' => ''], function () {
    Route::get('/chuong-trinh-dao-tao', function () {
        return Inertia::render("Training/TrainingProgram");
    })->name('training_program');

    // Route::get('/lich-giang-vien', [TrainingController::class, 'lecturerScheduleIndex'])->name('lecturer_schedule');

    // Route::get('/lich-thi-het-mon', [TrainingController::class, 'finalExamScheduleIndex'])->name('final_exam_schedule');

    Route::get('/van-ban-dao-tao', function () {
        return Inertia::render("Training/TrainingDocument");
    })->middleware(['auth', 'verified'])->name('training_document');
});

Route::get('{category_slug}', [HomeController::class, 'post'])->name('category');
Route::get('{parent_slug}/{child_slug}', [HomeController::class, 'post'])->name('post');



//
// Route::post('/tao-cau-hoi', [QAController::class, 'createQuestion'])->name('qaform.createQuestion');

//
// Route::post('/tao-lien-he', [ContactController::class, 'createContact'])->name('contact.create');

//



require __DIR__ . '/auth.php';
