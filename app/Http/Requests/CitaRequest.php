<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitaRequest extends FormRequest
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
             //Nombres segun request de controller metodo store siempre

             'paciente_id'=>array(
                'required' 
             ),
             'horario_id'=>array(
                 'required', 'date'
              ),
             'fecha'=>array(
                 'required','date'
             ),
             'agendar'=>array(
                'required', 'date'
             ),
             'reprogramar'=>array(
                'required','date'
            ),
            'cancelar'=>array(
               'required'
            ),
//PREGUNTA exisitencial al cancelar pondran la fecha o solo la seleccionaran

            
        ];
    }
}
