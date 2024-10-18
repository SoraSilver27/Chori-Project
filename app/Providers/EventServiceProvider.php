<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\MantenimientoPreventivoComponenteEvent;
use App\Listeners\MantenimientoPreventivoComponenteListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */


    protected $listen = [
        MantenimientoPreventivoComponenteEvent::class => [
            MantenimientoPreventivoComponenteListener::class,
        ],
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
