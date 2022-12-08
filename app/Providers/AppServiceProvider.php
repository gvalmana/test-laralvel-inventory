<?php

namespace App\Providers;

use App\Cache\UserCache;
use App\Contracts\UserRepositoryInterface;
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
        return $this->app->bind(UserRepositoryInterface::class, UserCache::class);
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
