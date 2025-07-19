<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;

class WorkOrderFormRequest extends Request
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
       // $wip_entity_id = Request::segment(3);
      //  $td = Carbon::create()->format('Y');

        return [
 //'nombre'=>'required|max:50|unique:modelo,nombre,' . $id.' ,idmodelo',
  //      'wip_entity_name'  =>  'required|max:50|unique:eam_work_orders,wip_entity_name,' . $id,
     //   'placa'                => 'required|unique:vehiculo,placa,'.$id,
        'owner_id'              => 'required',
        'object_id'             => 'required'
                  
                ];
    }
}
