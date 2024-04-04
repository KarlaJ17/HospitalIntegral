<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoPaciente extends Model
{
    use HasFactory;
    //1. vincular tabla al modelo
    protected $table = "PerfilPacientes";

    //2. Definición de campo a modificar o insertar
    protected $fillable = array(
        'dui',
        'genero',
        'nacionalidad',
        'departamento',
        'email',
        'nacimiento',
    );
}
