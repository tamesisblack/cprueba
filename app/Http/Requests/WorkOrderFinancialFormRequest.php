<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;
use Illuminate\Routing\Route;
use Carbon\Carbon;

class WorkOrderFinancialFormRequest extends Request
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
         
       
        return [
			'receipt_num'=>'required|max:20|unique:cc_prepayment_ot,receipt_num,',
                ];
    }
}
