<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;

class VehiculoFormRequest extends Request
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
        $td = Carbon::create()->format('Y');

        return [

            'placa'                => 'required|unique:vehiculo,placa,'.$id,
            'idmarca'              => 'required',
            //'idmodelo'             => 'required',
            //'año'                  => 'required|integer|max:'.$td,
            //'color'                => 'required',
 //'num_motor' => 'required|alpha_num|unique:vehiculo,num_motor,'.$id,
            //'km'                   => 'required|numeric',
            'proxima_visita'       => 'date'
            //'idcliente'            => 'required',
        ];
    }
}
