<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    //1. vincular la tabla al modelo
    protected $table = "doctores";
    
    //2. Definicion de campos a modificar o insertar
        protected $fillable = array(
            'especialidad_id',
            'nombre',
            'email',
            'password',
            
        );
}
