<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;
    //1. vincular tabla al modelo
    protected $table = "pacientes";

    //2. Definición de campo a modificar o insertar
    protected $fillable = array(
        'nombre_completo',
        'email',
        'telefono',
        'password',
    );


}
