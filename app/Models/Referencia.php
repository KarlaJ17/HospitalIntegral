<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

      
    //1. vincular la tabla al modelo
    protected $table = "referencias";
    
    //2. Definicion de campos a modificar o insertar

    protected $fillable = array(
        'expediente_id',
        'especialidad_id',
        'diagnostico',
    );
   
}
