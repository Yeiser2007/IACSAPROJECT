<?php

namespace App\Providers;

use Laravel\Fortify\Contracts\LogoutResponse;
use App\Actions\Fortify\LogoutResponse as CustomLogoutResponse;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(LogoutResponse::class, CustomLogoutResponse::class);
    }
}
