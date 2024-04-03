<?php

namespace App\Http\Controllers;

//Importando modelos siempre la primera letra mayuscula
use App\Models\Especialidad;

use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    //Lista de todas las especialidades

    public function index()
    {
        //SELECT *FROM especialidad;
        $especialidades = Especialidad::all();//Nombre del modelo

        //Comprobamos si hay almenos 1 
        if (count($especialidades)<1){
            return response()->json(array(
                'message'=> "No se encontró la especialidad.",
                'data'=> $especialidades,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Listado de especialidades.",
            'data'=> $especialidades,
            'code'=> 200, 
        ),200);
    }

    //Mostrar una especialidad

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM especialidades WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $especialidad = especialidad::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($especialidad == NULL){
            return response()->json(array(
                'message'=> "Especialidad no encontrada.",
                'data'=> $especialidad,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Especialidad encontrada exitosamente.",
            'data'=> $especialidad,
            'code'=> 200, 
        ),200);

    }
}
