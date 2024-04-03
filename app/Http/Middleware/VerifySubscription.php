<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifySubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()->subscription || !$this->isValid($request->user()->subscription)) {
            throw new \Exception('Usuario sin suscripción válida.');
        }
    
        return $next($request);
    }

    private function isValid($subscription) {
        //validar que este en vigor....
        return true;
    }
}
