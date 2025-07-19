<?php

namespace sisVentas\Http\Requests;
 
use sisVentas\Http\Requests\Request;

class ReasonCreateRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:general_reasons'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del motivo es requerido',
            'name.max' => 'El nombre del motivo soporta maximo 100 caracteres',
            'name.unique' => 'El nombre del motivo ya existe'
        ];
    }
}
