<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\AdmissionsController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CareerDirectionController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TrainingController;

use Inertia\Inertia;

Route::put('/test-mai', [MailController::class, 'test'])->name('admin.test_mail');
Route::middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::put('/luu-noi-dun-cong-viec', [AdminController::class, 'index'])->name('admin.dashboard.save_task');

    // Students
    Route::group(['prefix' => 'sinh-vien'], function () {
        Route::get('tra-cuu-diem', function () {
            return Inertia::render('Admin/ScoreResult/ScoreResult');
        })->name('student.score');
        Route::get('tra-cuu-lich-hoc', function () {
            return Inertia::render('Admin/StudentSchedule/StudentSchedule');
        })->name('student.schedule');
        Route::get('tai-lieu-hoc-tap', function () {
            return Inertia::render('Admin/Document/LearningDoc');
        })->name('student.document');
        Route::get('thu-vien-bai-giang', function () {
            return Inertia::render('Admin/LectureLibrary/LectureLibrary');
        })->name('student.lecture_library');
    });

    // Training
    Route::group(['prefix' => 'dao-tao', 'middleware' => 'role_accept:training_manager'], function () {
        Route::middleware('role_accept:schedules')->group(function() {
            Route::get('lich-giang-day', [TrainingController::class,  "schedules"])->name('training.schedules');
            Route::put('lich-giang-day/{id}/cap-nhat', [TrainingController::class,  "updateSchedule"])->name('training.schedule.update');
            Route::post('lich-giang-day/tao-lich', [TrainingController::class,  "createSchedule"])->name('training.schedule.create');
            Route::post('lich-giang-day/{id}/xoa', [TrainingController::class,  "deleteSchedule"])->name('training.schedule.delete');
            Route::get('lich-thi-het-mon', [TrainingController::class,  "finalExamScheduleIndex"])->name('training.schedule.end_course_test');
        });

        Route::get('van-ban-dao-tao', function () {
            return Inertia::render('Admin/Document/TrainingDoc');
        })->name('training.training_doc');
    });

    // Posts
    Route::group(['prefix' => 'bai-viet', 'middleware' => 'role_accept:post'], function () {
        Route::get('', [PostController::class, 'index'])->name('admin.posts');

        Route::get('them-moi', [PostController::class, 'create'])->name('admin.posts.create.index');
        Route::post('them-moi', [PostController::class, 'create'])->name('admin.posts.create');

        Route::get('cap-nhat/{id}', [PostController::class, 'update'])->name('admin.posts.update.index');
        Route::put('cap-nhat', [PostController::class, 'update'])->name('admin.posts.update');

        Route::get('{id}/preview', [PostController::class, 'preview'])->name('admin.posts.preview');

        Route::delete('{id}/delete', [PostController::class, 'deletePost'])->name('admin.posts.delete');
        Route::put('{id}/reject', [PostController::class, 'rejectPosts'])->name('admin.posts.reject');

        Route::middleware('role_accept:content_verify')->get('kiem-duyet-noi-dung', [PostController::class, 'postsCreated'])->name('admin.posts.verify.list');
        Route::middleware('role_accept:content_verify')->put('duyet-noi-dung', [PostController::class, 'publishedPosts'])->name('admin.posts.approved');
    });

    // Category
    Route::group(['prefix' => 'danh-muc', 'middleware' => 'role_accept:category'], function () {
        Route::post('them-moi', [PostController::class, 'saveCategory'])->name('admin.category.create');

        Route::get('', [CategoryController::class, 'index'])->name('admin.category');
        Route::post('cap-nhat-va-them-moi-danh-muc', [CategoryController::class, 'save'])->name('admin.category.save');

        Route::delete('xoa-danh-muc/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    // Notifications
    Route::group(['prefix' => 'thong-bao', 'middleware' => 'role_accept:notice'], function () {
        Route::get('', [NotificationsController::class, 'index'])->name('admin.notice');

        Route::get('them-moi', [NotificationsController::class, 'create'])->name('admin.notice.create.index');
        Route::post('them-moi', [NotificationsController::class, 'create'])->name('admin.notice.create');

        Route::get('cap-nhat/{id}', [NotificationsController::class, 'update'])->name('admin.notice.update.index');
        Route::put('cap-nhat', [NotificationsController::class, 'update'])->name('admin.notice.update');

        Route::delete('{id}/delete', [NotificationsController::class, 'delete'])->name('admin.notice.delete');
    });

    // Career direction
    Route::group(['prefix' => 'huong-nghiep', 'middleware' => 'role_accept:career_direction'], function () {
        Route::get('', [CareerDirectionController::class, 'index'])->name('admin.career_direction');
        Route::post('', [CareerDirectionController::class, 'createTimeSlots'])->name('admin.time_slots.create');

        Route::get('chi-tiet/{id}', [CareerDirectionController::class, 'show'])->name('admin.time_slots.show');
        Route::put('chi-tiet/{id}', [CareerDirectionController::class, 'update'])->name('admin.time_slots.update');
    });

    // Admissions
    Route::group(['prefix' => 'tuyen-sinh', 'middleware' => 'accept:admissions'], function () {
        Route::get('', [AdmissionsController::class, 'index'])->name('admin.admissions');

        Route::get('chi-tiet', [AdmissionsController::class, 'show'])->name('admin.admissions.create');
        Route::get('chi-tiet/{id}', [AdmissionsController::class, 'show'])->name('admin.admissions.show');
        Route::put('chi-tiet/{id}/cap-nhat', [AdmissionsController::class, 'update'])->name('admin.admissions.update_action');
        Route::put('chi-tiet/{id}/xu-ly', [AdmissionsController::class, 'handleAdmissionRequest'])->name('admin.admissions.handle');
        Route::delete('chi-tiet/{id}/xoa', [AdmissionsController::class, 'delete'])->name('admin.admissions.delete');
        Route::put('chi-tiet/{id}/khoi-phuc', [AdmissionsController::class, 'restore'])->name('admin.admissions.restore');

        Route::post('/tao-moi', [AdmissionsController::class, 'create'])->name('admin.admissions.create_action');
    });

    // Majors
    Route::group(['prefix' => 'nganh-hoc', 'middleware' => 'role_accept:majors_manage'], function () {
        Route::get('', [MajorController::class, 'index'])->name('admin.majors');
        Route::post('', [MajorController::class, 'save'])->name('admin.majors.save');
        Route::put('{id}/cap-nhat', [MajorController::class, 'save'])->name('admin.majors.update');

        Route::delete('{id}/xoa', [MajorController::class, 'delete'])->name('admin.majors.delete');
        Route::put('{id}/khoi-phuc', [MajorController::class, 'restore'])->name('admin.majors.restore');
    });

    // Departments
    Route::group(['prefix' => 'phong-ban', 'middleware' => 'role_accept:departments'], function () {
        Route::get('', [DepartmentController::class, 'index'])->name('admin.departments');
        Route::post('them-phong-ban', [DepartmentController::class, 'save'])->name('admin.departments.create');

        Route::put('{id}/cap-nhat', [DepartmentController::class, 'save'])->name('admin.departments.update');
        Route::delete('{id}/xoa', [DepartmentController::class, 'delete'])->name('admin.departments.delete');

        Route::put('{id}/khoi-phuc', [DepartmentController::class, 'restore'])->name('admin.departments.restore');
    });

    // Static pages
    Route::group(['prefix' => 'trang-tinh', 'middleware' => 'role_accept:page'], function () {
        Route::get('', [PagesController::class, 'index'])->name('admin.pages');

        Route::get('them-moi', [PagesController::class, 'create'])->name('admin.pages.create.index');
        Route::post('them-moi', [PagesController::class, 'create'])->name('admin.pages.create');

        Route::get('cap-nhat/{id}', [PagesController::class, 'update'])->name('admin.pages.update.index');
        Route::put('cap-nhat', [PagesController::class, 'update'])->name('admin.pages.update');

        Route::get('{id}/preview', [PagesController::class, 'preview'])->name('admin.pages.preview');

        Route::delete('{id}/delete', [PagesController::class, 'delete'])->name('admin.pages.delete');

    });

    // Permission and account
    Route::middleware('role_accept:account,permission')->get('phan-quyen-va-tai-khoan', [PermissionController::class, 'index'])->name('system.permission');
    Route::middleware('role_accept:permission')->group(function() {
        Route::post('phan-quyen', [PermissionController::class, 'saveRole'])->name('system.permission.create');
        Route::delete('phan-quyen/{id}/xoa', [PermissionController::class, 'deleteRole'])->name('system.permission.delete');
        Route::put('phan-quyen/{id}/khoi-phuc', [PermissionController::class, 'restoreRole'])->name('system.permission.restore');

    });

    Route::middleware('role_accept:account')->group(function() {
        Route::post('tao-tai-khoan', [UserController::class, 'saveUser'])->name('system.user.create');
        Route::put('tai-khoan/{id}/cap-nhat', [UserController::class, 'saveUser'])->name('system.user.update');
        Route::put('tai-khoan/{id}/doi-mat-khau', [UserController::class, 'changePassword'])->name('system.user.change_password');
        Route::delete('tai-khoan/{id}/xoa', [UserController::class, 'deleteUser'])->name('system.user.delete');
        Route::put('tai-khoan/{id}/khoi-phuc', [UserController::class, 'restoreUser'])->name('system.user.restore');
    });

    Route::middleware('role_accept:menu')->group(function () {
        Route::get('quan-ly-menu', [AdminController::class, 'menu'])->name('system.menu');
        Route::post('tao-menu', [AdminController::class, 'createMenu'])->name('system.menu.create');
        Route::post('cap-nhat-menu', [AdminController::class, 'saveMenu'])->name('system.menu.update');
        Route::post('cap-nhat-sub-menu', [AdminController::class, 'saveSubMenu'])->name('system.submenu.update');
    });
    Route::middleware('role_accept:general_info')->group(function () {
        Route::get('cau-hinh', [SettingController::class, 'index'])->name('system.setting');
        Route::post('cau-hinh/luu-thong-tin-chung', [SettingController::class, 'saveGeneralInfo'])->name('system.setting.save_general_info');
        Route::post('cau-hinh/luu-thong-tin-thong-bao-chay', [SettingController::class, 'saveToasterMessage'])->name('system.setting.save_toaster_message');
    });

    // Others
    Route::group(['prefix' => 'dia-diem'], function () {
        Route::get('/tinh', [LocationController::class, 'getProvinces'])->name('admin.locations.provinces');
    });
});

require __DIR__.'/auth.php';
