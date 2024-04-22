<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    //1. Vinculando a la tabla al modelo
    protected $table ="Factura";
    //2. Definición de campoa modificar o insertar
    protected $fillable = array(
        'id',
        'perfil_paciente_id',
        'forma_de_pago_id',
        'monto',
    );

}
?>