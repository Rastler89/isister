<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if(!$user) {
            return $next($request);
        }

        if(!$user->subscription) {
            $maxPets = 1;
            if ($user->pets->count() >= $maxPets) {
                return response()->json(['error'=>'Limite suscripción'],422);
            }
        } else {
            
        }
    }
}
