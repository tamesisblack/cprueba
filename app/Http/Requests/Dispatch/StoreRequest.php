<?php

namespace sisVentas\Http\Requests\Dispatch;

use sisVentas\Http\Requests\Request;
use sisVentas\Personal;

class StoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Initializes comments and quantities
        $arr_comments = [];
        $arr_dispatches = [];
        $arr_lines = [];

        // Get comments
        $comments = $this->comentario_linea;

        // Get dispatch quantities
        $dispatches = $this->cant_despacho;

        // Get lines
        $lines = $this->line_id;

        // Get keys
        $keys = $this->arr_keys;

        // Delete comment from request
        $this->merge([
            'comentario_linea' => null
        ]);

        // Delete quantities from request
        $this->merge([
            'cant_despacho' => null
        ]);

        // Delete lines from request
        $this->merge([
            'line_id' => null
        ]);

        // Save only comment with values
        foreach ($comments as $key => $value) {
            if (strlen($value) > 0) {
                $arr_comments[$keys[$key]] = $value;
            }
        }

        // Save only quantities with values
        foreach ($dispatches as $key => $value) {
            if (strlen($value) > 0) {
                $arr_dispatches[$keys[$key]] = (float) $value;
            }
        }

        // Save only quantities with values
        foreach ($lines as $key => $value) {
            if (strlen($value) > 0) {
                $arr_lines[$keys[$key]] = (float) $value;
            }
        }

        $this->merge([
            'comentario_linea' => $arr_comments
        ]);
        $this->merge([
            'cant_despacho' => $arr_dispatches
        ]);
        $this->merge([
            'line_id' => $arr_lines
        ]);


        return [
            'entregado_a' => ['required', 'in:' . implode(',', Personal::all()->pluck('PERSON_ID')->toArray())],
            'comentario' => ['required', 'string'],
            'cant_despacho' => ['required'],
            'cant_despacho.*' => ['required', 'numeric', 'min:0'],
            'comentario_linea' => ['required'],
            'comentario_linea.*' => ['required', 'string'],
            'fila_seleccionada' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'cant_despacho.*.required' => 'Debe de ingresar la cantidad en esta fila',
            'cant_despacho.*.numeric' => 'Esta cantidad debe de ser un número',
            'cant_despacho.*.min' => 'Esta cantidad debe de ser mayor que cero (0)',
            'comentario_linea.*.required' => 'Debe de ingresar un comentario en esta fila',
            'comentario_linea.*.numeric' => 'Este comentario debe de ser un texto',
        ];
    }
}
