<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class HorarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Tiene que estar en true
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

            'doctor_id'=>array(
                'required' 
             ),
             'perfil_id'=>array(
                 'required' 
              ),
             'nombre'=>array(
                 'required',
             ),
             'fecha'=>array(
                'required', 'date'
             ),
             'hora'=>array(
                'required','date'
            ),
            'estado'=>array(
               'required', 
            ),

        ];
    }
}
