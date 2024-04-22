<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjetas extends Model
{
    use HasFactory;
    #I.  Vincular la tabla modelo
    protected $fillable = array(
        'id',
        'perf_id',
        'monto_id',
        'tipo_tarjeta',
        'vencimiento',
        'cvv',
    );
}