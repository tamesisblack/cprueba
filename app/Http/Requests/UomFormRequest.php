<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class UomFormRequest extends Request
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
    {   $id = Request::segment(3);

        return [
             
            'uom_code'=>'required|max:15|unique:inv_unitofmeasure,uom_code',
             'description'=>'max:50',
        ];
    }
}
