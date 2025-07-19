<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;

class ItemMMAFormRequest extends Request
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

            'item_id'                => 'required',
            'idmarca'              => 'required',
            'idmodelo'             => 'required',
            'aniodesde'                  => 'required|integer|max:'.$td,
            'aniohasta'                => 'required'             
            'cant_sugerida'                => 'required'
        ];
    }
}
