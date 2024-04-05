<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    //1. vincular la tabla al modelo
    protected $table = "citas";
    
    //2. Definicion de campos a modificar o insertar
    //Preguntar si creamos una tabla puente que contenta el estado de la cita
        protected $fillable = array(
            'paciente_id',
            'horario_id',
            'fecha',
            'agendar',
            'reprogramar',
            'cancelar',
        );
}
