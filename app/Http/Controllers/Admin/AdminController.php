<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Categories;
use App\Models\Posts;
use App\Models\Menu;
use App\Models\SystemDefine;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response ||
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $task = SystemDefine::whereName('task')->first();

            return Inertia::render('Admin/Dashboard/Dashboard', [
                'task'  => $task
            ]);
        }

        if ($request->isMethod('PUT')) {
            $task = SystemDefine::whereName('task')->first();
            $task->values = [
                'content' => $request->content
            ];

            $task->save();
            return redirect()->back()->with('toast.success',  "Đã cập nhật");
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        //
    }


    public function menu()
    {
        $menuModel = new Categories();
        $allPosts = Posts::where('type', 'page')->get();

        $currentMenu = Menu::with(['post', 'category', 'subMenus' => function ($sub) {
            $sub->with(['post', 'category',]);
        }])->whereNull('parent_id')->orderBy('order_number')->get();


        // $istSubCat = Categories::leftJoin('menus as m', 'm.category_id', 'categories.id')->addSelect(['categories.*', 'm.parent_id'])->get();
        $istSubCat = Categories::whereType('category')->get();

        // $istSubMenuPost = Posts::leftJoin('menus as m', 'm.post_id', 'posts.id')->addSelect(['posts.*', 'm.parent_id'])->get();
        $istSubMenuPost = Posts::whereType("page")->get();



        return Inertia::render('Admin/Menu/Menu', [
            'currentMenu' => $currentMenu,
            'allCats'     => Categories::whereType('menu')->get(),
            'listSubMenu'     => [...$istSubCat, ...$istSubMenuPost],
        ]);
    }

    public function createMenu(Request $request)
    {
        $inputs = $request->only([
            'title',
            'slug',
        ]);

        Validator::make($inputs, [
            'title'         => ['required', 'unique:categories,title' ],
            'slug'          => ['required', 'unique:categories,slug' ],
        ],
        [
            'title' => [
                'required'  => "Vui lòng nhập tên menu",
                'unique'    => 'Menu đã tồn tại'
            ],
            'slug' => [
                'required'  => "Vui lòng nhập đường dẫ",
                'unique'    => 'Đường dẫn đã tồn tại'
            ]
        ])->validate();

        if ($request?->id) {
            $updateMenu = Categories::find($request?->id);
            $updateMenu->title = $inputs['title'];
            $updateMenu->slug = $inputs['slug'];

            $updateMenu->save();

            return redirect()->route('system.menu')->with('toast.success', "Đã cập nhật menu");
        }

        $categoryModel = new Categories($inputs);
        $categoryModel->type = 'menu';
        $categoryModel->save();

        return redirect()->route('system.menu')->with('toast.success', "Đã tạo menu");
    }

    public function saveMenu (Request $request)
    {
        try {
            \DB::beginTransaction();
            $ids = $request->listId;
            $listMenu = $request->listCat;
            // Delete all menu not use
            Menu::whereNull('parent_id')->whereNotIn('category_id', $ids)->delete();

            foreach ($listMenu as $m){
                $exist = Menu::whereNull('parent_id')->where('category_id', $m['id'])->exists();
                // If menu is exist
                if ($exist) {
                    $currentMenu = Menu::whereNull('parent_id')->where('category_id', $m['id'])->first();
                    $currentMenu->category_id = $m['id'];
                    $currentMenu->order_number = $m['order_number'];
                    $currentMenu->save();
                    continue;
                }

                $newMenu = new Menu();
                $newMenu->category_id = $m['id'];
                $newMenu->order_number = $m['order_number'];
                $newMenu->save();
            }
            \DB::commit();

            return redirect()->back()->with('toast.success', 'Đã cập nhật');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('toast.error', 'Đã xãy ra lỗi');
        }
    }

    public function saveSubMenu(Request $request)
    {
        try {
            \DB::beginTransaction();
            $categoryId = $request->categoryId;
            $listSubMenu = $request->listSubMenu;
            $listPostSubMenu = $request->listPostSubMenu;
            $listCategorySubMenu = $request->listCategorySubMenu;

            $ids = $request->ids;

            $parentMenu = Menu::whereCategoryId($categoryId)->first();

            Menu::where(function ($post) use($ids, $parentMenu) {
                $post->whereNotIn('post_id', $ids)->whereNull('category_id')->whereParentId($parentMenu->id);
            })->orWhere(function ($category) use($ids, $parentMenu) {
                $category->whereNotIn('category_id', $ids)->whereNull('post_id')->whereParentId($parentMenu->id);
            })->delete();

            foreach($listPostSubMenu as $post) {

                if (Menu::whereParentId($parentMenu->id)->wherePostId($post['id'])->exists()) {
                    $newPostMenu = Menu::whereParentId($parentMenu->id)->wherePostId($post['id'])->first();
                    $newPostMenu->order_number = $post['order_number'];

                    $newPostMenu->save();
                    continue;
                }

                $newPostMenu = new Menu();

                $newPostMenu->post_id = $post['id'];
                $newPostMenu->order_number = $post['order_number'];
                $newPostMenu->parent_id = $parentMenu->id;
                $newPostMenu->save();
            };

            foreach($listCategorySubMenu as $cat) {
                if (Menu::whereParentId($parentMenu->id)->whereCategoryId($cat['id'])->exists()) {
                    $categoryMenu = Menu::whereParentId($parentMenu->id)->whereCategoryId($cat['id'])->first();
                    $categoryMenu->order_number = $cat['order_number'];
                    $categoryMenu->save();
                    continue;
                }

                $categoryMenu = new Menu();

                $categoryMenu->category_id = $cat['id'];
                $categoryMenu->order_number = $cat['order_number'];
                $categoryMenu->parent_id = $parentMenu->id;

                $categoryMenu->save();
            };

            \DB::commit();
            return redirect()->back()->with('toast.success', 'Đã cập nhật');
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e);
            return redirect()->back()->with('toast.error', 'Đã xãy ra lỗi');
        }
    }
}
