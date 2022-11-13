<?php

namespace App\Observers;

use App\Models\Venta;

class VentaObserver
{
    /**
     * Handle the Venta "created" event.
     *
     * @param  \App\Models\Venta  $venta
     * @return void
     */
    public function created(Venta $venta)
    {
        //
        $model = $venta->producto;
        $model->rebajarInventario($venta->cantidad);
    }

    /**
     * Handle the Venta "updated" event.
     *
     * @param  \App\Models\Venta  $venta
     * @return void
     */
    public function updated(Venta $venta)
    {
        //
    }

    /**
     * Handle the Venta "deleted" event.
     *
     * @param  \App\Models\Venta  $venta
     * @return void
     */
    public function deleted(Venta $venta)
    {
        //
    }

    /**
     * Handle the Venta "restored" event.
     *
     * @param  \App\Models\Venta  $venta
     * @return void
     */
    public function restored(Venta $venta)
    {
        //
    }

    /**
     * Handle the Venta "force deleted" event.
     *
     * @param  \App\Models\Venta  $venta
     * @return void
     */
    public function forceDeleted(Venta $venta)
    {
        //
    }
}
