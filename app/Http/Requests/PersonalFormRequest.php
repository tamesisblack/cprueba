<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;

class PersonalFormRequest extends Request
{

    public function __construct(Route $route)
    {
        $this->route = $route;
    }    

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
        $id = Request::segment(3);

        return [
            
        'FIRST_NAME'           => 'max:50|required',
        'SECOND_NAME'          => 'max:50|required',
        'first_LAST_NAME'      => 'max:50|required',
        'SECOND_LAST_NAME'     => 'max:50|required',
        'SEX'                  => 'required',
        
    'EMPLOYEE_NUMBER'      => 'required|unique:hr_per_people_inf,EMPLOYEE_NUMBER,' . $id.',PERSON_ID',

//'EMAIL_ADDRESS'        => 'required|unique:hr_per_people_inf,EMAIL_ADDRESS,'. $id.',PERSON_ID',

//'EMPLOYEE_NUMBER'      => 'required|unique:hr_per_people_inf,EMPLOYEE_NUMBER,' . $id,
//'EMAIL_ADDRESS'        => 'required|unique:hr_per_people_inf,EMAIL_ADDRESS,'. $id,
        //'DATE_OF_BIRTH'        => 'required|date',
        //'TELEF1'               => 'required',
        //'TELEF2'               => 'required',
        
        //'SALARY'               => 'numeric|required|between:100,1000|integer',
        //'SOLD_MIN'             => 'numeric|required|max:500|integer',
       // 'DISCCOUNT'            => 'numeric|required|max:100|integer',
       // 'EFFECTIVE_END_DATE'   => 'required|date|after:EFFECTIVE_START_DATE',
        //'EFFECTIVE_START_DATE' => 'required|date',
        //'COUNTRY'              => 'max:50',
        //'ADDRESS'              => 'max:50',

                ];
    }
}