<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExistenciaRequest extends FormRequest
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
			'id_producto' => 'required',
			'id_usuario' => 'required',
			'id_sucursal' => 'required',
			'fecha' => 'required',
			'cantidad' => 'required',
			'tipo_Transaccion' => 'required|string',
        ];
    }
}
