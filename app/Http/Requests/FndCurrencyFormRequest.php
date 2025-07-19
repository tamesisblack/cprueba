<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class FndCurrencyFormRequest extends Request
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
        return [
            'currency_code'=>'required|max:15',
             'descripcion'=>'required|max:50',
            'simbolo'=>'required|max:15'
        ];
    }
}
