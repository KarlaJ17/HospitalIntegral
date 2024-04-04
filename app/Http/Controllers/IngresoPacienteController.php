<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IngresoPaciente; //Llamar al modelo

class IngresoPacienteController extends Controller{


    public function index(){
        // SELECT * FROM paciente_id;
        $pacientes = IngresoPacientes::all(); //Tal cual cómo lo indica el módelo
        
        //Validando si hay al menos un perfil en la base de datos
        if (count($pacientes)<1){
            return response()->json(array(
                'message'=> "No se encontró perfiles de pacientes registrados.",
                'data'=> $perfil_pacientes, //Extraer información
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Perfiles de pacientes registrados",
            'data'=> $perfil_pacientes,
            'code'=> 200, 
        ),200);
    

    }
}
