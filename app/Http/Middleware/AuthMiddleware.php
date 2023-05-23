<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the Authorization header is set
        if ($request->hasHeader('Authorization')) {
            // Get the token from the header
            $token = str_replace('Bearer ', '', $request->header('Authorization'));

            $user = User::where('remember_token', $token)->get()->first();

            if($user) {
                Auth::setUser($user);
                return $next($request);
            }
            else return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }
}
