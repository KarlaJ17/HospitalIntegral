<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Valoracion; //llamar al modelo

class ValoracionController extends Controller
{
    public function index(){
        //SELECT * FROM perfil
        $valoraciones= Valoracion::all(); //Ejemplo del modelo
        //Validando las validaciones 
        if (count($valoraciones)<1)
        {
            return response()->jason(array(
            'message'=> "No se encontraron valoraciones.",
            'data'=>$valoraciones, //información de la tabla
            'code'=>404,

            ),404);
        }
        
        return response()->json(array(
            'message'=>"Valoraciones disponibles",
            'data'=>$valoraciones,
            'code'=>200,
        ),200);
    }
        //3. Registro de nueva valoracion
    public function store(Request $request){
        $data =array(
            'doctor_id',$request->doctor_id,
            'citas_agendadas'=>$request->citas_agendadas,
            'puntuacion'=>$request->puntuacion,
            'comentario'=>$request->comentario,
    
        );
    //INSERT INTO $valoracion () VALUES();
        $newValoracion = new Paciente($data);

        if ($newValoracion->save()== false){
        return response()->json(array(
            'message'=> "Valoración no procesada.",
            'data'=> $newValoracion,
            'code'=> 422,
        ),422);
    }
    
        return response()->json(array(
            'message'=> "Valoración guardado con exito.",
            'data'=> $newValoracion,
            'code'=> 201, 
        ),201);
    }
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM valoracions WHERE id=1;
        $valoracion=valoracion::find($id);

        $valoracion-> delete();

        return response()->json(array(
            'message'=> "valoracion eliminada",
            'data'=>$valoracion,
            'code'=>200,
        ),200);

    } 
    

}
