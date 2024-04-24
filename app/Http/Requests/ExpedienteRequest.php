<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpedienteRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'perfil_id'=>array(
                'required' 
            ),
            'doc_id'=>array(
                'required' 
            ),
            'receta_id'=>array(
                'required' 
            ),
            'enfermedad'=>array(
                'required' 
            ),
            'ingreso'=>array(
                'required' 
            ),
            'cita'=>array(
                'required', 'date'
            ),
            'examen'=>array(
                'required',  
            ),
            'referencia'=>array(
                'required' 
            ),
        ];
    }
}
