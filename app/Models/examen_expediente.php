<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenesExpediente extends Model
{
    use HasFactory;

    //1. vincular la tabla al modelo
        protected $table = "examenes_expedientes";//nombre de la tabla en la base de datos
    
    //2. Definicion de campos a modificar o insertar
        protected $fillable = array(
            'expediente_id',  
            'examen_id' ,
            
        );
      
}