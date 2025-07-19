<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ModeloFormRequest extends Request
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
    {    $id = Request::segment(3);
       return [
            'idmarca'=>'required',             
             'nombre'=>'required|max:50|unique:modelo,nombre,' . $id.' ,idmodelo',
        ];
    }
}
