<?php

namespace App\Http\Controllers;

//Importando modelos siempre la primera letra mayuscula
use App\Models\Especialidad;

use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    //Lista de todas las especialidades
    //http://localhost:8000/api/especialidad/index

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
    //http://localhost:8000/api/especialidad/show/oftalmologo

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM especialidades WHERE nombre= "?" o ":nombre" ;
        $especialidad = especialidad::where('nombre', '=', $nombre);

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

    //3. Registrar una nueva especialidad.
    //http://localhost:8000/api/especialidad/store
    public function store(Request $request)
    {
        $data =array(
            'nombre_especialidad', $request->nombre_especialidad, 
        
        );
        //INSERT INTO $newEspecialidad () VALUES();
        $newEspecialidad = new Especialidad($data);

        if ($newEspecialidad->save()== false){
            return response()->json(array(
                'message'=> "Especialidad no procesada.",
                'data'=> $newEspecialidad,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "Especialidad guardada con exito.",
            'data'=> $newEspecialidad,
            'code'=> 201, 
        ),201);


    }
    //
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM especialidads WHERE id=1;
        $especialidad=especialidad::find($id);

        $especialidad-> delete();

        return response()->json(array(
            'message'=> "especialidad eliminada",
            'data'=>$especialidad,
            'code'=>200,
        ),200);

    } 

}
