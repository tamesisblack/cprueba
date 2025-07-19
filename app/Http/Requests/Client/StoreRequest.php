<?php

namespace sisVentas\Http\Requests\Client;

use sisVentas\Http\Requests\Request;

class StoreRequest extends Request
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
            //'first_name' => ['required', 'string'],
            //'second_name' => ['required', 'string'],
            //'first_last_name' => ['required', 'string'],
            //'second_last_name' => ['required', 'string'],
           // 'full_name' => ['required', 'string'],
           // 'sex' => ['nullable'],
            'tipo_documento' => ['required'],
            'num_documento' => ['required', 'unique:cliente,num_documento,NULL,idcliente,tipo_documento,' . $this->tipo_documento],
            //'telef1' => ['required', 'string'],
            //'no_atender' => ['required'],
            'address' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'num_documento.unique' => 'La combinación de tipo de documento y número de documento ya está en uso'
        ];
    }
}
