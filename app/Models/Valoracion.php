<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    //1. vincular la tabla al modelo
    protected $table = "valoraciones";
    
    //2. Definicion de campos a modificar o insertar
        protected $fillable = array(
            'doctor_id',
            'citas_agendadas',
            'puntuacion',
            'comentario', 
            
       );
}
