<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referencia; //llamar al modelo

class ReferenciaController extends Controller
{
    public function index()
    {
        //SELECT *FROM perfil_doctor;
        $referencias = Referencia::all(); //tal cual como el modelo

        //Validando si hay almenos 1 referencia o mas.
        if (count($referencias)<1){
            return response()->json(array(
                'message'=> "No se encontraron referencias de pacientes.",
                'data'=> $referencias, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "referencias de pacientes disponibles.",
            'data'=> $referencias,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM referencia doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $referencia = referencia::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($referencia == NULL){
            return response()->json(array(
                'message'=> "referencia no encontrado.",
                'data'=> $referencia,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "referencia  encontrado exitosamente.",
            'data'=> $referencia,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo referencia.
    public function store(Request $request)
    {
        $data =array(
           
            'expediente_id',$request->expediente_id,
            'especialidad_id',$request->especialidad_id,
            'diagnostico',$request->diagnostico,

        );
        //INSERT INTO $referencia () VALUES();
        $newreferencia = new referencia($data);

        if ($newreferencia->save()== false){
            return response()->json(array(
                'message'=> "Información de referencia no procesada.",
                'data'=> $newreferencia,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "referencia guardado con exito.",
            'data'=> $newreferencia,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un referencia en especifico.

    public function update(Request $request, string $nombre)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $referencia = referencia::where('nombre', '=', $nombre);

        //2.Verificar la existencia del registro
        if ($referencia == NULL){
            return response()->json(array(
                'message'=> "referencia no encontrado.",
                'data'=> $referencia,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del referencia UPDATE referencia SET names = ? WHERE dui = ?

        $referencia->expediente_is=$request->expediente_is;
        $referencia->especialidad_id=$request->especialidad_id;
        $referencia->diagnostico=$request->diagnostico;
     

        if ($referencia->save()== false){
            return response()->json(array(
                'message'=> "referencia no actualizado.",
                'data'=> $referencia,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "referencia actualizado con exito.",
            'data'=> $referencia,
            'code'=> 200, 
        ),200);
    }
    //Inserta un nuevo elemeto la tabla
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM referencias WHERE id=1;
        $referencia=referencia::find($id);

        $referencia-> delete();

        return response()->json(array(
            'message'=> "referencia eliminada",
            'data'=>$referencia,
            'code'=>200,
        ),200);

    } 
}
