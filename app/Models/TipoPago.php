<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;
    # I. Vincular la tabla al modelo
    protected $table = "TablaPago";
    # II Definición de campos a modificar o insertar
    protected $fillable = array(
        'id',
        'tarjeta_id',
        'efectivo',
        'seguro',
        'cheque',
        'chivoWallet',
    );
}