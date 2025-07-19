<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class FndLookupFormRequest extends Request
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
  
			'lookup_type'                => 'required|unique:fnd_lookup,lookup_type,'.$id,
            'description'=>'required|max:100',
            'customization_level'=>'required|max:1',
            'active'=>'required|max:1',

        ];
    }
}
