<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth as FacadeAuth;


class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        $user = FacadeAuth::user();

        if ($user && $user->user_role == 'customer') {
            return $next($request);
        }

        return redirect(route('login'));
    }
}
