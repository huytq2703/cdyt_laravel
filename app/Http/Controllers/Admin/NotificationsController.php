<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use App\Models\Posts;
use App\Models\Categories;

class NotificationsController extends Controller
{
    const rac_Category       = 'admin.category.create';
    const rc_Notice           = 'admin.notice.create.index';
    const rac_Notice          = 'admin.notice.create';
    const ru_Notice           = 'admin.notice.update.index';
    const rau_Notice          = 'admin.notice.update';
    const rad_Notice          = 'admin.notice.delete';
    const rl_Notice           = 'admin.notice';
    const rau_PostReject      = 'admin.posts.reject';
    public function index(Request $request)
    {

        $postModel          = new Posts();
        $categoriesModel    = new Categories();

        $posts = $postModel->getAll($request->all(), 'notice')->toArray();

        return Inertia::render('Admin/Notifications/Notifications', [
            'posts'         => $posts['data'],
            'pagination'    => [
                'perPage'       => $posts['per_page'],
                'currentPage'   => $posts['current_page'],
                'totalPages'    => $posts['last_page'],
                'totalRecords'  => $posts['total'],
                'first'         => $posts['from']
            ],
            'params'        => $request->all(),
            'categories'    => $categoriesModel->get(),
            'rc_Notice'       => self::rc_Notice,
            'ru_Notice'       => self::ru_Notice,
            'rau_Notice'      => self::rau_Notice,
            'rl_Notice'       => self::rl_Notice,
            'rad_Notice'      => self::rad_Notice,
            'rau_PostReject'    => self::rau_PostReject
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('GET')) {
            return Inertia::render('Admin/Notifications/NotificationDetails', [
                'rac_Notice'    => self::rac_Notice,
                'rl_Notice'       => self::rl_Notice,
            ]);
        }

        $userId = Auth::id();
        $inputs = $request->only(['title', 'slug', 'content', 'meta_title']);

        $this->validateNotification($inputs);

        $notifyModel = new Posts();
        $notifyModel->title         = $inputs['title'];
        $notifyModel->slug          = $inputs['slug'];
        $notifyModel->content       = $inputs['content'];
        $notifyModel->user_id       = $userId;
        $notifyModel->type          = 'notice';
        if (isset($inputs['meta_title'])) $notifyModel->meta_title    = $inputs['meta_title'];

        $result = $notifyModel->save();

        if ($result)
            return redirect()->route(self::rl_Notice)->with('toast.success', "Tạo thông báo thành công");
            return redirect()->back()->with('toast.error', "Tạo thông báo thất bại");
    }

    public function update (Request $request, String $notifyId = null)
    {
        if ($request->isMethod('GET')) {
            $notice = Posts::whereType('notice')->find($notifyId);
            if (!$notice) return redirect()->back()->with('toast.error', "Không tìm thấy thông báo");

            return Inertia::render('Admin/Notifications/NotificationDetails', [
                'notification'      => $notice,
                'rau_Notice'        => self::rau_Notice,
                'rl_Notice'         => self::rl_Notice,
            ]);
        }

        $inputs = $request->only(['title', 'slug', 'content', 'id', 'meta_title']);
        $this->validateNotification($inputs);

        $userModel  = Posts::find($inputs ['id']);
        $userModel->title   = $inputs['title'];
        $userModel->slug    = $inputs['slug'];
        $userModel->content = $inputs['content'];
        if (isset($inputs['meta_title'])) $userModel->meta_title = $inputs['meta_title'];

        $result = $userModel->save();

        if ($result)
            return redirect()->back()->with('toast.success', "Cập nhật thông báo thành công");
            return redirect()->back()->with('toast.error', "Cập nhật thông báo thất bại");
    }

    public function delete(Request $request, String $notifyId)
    {
        $notifyModel = Posts::whereType('notice')->find($notifyId);

        $result = $notifyModel->delete();

        if ($result)
            return redirect()->back()->with('toast.success', "Đã xoá thông báo");
            return redirect()->back()->with('toast.error', "Xoá thông báo thất bại");
    }

    public function validateNotification(Array $inputs)
    {
        $id = isset($inputs['id']) ? $inputs['id'] : null;

        Validator::make($inputs, [
            'title'         => ['required' ],
            'slug'          => ['required', 'unique:posts,slug,'.$id ],
            'content'       => ['required'],
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tiêu đề",
            ],
            'slug'  => [
                'required'  => "Vui lòng nhập đường dẫn",
                'unique'    => "Đường dẫn đã tồn tại"
            ],
            'content'       => ['required' => 'Vui lòng nhập nội dung'],
        ])->validate();
    }
}
