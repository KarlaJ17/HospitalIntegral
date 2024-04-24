<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illumanate\Database\Eloquent\Model;
class RecordCitas extends Model
{
    use HasFactory;
    # I. Vincular la tabla al modelo
    protected $table = "record_citas";
    
    # II. Definición de campos a modificar o insertar
    protected $fillable = array(
        'id',
        'expediente_id',
        'especilidad_id',
        'citas_pasadas',
    );
}