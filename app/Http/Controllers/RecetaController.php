<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function index()
    {
        //SELECT *FROM recetas
        $recetas = Receta::all(); //tal cual como el modelo

        //Validando si hay almenos 1 receta o mas.
        if (count($recetas)<1){
            return response()->json(array(
                'message'=> "No se encontraron recetas de pacientes.",
                'data'=> $recetas, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "recetas de pacientes disponibles.",
            'data'=> $recetas,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM receta doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $receta = receta::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($receta == NULL){
            return response()->json(array(
                'message'=> "receta no encontrado.",
                'data'=> $receta,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "receta encontrado exitosamente.",
            'data'=> $receta,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo receta.
    public function store(Request $request)
    {
        $data =array(
           
            'expediente_id',$request->expediente_id,
            'especialidad_id',$request->especialidad_id,
            'diagnostico',$request->diagnostico,

        );
        //INSERT INTO $receta () VALUES();
        $newreceta = new receta($data);

        if ($newreceta->save()== false){
            return response()->json(array(
                'message'=> "Información de receta no procesada.",
                'data'=> $newreceta,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "receta guardado con exito.",
            'data'=> $newreceta,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un receta en especifico.

    public function update(Request $request, string $nombre)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $receta = receta::where('nombre', '=', $nombre);

        //2.Verificar la existencia del registro
        if ($receta == NULL){
            return response()->json(array(
                'message'=> "receta no encontrado.",
                'data'=> $receta,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del receta UPDATE receta SET names = ? WHERE dui = ?

        $receta->expediente_is=$request->expediente_is;
        $receta->especialidad_id=$request->especialidad_id;
        $receta->diagnostico=$request->diagnostico;
     

        if ($receta->save()== false){
            return response()->json(array(
                'message'=> "receta no actualizado.",
                'data'=> $receta,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "receta actualizado con exito.",
            'data'=> $receta,
            'code'=> 200, 
        ),200);

    }

    //
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM recetas WHERE id=1;
        $receta=receta::find($id);

        $receta-> delete();

        return response()->json(array(
            'message'=> "receta eliminada",
            'data'=>$receta,
            'code'=>200,
        ),200);

    } 
}
