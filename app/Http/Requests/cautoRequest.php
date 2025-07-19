<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class cautoRequest extends Request
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
            'cliente'=>'required',
            'vehiculo'=>'required',
            'cotizacion'=>'required',
            'wip_entity_name'=>'required',
            'scheduled_start_date'=>'required',
            'scheduled_completion_date'=>'required'
        ];
    }
}
