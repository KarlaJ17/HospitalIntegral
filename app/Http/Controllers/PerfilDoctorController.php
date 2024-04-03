<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PerfilDoctor; //llamar al modelo

class PerfilDoctoresController extends Controller
{
    public function index()
    {
        //SELECT *FROM perfil_doctor;
        $doctores = PerfilDoctor::all(); //tal cual como el modelo

        //Validando si hay almenos 1 perfil de doctor o mas.
        if (count($doctores)<1){
            return response()->json(array(
                'message'=> "No se encontraron perfiles de doctores.",
                'data'=> $doctores, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Perfiles de doctores disponibles.",
            'data'=> $doctores,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM perfil doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $doctor = PerfilDoctor::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($doctor == NULL){
            return response()->json(array(
                'message'=> "Perfil no encontrado.",
                'data'=> $doctor,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Doctor encontrado exitosamente.",
            'data'=> $doctor,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo doctor.
    public function store(Request $request)
    {
        $data =array(
            'doc_id',
            'nombre',$request->name,
            'especialidad'=>$request->especialidad,
            'anos_experiencia'=>$request->anos_experiencia,
            'ubicacion'=>$request->ubicacion,
            'numero_contacto'=>$request->numero_contacto,
            'fecha_nacimiento'=>$request->fecha,
            'instagram'=>$request->instagram,
            'whatsapp'=>$request->whatsapp,
            'facebook'=>$request->whatsapp,
        
        );
        //INSERT INTO $perfil_doctor () VALUES();
        $newDoctor = new PerfilDoctor($data);

        if ($newDoctor->save()== false){
            return response()->json(array(
                'message'=> "Información de perfil no procesada.",
                'data'=> $newDoctor,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "Perfil guardado con exito.",
            'data'=> $newDoctor,
            'code'=> 201, 
        ),201);


    }

}
