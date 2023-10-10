<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Auth as FacadeAuth;

class OwnerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the currently authenticated user using Laravel's Auth facade.
        $user = FacadeAuth::user();

        // Check if a user is authenticated and their role is 'house owner.'
        if ($user && $user->user_role == 'house owner') {
            // If the user is authenticated and has the 'house owner' role, proceed to the next route.
            return $next($request);
        }

        // If the user is not authenticated redirect them to the login page.
        return redirect(route('login'));
    }
}