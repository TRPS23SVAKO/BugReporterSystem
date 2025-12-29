<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $settings = cache()->remember(
                'settings.all',
                now()->addHours(6),
                fn () => Setting::query()->pluck('value', 'key')
            );

            $view->with('settings', $settings);
        });
    }
}
