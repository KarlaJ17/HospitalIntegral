<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilDoctorRequest extends FormRequest
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


            'doc_id'=>array(
                'required' 
            ),
            'redes_sociales_id'=>array(
                'required' 
            ),
            'nombre'=>array(
                'required' 
            ),
            'especialidad'=>array(
                'required' 
            ),
            'experience'=>array(
                'required' 
            ),
            'ubicacion'=>array(
                'required' 
            ),
            'numero_contacto'=>array(
                'required' 
            ),
            'fecha_nacimiento'=>array(
                'required' 
            ),
        ];
    }
}
