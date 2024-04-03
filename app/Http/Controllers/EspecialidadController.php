<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    //Lista de todas las especialidades

    public function index()
    {
        //SELECT *FROM especialidad;
        $especialidad = Especialidad::all();

        //Comprobamos si hay almenos 1 
        if (count($especialidad)<1){
            return response()->json(array(
                'message'=> "No se encontró la especialidad.",
                'data'=> $especialidad,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Listado de especialidades.",
            'data'=> $especialidad,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM especialidades WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $especialidad = nombre_especialidad::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($doctores == NULL){
            return response()->json(array(
                'message'=> "Especialidad no encontrada.",
                'data'=> $nombre_especialidad,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Especialidad encontrada exitosamente.",
            'data'=> $nombre_especialidad,
            'code'=> 200, 
        ),200);

    }
}
