<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilDoctor extends Model
{
    use HasFactory;
    

    //1. vincular la tabla al modelo
        protected $table = "perfil_doctores";
    
    //2. Definicion de campos a modificar o insertar
        protected $fillable = array(
            'doc_id',
            'nombre',
            'especialidad',
            'experiencia',
            'ubicacion',
            'numero_contacto',
            'fecha_nacimiento',
            'instagram',
            'whatsapp',
            'facebook',
        );
}
