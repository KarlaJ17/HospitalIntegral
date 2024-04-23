<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    
    //1. vincular la tabla al modelo
    protected $table = "expediente";
    
    //2. Definicion de campos a modificar o insertar

    protected $fillable = array(
        'perfil_id',
        'doc_id',
        'receta_id',
        'enfermedad',
        'ingreso',
        'cita',
        'examen',
        'referencia',
    );
   
}

