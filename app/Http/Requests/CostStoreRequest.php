<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CostStoreRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'last_updated_by' => auth()->id(),
            'created_by' => auth()->id(),
        ]);

    }

    public function rules(): array
    {
        return [
            'type_vehicule_id' => ['required', 'integer'],
            'person_id' => ['required', 'integer'],
            'cost_speciality' => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }


}
