<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilPaciente extends Model
{
    use HasFactory;
    //1. vincular tabla al modelo

    protected $table = "perfil_pacientes";

    //2. Definición de campo a modificar o insertar
    protected $fillable = array(
        'id',
        'paciente_id',
        'dui',
        'genero',
        'nacionalidad',
        'departamento',
        'email',
        'nacimiento',
    );
}
