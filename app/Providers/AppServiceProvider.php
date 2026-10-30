<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Deposit;

class AppServiceProvider extends ServiceProvider
{
    public function register() { }

    public function boot()
    {
        View::composer('layouts.admin', function ($view) {
            $count = Deposit::where('status', 'menunggu')->count();
            $view->with('pendingDepositsCount', $count);
        });
    }
}
