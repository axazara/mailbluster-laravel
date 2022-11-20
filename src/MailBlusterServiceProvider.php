<?php

namespace AxaZara\MailBluster;

use Illuminate\Support\ServiceProvider;

class MailBlusterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('mailbluster', function () {
            return new MailBluster();
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
            ]);
            $this->publishes([
                __DIR__.'/../config/mailbluster-laravel.php' => config_path('mailbluster.php'),
            ], 'config');
        }
    }
}
