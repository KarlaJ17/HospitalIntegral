<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examenes extends Model
{
    use HasFactory;
    //1. vincular tabla al modelo
    protected $table = "Examenes";

    //2. Definición de campo a modificar o insertar
    protected $fillable = array(
        'id',
        'expediente_id',
        'especialidad_id',
        'nombre_doctor',
        'nombre_paciente',
    );
}
