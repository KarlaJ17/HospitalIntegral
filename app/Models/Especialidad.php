<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    //1. vincular la tabla al modelo
        protected $table = "especialidad";
    
    //2. Definicion de campos a modificar o insertar
        protected $fillable = array(
            'nombre_especialidad',
            
        );
      
}

