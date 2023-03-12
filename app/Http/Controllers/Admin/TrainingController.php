<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Posts;
use Inertia\Inertia;

class TrainingController extends Controller
{
    const rau_LecturerSchedule = "training.schedule.update";
    const rau_Schedule = "training.schedule.update";
    const rac_Schedule = 'training.schedule.create';
    const rad_Schedule = 'training.schedule.delete';

    public function lecturerScheduleIndex()
    {
        // $postModel = Posts::whereType(Posts::lecturerSchedule_Type)->first();

        // return Inertia::render('Admin/LecturerSchedule/LecturerSchedule', [
        //     "post"  => $postModel,
        //     'rau_LecturerSchedule' =>self::rau_LecturerSchedule
        // ]);
    }

    public function lecturerScheduleUpdate(Request $request)
    {
        // $inputs     = $request->all();
        // $postModel  = Posts::whereType(Posts::lecturerSchedule_Type)->first();

        // $postModel->title       = $inputs['title'];
        // $postModel->meta_title  = $inputs['meta_title'];
        // $postModel->content     = $inputs['content'] ?? "";

        // $result = $postModel->save();

        // if ($result) return redirect()->back()->with('toast.success', "Đã cập nhật lịch giảng viên");
        // return redirect()->back()->with('toast.error', "Cập nhật lịch giảng viên thất bại");
    }

    public function finalExamScheduleIndex()
    {
        return Inertia::render('Admin/TestSchedule/EndCourseTestSchedule');
    }

    public function schedules()
    {
        $posts = Posts::whereType(Posts::schedules_type)->get();

        return Inertia::render('Admin/Schedules/ScheduleManage', [
            'posts' => $posts,
            "rau_Schedule" => self::rau_Schedule,
            'rac_Schedule'  => self::rac_Schedule,
            'rad_Schedule'  => self::rad_Schedule
        ]);
    }

    public function updateSchedule(Request $request, String $id)
    {

        $inputs     = $request->all();

        Validator::make($inputs, [
            'title'         => ['required', 'unique:posts,title,'.$id ],
            'slug'          => ['required', 'unique:posts,slug,'.$id ],
            'content'       => ['required'],
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tên",
                'unique'    => 'Lịch đã tồn tại'
            ],
            'slug'          => [
                'required'  => 'Vui lòng nhập đường dẫn',
                'unique'    => 'Đường dẫn đã tồn tại'
            ],
            'content'       => ['required' => 'Vui lòng nhập nội dung'],
        ])->validate();

        $postModel  = Posts::find($id);

        if (!$postModel) return redirect()->back()->with('toast.error', "Không tìm thấy lịch");

        $postModel->title       = $inputs['title'];
        $postModel->meta_title  = $inputs['meta_title'];
        $postModel->content     = $inputs['content'] ?? "";
        $postModel->slug        = $inputs['slug'] ?? "";

        $result = $postModel->save();

        if ($result) return redirect()->back()->with('toast.success', "Đã cập nhật lịch");
        return redirect()->back()->with('toast.error', "Cập nhật lịch thất bại");
    }

    public function createSchedule(Request $request)
    {
        $inputs     = $request->all();

        Validator::make($inputs, [
            'title'         => ['required', 'unique:posts' ],
            'slug'          => ['required', 'unique:posts'],
            'content'       => ['required'],
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tên",
                'unique'    => 'Lịch đã tồn tại'
            ],
            'slug'          => [
                'required'  => 'Vui lòng nhập đường dẫn',
                'unique'    => 'Đường dẫn đã tồn tại'
            ],
            'content'       => ['required' => 'Vui lòng nhập nội dung'],
        ])->validate();

        $postModel  = new Posts();

        $postModel->title       = $inputs['title'];
        $postModel->meta_title  = $inputs['meta_title'];
        $postModel->content     = $inputs['content'] ?? "";
        $postModel->slug        = $inputs['slug'] ?? "";
        $postModel->published   = 1;
        $postModel->type        = Posts::schedules_type;
        $postModel->user_id     = Auth::id();

        $result = $postModel->save();

        if ($result) return redirect()->back()->with('toast.success', "Đã tạo lịch mới");
        return redirect()->back()->with('toast.error', "Tạo lịch thất bại");
    }

    public function deleteSchedule(String $id)
    {
        $menu = Menu::wherePostId($id)->first();

        if ($menu) return redirect()->back()->with('toast.warn', "Lịch đang được xuất hiện trong menu nên không thể xoá!");

        $post = Posts::find($id);

        $result =  $post->delete();
        if ($result) return redirect()->back()->with('toast.success', "Đã xoá lịch");
        return redirect()->back()->with('toast.error', "Xoá lịch không thành công");
    }
}
