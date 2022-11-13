<?php

namespace App\Providers;

use App\Models\Entrada;
use App\Models\Venta;
use App\Observers\EntradaObserver;
use App\Observers\VentaObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Registrando los observadores de cambios de entradas 
        //para actualizar las existencias de inventario
        Venta::observe(VentaObserver::class);
        Entrada::observe(EntradaObserver::class);
    }
}
