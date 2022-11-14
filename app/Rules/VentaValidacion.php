<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VentaValidacion implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $producto;

    public function __construct($producto)
    {

       $this->producto = $producto;
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
        return ($this->producto->existencias > 0 and $value <= $this->producto->existencias);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "La venta de {$this->producto->nombre} no se puede realizar porque no hay oferta suficiente. Hay en existencias {$this->producto->existencias} unidades.";
    }
}
