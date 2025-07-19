<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class VehiculoSatFormRequest extends Request
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
    //'EMPLOYEE_NUMBER'      => 'required|unique:HR_PER_PEOPLE_inf,EMPLOYEE_NUMBER,' . $id.' ,PERSON_ID',
    
    public function rules()
    {   //$id = Request::segment(3);
        return [
            //1'plate'=>'max:50|unique:vehiculo_api_sat,plate' . $id.' ,id',
            'plate'=>'unique:vehiculo_api_sat'             
        ];
    }
}
