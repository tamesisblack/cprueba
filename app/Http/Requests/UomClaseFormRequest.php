<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class UomClaseFormRequest extends Request
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
    {    
        $id = Request::segment(3);
        return [
            'uom_class'=>'required|max:10|unique:inv_uom_classes,uom_class,' . $id.' ,uom_class',
             
        ];
    }
}
