<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Users
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        foreach ($user->user_role as $role) {
            if (in_array($role->roleID, [3, 4, 5, 6])) {
                return $next($request);
            }
        }
        
        Auth::logout();
        Session::flash('message', 'Unauthorized access, you have been logged out of the site.');
        return redirect('login');
    }
}
