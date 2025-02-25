<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Habilitar Password Grant
        Passport::enablePasswordGrant();

        // Configurar la duración de los tokens de acceso
        Passport::tokensExpireIn(Carbon::now()->addHours(3)); 

        // Configurar la duración de los refresh tokens
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(3));

    }
}
