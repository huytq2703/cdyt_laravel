<?php

namespace App\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Posts;
use App\Models\Categories;

class PostController extends Controller
{
    public function index (Request $request)
    {
        $postModel          = new Posts();
        $categoriesModel    = new Categories();

        $posts = $postModel->getAll($request->all());

        return Inertia::render('Admin/Posts/Posts', [
            'posts'         => $posts,
            'categories'    => $categoriesModel->get(),
        ]);
    }

    /**
     * Create new post
     */
    public function createPost (Request $request)
    {
        Validator::make($request->all(), [
            'title'         => ['required', 'unique:posts'],
            'slug'          => ['required', 'unique:posts'],
            'content'       => ['required'],
            'categoryIds'   => ['required']
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tiêu đề",
                'unique'    => 'Bài viết đã tồn tại'
            ],
            'content'       => ['required' => 'Vui lòng nhập nội dung'],
            'categoryIds'   => ['required' => 'Vui lòng chọn danh mục']
        ])->validate();

        $inputs     = $request->all();
        $postModel  = new Posts();

        $result = $postModel->insertPost([
            ...$inputs,
            'user_id' => Auth::id(),
            'cover_image' => $inputs['coverImage']
        ]);

        if (!$result) return redirect()->route('admin.posts')->with('toast.error', 'Tạo bài viết thất bại');
        return redirect()->route('admin.posts')->with('toast.success', 'Tạo bài viết thành công');
    }

    public function preview (Request $request, String $postId)
    {
        $postModel = new Posts();

        return Inertia::render('Admin/Posts/PreviewPost', ['post' => $postModel->findById($postId)]);
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'title'         => ['required', 'unique:posts,title,'.$request->get('id')],
            'slug'          => ['required', 'unique:posts,slug,'.$request->get('id')],
            'content'       => ['required'],
            'categoryIds'   => ['required']
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tiêu đề",
                'unique'    => 'Bài viết đã tồn tại'
            ],
            'content'       => ['required' => 'Vui lòng nhập nội dung'],
            'categoryIds'   => ['required' => 'Vui lòng chọn danh mục']
        ])->validate();

        $inputs     = $request->all();
        $postModel  = new Posts();

        $result = $postModel->updatePost([
            ...$inputs,
            'user_id' => Auth::id(),
            'cover_image' => $inputs['coverImage']
        ]);

        if (!$result) return redirect()->route('admin.posts')->with('toast.error', 'Cập nhật bài viết thất bại');
        return redirect()->route('admin.posts')->with('toast.success', 'Cập nhật bài viết thành công');
    }
}
