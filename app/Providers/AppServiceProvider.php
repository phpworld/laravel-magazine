<?php

namespace App\Providers;

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
        // Share logo and site name with all views
        view()->composer('*', function ($view) {
            $logo = \App\Models\Option::where('key', 'logo')->first()?->value;
            $siteName = \App\Models\Option::where('key', 'site_name')->first()?->value ?? config('app.name');
            
            $view->with([
                'globalLogo' => $logo,
                'globalSiteName' => $siteName
            ]);
        });
    }
}
