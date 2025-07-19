<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;

class CWLaborTipoVehiculoFormRequest extends Request
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
            'name'                 => 'required|unique:cw_labor,name,'.$id,
            'duration'              => 'numeric',
            'tipoveh'               => 'required|numeric',
            'price'                => 'required|numeric'            
            //'idcliente'            => 'required's,
        ];
    }
}
