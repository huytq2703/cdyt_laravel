<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use App\Models\Menu;
use App\Models\Roles;
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

        $menu = $this->getMenu($request->user());

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

    public function getMenu($user)
    {
        if (!$user?->role_code) return [];

        $role_code = $user->role_code;

        $roleModel = Roles::whereCode($role_code)->first();
        $allPermissions = $roleModel?->permissions;
        if (!$allPermissions) return [];
        $menus = config("menu.admin.SUPER_ADMIN") ?? [];

        $result = [];

        foreach($menus as $key => $menu) {
            if (isset($menu['child'])) {
                $subMenus = $menu['child'];

                $menu['child'] = array_filter($subMenus, function ($sub) use($allPermissions) {
                    if (isset($sub['role'])) {
                        // dd(gettype($sub['role']));
                        if (gettype($sub['role']) == "array" && count($sub['role']) > 1)
                        return count(array_intersect($sub['role'], $allPermissions)) > 0;
                        return in_array($sub['role'], $allPermissions);
                    }
                    return false;
                });
            }

            $result[] = $menu;
        };

        return $result;
    }
}
