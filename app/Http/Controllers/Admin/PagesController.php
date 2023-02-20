<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Posts;
use App\Models\Categories;

class PagesController extends Controller
{
    const rac_Category      = 'admin.category.create';
    const rc_Page           = 'admin.pages.create.index';
    const rac_Page          = 'admin.pages.create';
    const ru_Page           = 'admin.pages.update.index';
    const rau_Page          = 'admin.pages.update';
    const rad_Page          = 'admin.pages.delete';
    const rl_Page           = 'admin.pages';
    const rpv_Page          = 'admin.pages.preview';

    public function index(Request $request)
    {
        $postModel          = new Posts();
        $categoriesModel    = new Categories();

        $posts = $postModel->getAll($request->all(), 'page')->toArray();

        return Inertia::render('Admin/Pages/StaticPages', [
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
            'rc_Page'       => self::rc_Page,
            'ru_Page'       => self::ru_Page,
            'rau_Page'      => self::rau_Page,
            'rl_Page'       => self::rl_Page,
            'rpv_Page'      => self::rpv_Page,
            'rad_Page'      => self::rad_Page
        ]);
    }

    public function create (Request $request)
    {
        if ($request->isMethod('GET')) {
            $categoriesModel    = new Categories();
            return Inertia::render('Admin/Pages/PageDetails', [
                'rac_Page'      => self::rac_Page,
                'rc_Page'       => self::rc_Page,
                'ru_Page'       => self::ru_Page,
                'rad_Page'      => self::rad_Page,
                'rl_Page'       => self::rl_Page,
                'rau_Page'      => self::rau_Page,
                'rac_Category'  => self::rac_Category,
                'categories'    => $categoriesModel->get(),
            ]);
        }

        $this->validatePost($request->all());

        $inputs     = $request->all();
        $postModel  = new Posts();

        $result = $postModel->insertPost([
            ...$inputs,
            'type'  => 'page',
            'user_id' => Auth::id(),
        ]);

        if (!$result) return redirect()->back()->with('toast.error', 'Tạo trang web thất bại');
        return redirect()->route(self::rl_Page)->with('toast.success', 'Tạo trang web thành công');
    }

    public function update(Request $request, String $postId = null)
    {
        if ($request->isMethod('GET')) {
            $categoriesModel    = new Categories();
            $post = Posts::with('categories')->whereType('page')->find($postId);

            if (!$post) return redirect()->back()->with('toast.error', 'Trang không tồn tại');

            return Inertia::render('Admin/Pages/PageDetails', [
                'rac_Page'      => self::rac_Page,
                'rc_Page'       => self::rc_Page,
                'ru_Page'       => self::ru_Page,
                'rad_Page'      => self::rad_Page,
                'rl_Page'       => self::rl_Page,
                'rau_Page'      => self::rau_Page,
                'rac_Category'  => self::rac_Category,
                'categories'    => $categoriesModel->get(),
                'post'          => $post
            ]);
        }

        $this->validatePost($request->all());
        $inputs     = $request->all();
        $postModel  = new Posts();

        $result = $postModel->updatePost([
            ...$inputs,
            'user_id' => Auth::id(),
            'cover_image' => $inputs['coverImage']
        ]);

        if (!$result) return redirect()->back()->with('toast.error', 'Cập nhật bài viết thất bại');
        return redirect()->back()->with('toast.success', 'Cập nhật bài viết thành công');
    }

    public function delete(Request $request, String $postId)
    {
        $menu = Menu::wherePostId($postId)->exists();

        if ($menu) {
            return redirect()->back()->with('toast.warn', 'Trang web đang sử dụng trong menu nên không thể xoá');
        }
        $postModel  = new Posts();

        $post = $postModel->whereType('page')->find($postId);
        $result = $post->delete();

        if (!$result) return redirect()->back()->with('toast.error', 'Xoá trang web thất bại');
        return redirect()->back()->with('toast.success', 'Xoá trang web thành công');
    }

    public function validatePost (Array $inputs)
    {
        $id = (isset($inputs['id']) && $inputs['id']) ? $inputs['id'] : null;

        Validator::make($inputs, [
            'title'         => ['required', 'unique:posts,title,'.$id ],
            'slug'          => ['required', 'unique:posts,slug,'.$id ],
            'content'       => ['required'],
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tiêu đề",
                'unique'    => 'Trang web đã tồn tại'
            ],
            'content'       => ['required' => 'Vui lòng nhập nội dung'],
        ])->validate();
    }
}
