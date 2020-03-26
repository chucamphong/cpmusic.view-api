<?php

namespace App\Http\Middleware;

use Closure;

class CheckAbility
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $ability
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next, string $ability)
    {
        if (\Auth::check() && \Auth::user()->tokenCan($ability)) {
            return $next($request);
        }

        throw new \Exception('Bạn không có quyền truy cập.');
    }
}
