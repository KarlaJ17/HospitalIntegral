<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilDoctoresController extends Controller
{
    public function index()
    {
        //SELECT *FROM perfil_doctor;
        $doctor = perfil_doctor::all();

        //Validando si hay almenos 1 perfil de doctor
        if (count($doctor)<1){
            return response()->json(array(
                'message'=> "No se encontraron perfiles de doctores.",
                'data'=> $perfil_doctor,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Perfiles de doctores disponibles.",
            'data'=> $perfil_doctor,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM perfil doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $doctor = perfil_doctor::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($doctor == NULL){
            return response()->json(array(
                'message'=> "Perfil no encontrado.",
                'data'=> $perfil_doctor,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Doctor encontrado exitosamente.",
            'data'=> $perfil_doctor,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo doctor.
    public function store(Request $request)
    {
        $data =array(
            'doc_id',
            'nombre',$request->name,
            //agregar apellido a la base de datos
            'lastname'=>$request->lastname,
            'especialidad'=>$request->especialidad,
            'anos_experiencia'=>$request->anos_experiencia,
            'ubicacion'=>$request->ubicacion,
            'numero_contacto'=>$request->numero_contacto,
            'fecha_nacimiento'=>$request->fecha,
            'instagram'=>$request->instagram,
            'whatsapp'=>$request->whatsapp,
            'facebook'=>$request->facebook,
        
        );
        //INSERT INTO $perfil_doctor () VALUES();
        $newDoctor = new doctor ($data);

        if ($newDoctor->save()== false){
            return response()->json(array(
                'message'=> "Información de perfil no procesada.",
                'data'=> $data,
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
