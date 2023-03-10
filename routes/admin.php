<?php

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

use Inertia\Inertia;

Route::put('/test-mai', [MailController::class, 'test'])->name('admin.test_mail');
Route::middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

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
    Route::group(['prefix' => 'dao-tao'], function () {
        Route::get('chuong-trinh-dao-tao', function () {
            return Inertia::render('Admin/Train/TrainingManagement');
        })->name('training.program');
        Route::get('lich-giang-vien', function () {
            return Inertia::render('Admin/LecturerSchedule/LecturerSchedule');
        })->name('training.schedule');
        Route::get('lich-thi-het-mon', function () {
            return Inertia::render('Admin/TestSchedule/EndCourseTestSchedule');
        })->name('training.schedule.end_course_test');
        Route::get('van-ban-dao-tao', function () {
            return Inertia::render('Admin/Document/TrainingDoc');
        })->name('training.training_doc');
    });

    // Posts
    Route::group(['prefix' => 'bai-viet', 'middleware' => 'role_reject'], function () {
        Route::get('', [PostController::class, 'index'])->name('admin.posts');

        Route::get('them-moi', [PostController::class, 'create'])->name('admin.posts.create.index');
        Route::post('them-moi', [PostController::class, 'create'])->name('admin.posts.create');

        Route::get('cap-nhat/{id}', [PostController::class, 'update'])->name('admin.posts.update.index');
        Route::put('cap-nhat', [PostController::class, 'update'])->name('admin.posts.update');

        Route::get('{id}/preview', [PostController::class, 'preview'])->name('admin.posts.preview');

        Route::delete('{id}/delete', [PostController::class, 'deletePost'])->name('admin.posts.delete');

        Route::middleware('role_reject:POST_WRITER')->get('kiem-duyet-noi-dung', [PostController::class, 'postsCreated'])->name('admin.posts.verify.list');
        Route::middleware('role_reject:POST_WRITER')->put('duyet-noi-dung', [PostController::class, 'publishedPosts'])->name('admin.posts.approved');
    });

    // Category
    Route::group(['prefix' => 'danh-muc'], function () {
        Route::post('them-moi', [PostController::class, 'saveCategory'])->name('admin.category.create');

        Route::get('', [CategoryController::class, 'index'])->name('admin.category');
        Route::post('cap-nhat-va-them-moi-danh-muc', [CategoryController::class, 'save'])->name('admin.category.save');

        Route::delete('xoa-danh-muc/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    // Notifications
    Route::group(['prefix' => 'thong-bao', 'middleware' => 'role_reject'], function () {
        Route::get('', [NotificationsController::class, 'index'])->name('admin.notice');

        Route::get('them-moi', [NotificationsController::class, 'create'])->name('admin.notice.create.index');
        Route::post('them-moi', [NotificationsController::class, 'create'])->name('admin.notice.create');

        Route::get('cap-nhat/{id}', [NotificationsController::class, 'update'])->name('admin.notice.update.index');
        Route::put('cap-nhat', [NotificationsController::class, 'update'])->name('admin.notice.update');

        Route::delete('{id}/delete', [NotificationsController::class, 'delete'])->name('admin.notice.delete');
    });

    // Admissions
    Route::group(['prefix' => 'tuyen-sinh', 'middleware' => 'role_reject'], function () {
        Route::get('', [AdmissionsController::class, 'index'])->name('admin.admissions');

        Route::get('chi-tiet/{id}', [AdmissionsController::class, 'show'])->name('admin.admissions.show');
        // Route::get('them-moi', [NotificationsController::class, 'create'])->name('admin.notification.create.index');
        // Route::post('them-moi', [NotificationsController::class, 'create'])->name('admin.notification.create');

        // Route::get('chinh-sua/{id}', [NotificationsController::class, 'update'])->name('admin.notification.update.index');
        // Route::put('chinh-sua', [NotificationsController::class, 'update'])->name('admin.notification.update');

        // Route::delete('xoa/{id}', [NotificationsController::class, 'delete'])->name('admin.notification.delete');
    });

    // Static pages
    Route::group(['prefix' => 'trang-tinh', 'middleware' => 'role_reject'], function () {
        Route::get('', [PagesController::class, 'index'])->name('admin.pages');

        Route::get('them-moi', [PagesController::class, 'create'])->name('admin.pages.create.index');
        Route::post('them-moi', [PagesController::class, 'create'])->name('admin.pages.create');

        Route::get('cap-nhat/{id}', [PagesController::class, 'update'])->name('admin.pages.update.index');
        Route::put('cap-nhat', [PagesController::class, 'update'])->name('admin.pages.update');

        Route::get('{id}/preview', [PagesController::class, 'preview'])->name('admin.pages.preview');

        Route::delete('{id}/delete', [PagesController::class, 'delete'])->name('admin.pages.delete');

    });


    // System
    Route::middleware('role_accept:SUPER_ADMIN,ADMIN')->group(function () {
        Route::get('tai-khoan', [UserController::class, 'index'])->name('system.user');
        Route::post('tao-tai-khoan', [UserController::class, 'saveUser'])->name('system.user.create');
        Route::get('phan-quyen', [PermissionController::class, 'index'])->name('system.permission');
        Route::post('phan-quyen', [PermissionController::class, 'saveRole'])->name('system.permission.create');

        Route::get('quan-ly-menu', [AdminController::class, 'menu'])->name('system.menu');
        Route::post('tao-menu', [AdminController::class, 'createMenu'])->name('system.menu.create');
        Route::post('cap-nhat-menu', [AdminController::class, 'saveMenu'])->name('system.menu.update');

        Route::post('cap-nhat-sub-menu', [AdminController::class, 'saveSubMenu'])->name('system.submenu.update');
    });

    // Others
    Route::group(['prefix' => 'dia-diem'], function () {
        Route::get('/tinh', [LocationController::class, 'getProvinces'])->name('admin.locations.provinces');
    });
});

require __DIR__.'/auth.php';
