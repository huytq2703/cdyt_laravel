<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Categories;
use App\Models\CategoryPost;
use App\Models\Menu;

class CategoryController extends Controller
{

    const rl_Category = "admin.category";
    const ras_Category = "admin.category.save";
    const rad_Category = "admin.category.delete";
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $builder = Categories::whereType('category')->latest('updated_at');
        $params = $request->all();

        if (isset($params['search'])) {

            $builder->where(function ($search) use($params) {
                $search->where('title', 'like', "%{$params['search']}%")
                ->orWhere('slug', 'like', "%{$params['search']}%");
            });
        }

        return Inertia::render('Admin/Posts/Categories', [
            'rl_Category'   => self::rl_Category,
            'ras_Category'  => self::ras_Category,
            'rad_Category'  => self::rad_Category,
            'categories' => $builder->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        Validator::make($request->all(), [
            'title'         => ['required', 'unique:categories,title,'.$request->id ],
            'slug'          => ['required', 'unique:categories,slug,'.$request->id ],
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tiêu đề",
                'unique'    => 'Danh mục đã tồn tại hoặc trùng với danh mục khác'
            ],
            'slug' => [
                'required'  => "Vui lòng nhập đường dẫn",
                'unique'    => 'Đường dẫn đã tồn tại hoặc trùng đường dẫn với danh mục khác'
            ],
        ])->validate();

        $inputs = $request->only(['title', 'slug', 'id', 'meta_title']);
        if ($inputs['id']) {
            $updateCategory = Categories::find($inputs['id']);

            if ($updateCategory->menu_type === "system" && $updateCategory->slug !== $inputs['slug']) {
                return redirect()->back()->with('toast.warn', 'Danh mục thuộc hệ thống không thay đổi slug');
            }

            $updateCategory->title = $inputs['title'];
            $updateCategory->slug = $inputs['slug'];
            if (isset($inputs['meta_title'])) $updateCategory->meta_title = $inputs['meta_title'];

            $result = $updateCategory->save();

            if ($result)  return redirect()->back()->with('toast.success', 'Đã cập nhật danh mục');
            return redirect()->back()->with('toast.errors', 'Cập nhật thất bại');
        }

        $newCategory = new Categories();

        $newCategory->title = $inputs['title'];
        $newCategory->slug = $inputs['slug'];
        $newCategory->type = 'category';
        if (isset($inputs['meta_title'])) $newCategory->meta_title = $inputs['meta_title'];


        $result = $newCategory->save();

        if ($result)  return redirect()->back()->with('toast.success', 'Đã thêm mới danh mục');
        return redirect()->back()->with('toast.errors', 'Thêm mới thất bại');
    }

    public function delete (String|Int $id)
    {
        if (Categories::find($id)->menu_type == "system")
            return redirect()->back()->with('toast.warn', 'Danh mục thuộc hệ thống không thể xoá.');

        $menu = Menu::whereCategoryId($id)->first();

        if ($menu) {
            return redirect()->back()->with('toast.warn', 'Danh mục đang được sử dụng trong menu nên không thể xoá.');
        };

        try {
            \DB::beginTransaction();
            Categories::find($id)->delete();
            CategoryPost::whereCategoryId($id)->delete();
            \DB::commit();
            return redirect()->back()->with('toast.success', 'Đã xoá danh mục');
        } catch (\Throwable $th) {
            //throw $th;
            \DB::rollBack();
            return redirect()->back()->with('toast.error', 'Lỗi xoá danh mục');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
