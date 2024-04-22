<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\DataBase\extendes\Model;

class RedesSociales extends Mode
{
    use HasFactory;
    #I. Vincular la tabla
    protected $table = "Redes_sociales";

    #II. Definición de campos a modificar
    protected $fillable = array(
        'id',
        'instagram',
        'facebook',
        'WhatsApp',
        'TikTok',
        'X',
        'LinkeInd',
        'SnapChat',
    );
}