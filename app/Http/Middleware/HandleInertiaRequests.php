<?php

namespace App\Http\Middleware;

use App\Models\Setting;
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
        $setting = new Setting();

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
            'webMenu2' => $catModel,
            'address'   => $setting->valueByKey('address'),
            'phone_number'   => $setting->valueByKey('phone_number'),
            'email'   => $setting->valueByKey('email'),
            'url'   => $setting->valueByKey('url'),
            'toaster'   => $setting->valueByKey('toaster'),
        ]);
    }
}
