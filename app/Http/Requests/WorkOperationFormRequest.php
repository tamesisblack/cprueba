<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;

class WorkOperationFormRequest extends Request
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
	 
                ];
    }
}
