<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illumanate\Database\Eloquent\Model;
class Pago extends Model
{
    use HasFactory;
    # I. Vincular la tabla al modelo
    protected $table = "pagos";
    
    # II. Definición de campos a modificar o insertar
    protected $fillable = array(
        'id',
        'factura_id',
        'tipo_pago_id',
    );
}