<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $email = $request->input('email');
        $phone = $request->input('phone');


        // Proceed if it's not a POST request or doesn't have an emai
        if ($request->isMethod('post') && $email) {
            if (User::where('email', $email)->exists()) {
                return response()->json(['message' => 'Email already exists'], 409);
            }
        }

        if ($request->isMethod('post') && $phone) {
            if (User::where('phone', $phone)->exists()) {
                return response()->json(['message' => 'Phone number already exists, Please use a different number'], 409);
            }
        }
        return $next($request);
    }
}
