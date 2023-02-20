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

    const rac_Category      = 'admin.category.create';
    const rc_Post           = 'admin.posts.create.index';
    const rac_Post          = 'admin.posts.create';
    const ru_Post           = 'admin.posts.update.index';
    const rau_Post          = 'admin.posts.update';
    const rad_Post          = 'admin.posts.delete';
    const rl_Post           = 'admin.posts';
    const rpv_Post          = 'admin.posts.preview';
    const rl_PostsCreated   = 'admin.posts.verify.list';
    const rau_PostsPublished = 'admin.posts.approved';


    public function index (Request $request)
    {
        $postModel          = new Posts();
        $categoriesModel    = new Categories();

        $posts = $postModel->getAll($request->all())->toArray();

        return Inertia::render('Admin/Posts/Posts', [
            'posts'         => $posts['data'],
            'pagination'    => [
                'perPage'       => $posts['per_page'],
                'currentPage'   => $posts['current_page'],
                'totalPages'    => $posts['last_page'],
                'totalRecords'  => $posts['total'],
                'first'         => $posts['from']
            ],
            'params'        => $request->all(),
            'categories'    => $categoriesModel->whereType('category')->get(),
            'rc_Post'       => self::rc_Post,
            'ru_Post'       => self::ru_Post,
            'rad_Post'      => self::rad_Post,
            'rl_Post'       => self::rl_Post,
            'rpv_Post'      => self::rpv_Post
        ]);
    }

    /**
     * Create new post
     */
    public function create (Request $request)
    {
        if ($request->isMethod('GET')) {
            $categoriesModel    = new Categories();
            return Inertia::render('Admin/Posts/PostDetails', [
                'rac_Post'      => self::rac_Post,
                'rc_Post'       => self::rc_Post,
                'ru_Post'       => self::ru_Post,
                'rad_Post'      => self::rad_Post,
                'rl_Post'       => self::rl_Post,
                'rau_Post'      => self::rau_Post,
                'rac_Category'  => self::rac_Category,
                'categories'    => $categoriesModel->whereType('category')->get(),
            ]);
        }

        $this->validatePost($request->all());

        $inputs     = $request->all();

        $postModel  = new Posts();

        $result = $postModel->insertPost([
            ...$inputs,
            'user_id' => Auth::id(),
            'cover_image' => $inputs['coverImage'],
            'type'  => 'post'
        ]);

        if (!$result) return redirect()->back()->with('toast.error', 'Tạo bài viết thất bại');
        return redirect()->back()->with('toast.success', 'Tạo bài viết thành công');
    }

    public function preview (Request $request, String $postId)
    {
        $postModel = new Posts();

        return Inertia::render('Admin/Posts/PreviewPost', ['post' => $postModel->findById($postId)]);
    }

    public function update(Request $request, String $postId = null)
    {
        if ($request->isMethod('GET')) {
            $categoriesModel    = new Categories();
            $post = Posts::with('categories')->find($postId);

            return Inertia::render('Admin/Posts/PostDetails', [
                'rac_Post'      => self::rac_Post,
                'rc_Post'       => self::rc_Post,
                'ru_Post'       => self::ru_Post,
                'rad_Post'      => self::rad_Post,
                'rl_Post'       => self::rl_Post,
                'rau_Post'      => self::rau_Post,
                'rac_Category'  => self::rac_Category,
                'categories'    => $categoriesModel->whereType('category')->get(),
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

    public function deletePost(Request $request, String $postId)
    {
        $postModel  = new Posts();

        $post = $postModel->findById($postId);
        $result = $post->delete();

        if (!$result) return redirect()->route('admin.posts')->with('toast.error', 'Xoá bài viết thất bại');
        return redirect()->route('admin.posts')->with('toast.success', 'Xoá bài viết thành công');
    }

    public function saveCategory (Request $request)
    {
        $inputs = $request->only(['title', 'slug', 'content', '']);

        $this->validateCategory($inputs);

        $categoryModel = new Categories();
        $categoryModel->title = $inputs['title'];
        $categoryModel->slug = $inputs['slug'];
        $categoryModel->type = 'category';
        if (isset($inputs['meta_title'])) $categoryModel->meta_title = $inputs['meta_title'];
        if (isset($inputs['content'])) $categoryModel->content = $inputs['content'];

        $result = $categoryModel->save();

        if (!$result) return redirect()->back()->with('toast.error', 'Không thể tạo danh mục');
        return redirect()->back()->with('toast.success', 'Tạo danh mục thành công');

    }

    public function validatePost (Array $inputs)
    {
        $id = (isset($inputs['id']) && $inputs['id']) ? $inputs['id'] : null;

        Validator::make($inputs, [
            'title'         => ['required', 'unique:posts,title,'.$id ],
            'slug'          => ['required', 'unique:posts,slug,'.$id ],
            'content'       => ['required'],
            // 'categoryIds'   => ['required']
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tiêu đề",
                'unique'    => 'Bài viết đã tồn tại'
            ],
            'content'       => ['required' => 'Vui lòng nhập nội dung'],
            // 'categoryIds'   => ['required' => 'Vui lòng chọn danh mục']
        ])->validate();
    }

    public function validateCategory (Array $inputs)
    {
        $id = isset($inputs['id']) ? $inputs['id'] : null;

        Validator::make($inputs, [
            'title'         => ['required', 'unique:categories,title,'.$id],
            'slug'          => ['required', 'unique:categories,slug,'.$id],
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tiêu đề",
                'unique'    => 'Danh mục đã tồn tại'
            ],
        ])->validate();
    }

    public function postsCreated (Request $request)
    {
        $postModel          = new Posts();
        $categoriesModel    = new Categories();

        $type = $request->type ?? 'post';
        $filters = [
            ...$request->all(),
            'published' => Posts::status_created
        ];

        $posts = $postModel->getAll($filters, $type)->toArray();

        return Inertia::render('Admin/Posts/PostModeration', [
            'posts'         => $posts['data'],
            'pagination'    => [
                'perPage'       => $posts['per_page'],
                'currentPage'   => $posts['current_page'],
                'totalPages'    => $posts['last_page'],
                'totalRecords'  => $posts['total'],
                'first'         => $posts['from']
            ],
            'rl_PostsCreated'       => self::rl_PostsCreated,
            'rau_PostsPublished'    => self::rau_PostsPublished
        ]);
    }

    public function publishedPosts (Request $request, String $action = 'publish') // publish, private
    {
        $postModel          = new Posts();

        // $postModel->whereInId($request->ids)->get()->toArray();

        $result = $postModel->whereIn('id', $request->ids)->update(['published' => Posts::status_published]);

        if ($result) return redirect()->back()->with('toast.success', 'Đã duyệt bài viết');
        return redirect()->back()->with('toast.error', 'Không thể duyệt bài viết');
    }
}
