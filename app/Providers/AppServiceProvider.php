<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
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
