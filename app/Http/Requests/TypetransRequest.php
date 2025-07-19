<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;

class TypetransRequest extends Request
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

            'name'                => 'required|unique: inv_transaction_types,name,'.$id,
           
        ];
    }
}
