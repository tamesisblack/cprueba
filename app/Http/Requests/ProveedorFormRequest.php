<?php


namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
 

class ProveedorFormRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {   $id = Request::segment(3);

        return [

            'vendor_name'           => 'required|max:50|unique:po_vendor,vendor_name,' . $id.',vendor_id',
            'segment1'              => 'required|max:11|unique:po_vendor,segment1,' . $id.',vendor_id',
           
            //'start_date_active'      => 'required|date',
            'end_date_active'      => 'date',
            //'telef1'               => 'required',           
            //'EMAIL_ADDRESS'        => 'required',

            //'SALARY'               => 'numeric|required|between:100,1000|integer',
            //'SOLD_MIN'             => 'numeric|required|max:500|integer',
            //'DISCCOUNT'            => 'numeric|required|max:100|integer',

            //'end_date_active'   => 'required|date|after:start_date_active',
            //'start_date_active' => 'required|date',

            //'COUNTRY'               => 'max:50|required',/
            'address'              => 'max:80',
            'contacto'              => 'max:50',
        ];
    }
}
