<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class StoreAsignacionItemsRequest extends Request
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
            'site' => 'required|exists:inv_sites,id',
            'item.*' => 'required|exists:inv_item,inv_item_id'
        ];
    }
}
