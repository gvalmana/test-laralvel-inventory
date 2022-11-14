<?php

namespace App\Rules;

use App\Models\Producto;
use Illuminate\Contracts\Validation\Rule;

class VentaValidacion implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $ventas;
    public function __construct($ventas)
    {
       $this->ventas = $ventas;
       $this->productos = [];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        foreach ($this->ventas as $venta) {
            $producto = Producto::find($venta["producto_id"]);
            return ($producto->existencias >= 0 and $venta["cantidad"] <= $producto->existencias);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "La venta de los productos no se puede realizar porque no hay oferta suficiente.";
    }
}
