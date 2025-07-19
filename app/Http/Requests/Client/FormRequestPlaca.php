<?php

namespace sisVentas\Http\Requests\Client;

use sisVentas\Http\Requests\Request;

class FormRequestPlaca extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'placa' => ['required', 'unique:vehiculo,placa'],
            
        ];
    }

    public function messages()
    {
        return [
            'placa.unique' => 'La placa ya se encuentra registrada'
        ];
    }
}
