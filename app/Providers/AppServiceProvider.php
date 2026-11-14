<?php

namespace App\Providers;

use App\Models\Deposit;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;

class AppServiceProvider extends ServiceProvider
{
    public function register() { }

    public function boot(): void
    {
        View::composer('layouts.admin', function ($view) {
            $count = Deposit::where('status', 'menunggu')->count();
            $view->with('pendingDepositsCount', $count);
        });

        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        Mail::extend('brevo', function () {
            return (new BrevoTransportFactory)->create(
                new Dsn('brevo+api', 'default', config('services.brevo.key'))
            );
        });
    }
}
