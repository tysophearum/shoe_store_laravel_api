<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user =  auth('sanctum')->user();
        if ($user->role == 2) {
            $request->merge([
                'user' => $user
            ]);
            return $next($request);
        }
        return response([
            'message' => 'Unauthenticated.'
        ]);
    }
}
