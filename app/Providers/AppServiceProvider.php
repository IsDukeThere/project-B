<?php

namespace App\Providers;

use App\Models\Deposit;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register() { }

    public function boot()
    {
        View::composer('layouts.admin', function ($view) {
            $count = Deposit::where('status', 'menunggu')->count();
            $view->with('pendingDepositsCount', $count);
        });

        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
