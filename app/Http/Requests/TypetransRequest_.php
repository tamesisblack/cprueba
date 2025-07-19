<?php

namespace sisVentas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypetransRequest extends FormRequest
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
            'name' => 'required|max:50|unique:inv_transaction_types,name,'.$this->request->get('id').',id',
            //'name' => 'required|max:50|unique:inv_transaction_types',
            'code' => 'required|max:50'
            
        ];
    }

     public function messages()
        {
            return [
                'name.required' => 'El nombre del tipo de transacción es requerido',
                'code.required' => 'El código es requerido',
                'name.unique' => 'Ya existe el nombre, ingrese otro'
                
            ];
        }
}
