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
        protected $fillable = array(
            'paciente_id',
            'horario_id',
            'fecha',
            'agendadar',
            'reprogramar',
            'cancelar',
        );
}
