<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_talla' => 'required',
            'id_colores' => 'required',
            'id_modelo' => 'required',
            'nombre' => 'required|string',
            'precio_estimado' => 'required|numeric',  // Asegúrate de que sea un valor numérico
            'precio_vendedor' => 'required|numeric',  // Asegúrate de que sea un valor numérico
            'cantidad' => 'required|integer|min:1',  // Asegúrate de que sea un valor entero y mínimo 1
            'descripcion' => 'required|string',
            'tipo' => 'required|in:cotizacion,venta,pedido',
        ];
    }
}
