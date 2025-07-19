<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ConversionTypeFormRequest extends Request
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
            'conversion_type'=>'required|max:30|unique:gl_daily_conversion_types,conversion_type,' . $id.' ,rowid',
             
        ];

    }
}
