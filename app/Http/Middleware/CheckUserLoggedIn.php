<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Response;

// class CheckUserLoggedIn
// {
//     /**
//      * Handle an incoming request.
//      */
//     public function handle(Request $request, Closure $next): Response
//     {
//         // Condition: if the user not connected
//         if (!Auth::check()) {
//             return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
//         }
//         // sinon pass
//         return $next($request);
//     }
// }




namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        // Check token (API)
        if (!Auth::guard('sanctum')->check() && !Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Non authentifié.'], 401);
            }
            return redirect()->route('login')
                ->with('error', 'Veuillez vous connecter.');
        }

        return $next($request);
    }
}