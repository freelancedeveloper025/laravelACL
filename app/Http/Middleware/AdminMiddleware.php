<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminMiddleware
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
        $user = User::all()->count();
        if (!($user == 1)) { // If User registration is 1, then This is by default get administrative right. Before register 2nd one give the user as administrative powe
            if (!Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user does //not have this permission
        	{
                abort('401');
            }
        }

        return $next($request);
    }
}