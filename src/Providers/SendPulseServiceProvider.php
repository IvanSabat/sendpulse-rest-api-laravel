<?php

namespace IvanSabat\SendPulse\Providers;

use Illuminate\Support\ServiceProvider;
use IvanSabat\SendPulse\Sendpulse;

class SendPulseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('sendpulse', function ($app) {
            return new Sendpulse(
                config('sendpulse.api_user_id'),
                config('sendpulse.api_secret')
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/sendpulse.php' => config_path('sendpulse.php'),
        ]);
    }
}
