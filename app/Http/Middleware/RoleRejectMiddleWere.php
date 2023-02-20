<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class RoleRejectMiddleWere
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
        $userId     = $request->user()->id;
        $user       = User::find($userId);
        $roleCode   = $user->role_code;

        if (count($guards) > 0) {
            if (in_array($roleCode, $guards))
            return redirect()->back()->with('toast.warn', 'Không có quyền truy cập');
        }

        return $next($request);
    }
}
