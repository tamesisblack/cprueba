<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class DailyRateFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'from_currency'=>'required|max:15',
			'to_currency'=>'required|max:15',
			'conversion_date' => 'required|date',
            'conversion_rate' => 'required',
            'conversion_type' => 'required'
             
        ];

    }
}
