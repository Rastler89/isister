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
            //Versión gratuita
            if ($request->is('api/pets') && $request->method() == 'POST') {
                $maxPets = 1;
                if ($user->pets->count() >= $maxPets) {
                    return response()->json(['error'=>'Limite suscripción'],422);
                } else {
                    return $next($request);
                }
            }
        } else {
            print('pago');die();
            //Suscripciones
            if ($request->is('api/pets') && $request->method() == 'POST') {
                // Verificar si la suscripción está activa
                if ($user->subscription->active) {
                    //$maxPets = $user->subscription->max_pets;
                    $maxPets = 1;
                    if ($user->pets->count() >= $maxPets) {
                        return response()->json(['error'=>'Limite suscripción'],422);
                    }
                    return $next($request);
                } else {
                    $maxPets = 1;
                    if ($user->pets->count() >= $maxPets) {
                        return response()->json(['error'=>'Limite suscripción'],422);
                    } else {
                        return $next($request);
                    }
                }
            }
        }

        return $next($request);
    }
}
