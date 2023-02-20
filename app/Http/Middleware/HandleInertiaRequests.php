<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use App\Models\Menu;
use App\Models\SystemDefine;
use App\Models\Categories;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $catModel = Menu::with(['post', 'category', 'subMenus' => function ($sub) {
            $sub->with(['post', 'category']);
        }])->whereNull('parent_id')->get();

        // $webMenu = SystemDefine::where('name', 'menu')->first()?->values;
        $menu = config("menu.admin.{$request->user()?->role_code}") ?? [];
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'toast' => session('toast'),
            'menu' => $menu,
            // 'webMenu' => $webMenu,
            'webMenu2' => $catModel
        ]);
    }
}
