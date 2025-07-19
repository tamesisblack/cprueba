<?php


namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request; 

class ClienteFormRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'first_name'           => 'max:25|required',
            
            'num_documento'      => 'max:25',
            //'second_name'          => 'max:50|required',
            //'first_last_name'      => 'max:50|required',
           //'second_last_name'     => 'max:50|required',
           // 'SEX'                  => 'required',           
           // 'DATE_OF_BIRTH'        => 'required|date',
            //  'telef1'               => 'required',
           // 'TELEF2'               => 'required',
            //'EMAIL_ADDRESS'        => 'required',

            //'SALARY'               => 'numeric|required|between:100,1000|integer',
            //'SOLD_MIN'             => 'numeric|required|max:500|integer',
           // 'disccount'            => 'numeric|required|max:100|integer',
 
            //'COUNTRY'               => 'max:50|required',
            //'ADDRESS'              => 'max:50|required',

        ];
    }
}
