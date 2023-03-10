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
            'rad_Notice'      => self::rad_Notice
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
            return redirect()->route(self::rl_Notice)->with('toast.success', "T???o th??ng b??o th??nh c??ng");
            return redirect()->back()->with('toast.error', "T???o th??ng b??o th???t b???i");
    }

    public function update (Request $request, String $notifyId = null)
    {
        if ($request->isMethod('GET')) {
            $notice = Posts::whereType('notice')->find($notifyId);
            if (!$notice) return redirect()->back()->with('toast.error', "Kh??ng t??m th???y th??ng b??o");

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
            return redirect()->back()->with('toast.success', "C???p nh???t th??ng b??o th??nh c??ng");
            return redirect()->back()->with('toast.error', "C???p nh???t th??ng b??o th???t b???i");
    }

    public function delete(Request $request, String $notifyId)
    {
        $notifyModel = Posts::whereType('notice')->find($notifyId);

        $result = $notifyModel->delete();

        if ($result)
            return redirect()->back()->with('toast.success', "???? xo?? th??ng b??o");
            return redirect()->back()->with('toast.error', "Xo?? th??ng b??o th???t b???i");
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
                'required'  => "Vui l??ng nh???p ti??u ?????",
            ],
            'slug'  => [
                'required'  => "Vui l??ng nh???p ???????ng d???n",
                'unique'    => "???????ng d???n ???? t???n t???i"
            ],
            'content'       => ['required' => 'Vui l??ng nh???p n???i dung'],
        ])->validate();
    }
}
