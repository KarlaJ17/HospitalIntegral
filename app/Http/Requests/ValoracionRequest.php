<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValoracionRequest extends FormRequest
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
            'doctor_id'=>array(
                'required' 
            ),
            'citas_agendadas'=>array(
                'required', 'date'
            ),
            'puntuacion'=>array(
                'required' 
            ),
            'comentario'=>array(
                'required' 
            ), 
        ];
    }
}
