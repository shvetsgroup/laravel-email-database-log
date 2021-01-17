<?php

namespace Dmcbrn\LaravelEmailDatabaseLog;

use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\Events\MessageSending;

class LaravelEmailDatabaseLogServiceProvider extends ServiceProvider
{

    public function register()
    {
//        $this->app->make('Dmcbrn\LaravelEmailDatabaseLog\EmailLogController');

        $this->app['events']->listen(MessageSending::class, EmailLogger::class);

        $this->loadViewsFrom(__DIR__ . '/../views','email-logger');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/email_log.php', 'email_log'
        );
    }

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([
            __DIR__ . '/../config/email_log.php' => config_path('email_log.php'),
        ]);
    }
}
