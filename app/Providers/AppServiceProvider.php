<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::useCustomerModel(User::class);

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });

        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Geography')
                    ->icon('heroicon-s-globe-europe-africa')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Data')
                    ->icon('heroicon-s-pencil')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Types')
                    ->collapsed(),
            ]);
        });
    }
}
