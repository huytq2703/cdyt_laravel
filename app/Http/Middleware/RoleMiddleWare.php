<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $roleCode     = $request->user()->role_code;
        $role       = Roles::whereCode($roleCode)->first();
        $userPermissions = $role->permissions;

        if (count($guards) > 0) {
            $isContain = count(array_intersect($userPermissions, $guards)) > 0;
            if ($isContain ) return $next($request);
        }

        return App::abort(404);
    }
}
