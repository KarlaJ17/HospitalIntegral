<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//PREGUNTAR A VICTOR COMO FUNCIONARAN ESTOS 
class PacienteCitaController extends Controller
{
    public function index()
    {
        //SELECT *FROM pacienteCita;
        $pacienteCitas= PacienteCita::all(); //tal cual como el modelo

        //Validando si hay almenos 1 perfil de doctor o mas.
        if (count($pacienteCitas)<1){
            return response()->json(array(
                'message'=> "No se encontraron datos .",
                'data'=> $pacienteCitas, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Datos disponibles.",
            'data'=> $pacienteCitas,
            'code'=> 200, 
        ),200);
    }

    

}