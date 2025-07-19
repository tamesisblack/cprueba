<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;

class TaxCodeRequest extends Request
{

    public function __construct(Route $route)
    {
        $this->route = $route;
    }  
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $id = Request::segment(3);
       

        return [

            'code_tax'                => 'required|unique:ap_tax_codes_all,code_tax,'.$id,
            'name'              => 'required'
             
        ];
    }
}
