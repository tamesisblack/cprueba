<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class LocalizadorFormRequest extends Request
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
    {    $id = Request::segment(3);
       return [
                        
             'concaneted_segments'=>'unique:inv_item_locator,concaneted_segments,' . $id.' ,location_id',
        ];
    }
}
