<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    use Authenticatable;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
//        Auth::guard('admin')->attempt([
//            'username' => 'admin1',
//            'password' => 'hellouniverse1!',
//        ], true);
//        dd(auth()->user());

//        dd(Auth::guard('admin'));
//        if (!Auth::check()) {
//            return redirect()->route('login' , ['error'=>'middle_error']);
//        }
        return $next($request);
    }
}
