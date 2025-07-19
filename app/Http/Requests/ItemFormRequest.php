<?php


namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;

class ItemFormRequest extends Request
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
    {    $id = Request::segment(3);

    
        return [            
            'codigo'=>'required|unique:inv_item,codigo,'. $id.',inv_item_id'
                     
            //'min_minmax_quantity' => 'required|numeric|between:1,max_minmax_quantity'
        ];

 
    }
}
