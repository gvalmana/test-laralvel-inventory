<?php

namespace App\Observers;

use App\Models\Entrada;

class EntradaObserver
{
    /**
     * Handle the Entrada "created" event.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return void
     */
    public function created(Entrada $entrada)
    {
        $entrada->producto()->entrarInventario($entrada->cantidad);
    }

    /**
     * Handle the Entrada "updated" event.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return void
     */
    public function updated(Entrada $entrada)
    {
        //
    }

    /**
     * Handle the Entrada "deleted" event.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return void
     */
    public function deleted(Entrada $entrada)
    {
        //
    }

    /**
     * Handle the Entrada "restored" event.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return void
     */
    public function restored(Entrada $entrada)
    {
        //
    }

    /**
     * Handle the Entrada "force deleted" event.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return void
     */
    public function forceDeleted(Entrada $entrada)
    {
        //
    }
}
