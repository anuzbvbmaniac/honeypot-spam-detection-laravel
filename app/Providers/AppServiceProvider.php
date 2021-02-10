<?php

namespace App\Providers;

use App\Honeypot\Honeypot;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
        Honeypot::abortUsing(function () {
            abort(404, 'Bad Request');
        });
    }
}
