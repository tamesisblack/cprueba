<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;

class PantallaFormRequest extends Request
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
            
        'code'           => 'max:25|required',
        'name'          => 'max:50|required',
        'path'      => 'max:100|required'
          

                ];
    }
}