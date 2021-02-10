<?php

namespace App\Services\Honeypot;

use App\Services\Honeypot\View\Components\Honeypot as HoneypotComponent;
use Illuminate\Support\ServiceProvider;

class HoneypotServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Include Custom Config files into its own config.
        $this->mergeConfigFrom(__DIR__.'/config/honeypot.php', 'honeypot');
    }

    public function boot()
    {
        \Blade::component('honeypot', HoneypotComponent::class);
    }
}
