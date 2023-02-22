<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Posts;
use App\Models\Categories;

class HomeController extends Controller
{
    const v_NotifyDetails       = 'notify.details';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) : Response
    {
        // Define categories slugs for home page
        $hoatDongChuyenMonSlug      = 'hoat-dong-chuyen-mon';
        $hoatDongThiVaTuyenSinhSlug = 'hoat-dong-thi-va-tuyen-sinh';
        $hoatDongDoanThanhNienSlug  = 'hoat-dong-doan-thanh-nien';

        $hoatDongChuyenMon      = $this->_getPostsByCategorySlug($hoatDongChuyenMonSlug, 3);
        $hoatDongThiVaTuyenSinh = $this->_getPostsByCategorySlug($hoatDongThiVaTuyenSinhSlug, 3);
        $hoatDongDoanThanhNien  = $this->_getPostsByCategorySlug($hoatDongDoanThanhNienSlug, 3);
// dd($hoatDongDoanThanhNien->toArray());
        $postHeaderSlider = Posts::with('categories')->whereType('post')->wherePublished(Posts::status_published)->whereHas('categories')->latest('created_at')->get();

        $notifications = Posts::whereType('notice')->wherePublished(Posts::status_published)->latest('created_at')->get();

        return Inertia::render('Home/Home', [
            'postsTab1' =>  $hoatDongChuyenMon,
            'postsTab2' =>  $hoatDongThiVaTuyenSinh,
            'postsTab3' =>  $hoatDongDoanThanhNien,
            'postHeaderSlider' => $postHeaderSlider,
            'notifications' => $notifications,
            'v_NotifyDetails'   => self::v_NotifyDetails
        ]);
    }

    public function _getPostsByCategorySlug (String $slug, Int $limit)
    {
        return Categories::where('slug', $slug)->with([
            'posts' => function ($post) use($limit) {
                $post->wherePublished(Posts::status_published)->latest('posts.created_at')->take($limit);
            }
        ])->first();
    }

    public function post (String $parent_slug, String $post_slug = null )
    {
        $highlightSlug = 'tin-tuc-noi-bat';
        $post = Posts::where('slug', $parent_slug)->wherePublished(Posts::status_published)->first();

        if ($post_slug) {
            return Inertia::render('Posts/PostDetails', [
                'post'  => Posts::whereSlug($post_slug)->wherePublished(Posts::status_published)->latest('created_at')->first(),
                'category' => Categories::whereSlug($parent_slug)->first(),
                'highlightPosts' => Categories::whereSlug($highlightSlug)->with('posts', function ($posts) {
                    $posts->wherePublished(Posts::status_published)->latest('posts.created_at');
                })->first(),
            ]);
        }

        // Nếu là bài viết hoặc trang web
        if ($type = $post?->type) {
            switch ($type) {
                case 'post':
                    return Inertia::render('Posts/PostDetails', [
                        'post'  => $post
                    ]);
                case 'page':
                    $menuId = Menu::select(['parent_id'])->wherePostId($post->id)->first();
                    $category = Posts::join('menus as m', 'm.post_id', 'posts.id')
                    ->where('m.parent_id', $menuId->parent_id)->get();

                    return Inertia::render('Posts/PostDetails', [
                        'post'  => $post,
                        'category' => $category,
                    ]);
                case 'notice':
                    return Inertia::render('Posts/PostDetails', [
                        'post'  => $post,
                        'noticeList' => Posts::whereType('notice')->wherePublished(Posts::status_published)->latest('created_at')->get(),
                    ]);
            }
        }

        $categoryModel  = Categories::with(['posts' => function ($posts) {
            $posts->wherePublished(Posts::status_published)->latest('posts.created_at');
        }, 'childs'])->whereSlug($parent_slug)->first();
        // Nếu là danh mục

        if ($categoryModel?->slug === 'thong-bao') {
            return Inertia::render('Posts/Notifications', [
                'notifications'  => Posts::whereType('notice')->wherePublished(Posts::status_published)->latest('created_at')->get(),
                'highlightPosts' => Categories::whereSlug($highlightSlug)->with('posts', function ($posts) {
                    $posts->wherePublished(Posts::status_published)->latest('posts.created_at');
                })->first(),
            ]);
        }

        if ($categoryModel) {
            return Inertia::render('Posts/Category', [
                'category'  => $categoryModel,
                'highlightPosts' => Categories::whereSlug($highlightSlug)->with('posts', function ($posts) {
                    $posts->wherePublished(Posts::status_published)->latest('posts.created_at');
                })->first(),
            ]);
        }
        return redirect()->back()->with('toast.warn', "Không tìm thấy trang");
    }
}
