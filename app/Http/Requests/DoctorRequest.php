<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
             'nombre'=>array(
                 'required' 
              ),
              //falta validacion de correo
             'email'=>array(
                 'required'
             ),
             'password'=>array(
                'required'
             ),
          
            
        ];
    }
}
