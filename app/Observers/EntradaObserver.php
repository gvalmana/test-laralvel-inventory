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
        $model = $entrada->producto;
        $model->entrarInventario($entrada->cantidad);
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
        $model = $entrada->producto;
        $model->rebajarInventario($entrada->cantidad);        
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
        $model = $entrada->producto;
        $model->entrarInventario($entrada->cantidad);        
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
