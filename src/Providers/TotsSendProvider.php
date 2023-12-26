<?php

namespace Tots\EmailTSend\Providers;

use Illuminate\Support\ServiceProvider;
use Tots\Email\Services\TotsEmailService;
use Tots\EmailTSend\Services\TotsSendService;
use Illuminate\Support\Facades\Mail;
use Tots\EmailTSend\Transports\TotsSendTransport;

class TotsSendProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TotsEmailService::class, function ($app) {
            return new TotsSendService(config('tots-send'));
        });
    }
    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        Mail::extend('tots_send', function (array $config = []) {
            return new TotsSendTransport(app(TotsEmailService::class));
        });
    }
}
