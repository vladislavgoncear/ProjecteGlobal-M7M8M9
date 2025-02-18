<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register authorization policies



        // Define gates
        $this->defineGates();
    }

    /**
     * Define gates for the application.
     *
     * @return void
     */
    protected function defineGates()
    {
        Gate::define('manage-videos', function ($user) {
            return $user->hasRole('Video Manager') || $user->isSuperAdmin();
        });

        Gate::define('access-admin', function ($user) {
            return $user->isSuperAdmin();
        });
    }
}
