<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;
use Carbon\Carbon;

class VisitCounter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $v = Visit::where('date', $today)->whereStatus(Visit::today)->first();

            if ($v) $v->increment('count');
            else {
                $v = new Visit();

                $v->date = $today;
                $v->count = 1;
                $v->status = Visit::today;

                $v->save();
            }

            if (Visit::whereNull('date')->whereStatus(Visit::total)->exists())
                Visit::whereNull('date')->whereStatus(Visit::total)->increment('count');
            else {
                $total = new Visit();
                $total->count = 300000;
                $total->status = Visit::total;
                $total->save();
            }
            return $next($request);
        } catch (\Throwable $th) {
            return $next($request);
        }

    }
}
