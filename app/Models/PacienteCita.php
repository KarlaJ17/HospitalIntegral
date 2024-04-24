<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteCita extends Model
{
    use HasFactory;

    //1. vincular la tabla al modelo
    protected $table = "paciente_cita";
    
    //2. Definicion de campos a modificar o insertar

    protected $fillable = array(
        'cita_id',
        'paciente_id',
        'doctor_id',
    );
   
}
