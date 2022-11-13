<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'nombre' => 'string|required|max:255|unique:productos,nombre,'.$this->id.',id',
            'serie' => 'numeric|required|digits_between:15,15|unique:productos,serie,'.$this->id.',id',
            'precio_compra' =>  'numeric|required',
            'precio_venta' => 'numeric|required'         
        ];
    }
}
