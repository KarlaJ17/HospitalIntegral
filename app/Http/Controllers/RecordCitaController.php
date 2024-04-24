<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RecordCita; //llamar al modelo

class ExpedienteController extends Controller
{
    public function index()
    {
        //SELECT *FROM perfil_doctor;
        $Record_Cita = Expediente::all(); //tal cual como el modelo

        //Validando si hay almenos 1 RecordCita de citas o mas.
        if (count($Record_Cita)<1){
            return response()->json(array(
                'message'=> "No se encontraron expedientes de citas prebias del pacientes.",
                'data'=> $Record_Cita, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Expedientes de citas pacientes disponibles.",
            'data'=> $Record_Cita,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM RecordCita doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $RecordCita = RecordCita::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($RecordCita == NULL){
            return response()->json(array(
                'message'=> "expediente de cita no encontrado.",
                'data'=> $RecordCita,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Recor de cita no encontrado exitosamente.",
            'data'=> $RecordCita,
            'code'=> 200, 
        ),200);

    }
}
