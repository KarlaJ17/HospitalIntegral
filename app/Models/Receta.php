<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    //1. vincular tabla al modelo

    protected $table = "recetas";

    //2. Definición de campo a modificar o insertar
    protected $fillable = array(
        'expediente_id',
        'especialidad_id',
        'medicamento',
        'dosis',
        'tiempo',
    );
}
