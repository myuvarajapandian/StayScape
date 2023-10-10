<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // If no specific guards are provided, set it to [null]
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Check if the user is authenticated for the given guard
            if (Auth::guard($guard)->check()) {
                // If the user is authenticated, get the authenticated user
                $user = Auth::user();

                // Check the user's role
                if ($user->user_role === 'customer') {
                    // If the user role is 'customer', redirect to the '/Customer' route
                    return redirect('/Customer');
                } else {
                    // If the user role is not 'customer', redirect to the '/Owner' route
                    return redirect('/Owner');
                }
            }
        }

        // If the user is not authenticated for any guard, continue with the request
        return $next($request);
    }
}
