<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = Auth::user()->roles()->get();

        foreach ($roles as $role) {
            if ($role->name !== 'admin') {
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}
