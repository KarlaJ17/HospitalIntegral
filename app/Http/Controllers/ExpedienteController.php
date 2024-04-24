<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expediente; //llamar al modelo

class ExpedienteController extends Controller
{
    public function index()
    {
        //SELECT *FROM perfil_doctor;
        $expedientes = Expediente::all(); //tal cual como el modelo

        //Validando si hay almenos 1 expediente de doctor o mas.
        if (count($expedientes)<1){
            return response()->json(array(
                'message'=> "No se encontraron expedientes de pacientes.",
                'data'=> $expedientes, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Expedientes de pacientes disponibles.",
            'data'=> $expediente,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM expediente doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $expediente = expediente::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($expediente == NULL){
            return response()->json(array(
                'message'=> "expedienteno encontrado.",
                'data'=> $expediente,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "expediente  encontrado exitosamente.",
            'data'=> $expediente,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo expediente.
    public function store(Request $request)
    {
        $data =array(
           
            'perfil_id',$request->perfil_id,
            'doc_id',$request->doc_id,
            'receta_id',$request->receta_id,
            'enfermedad',$request->enfermedad,
            'ingreso',$request->ingreso,
            'cita',$request->cita,
            'examen',$request->examen,
            'referencia',$request->referencia,
        );
        //INSERT INTO $expediente_doctor () VALUES();
        $newexpediente = new expediente($data);

        if ($newexpediente->save()== false){
            return response()->json(array(
                'message'=> "Información de expediente no procesada.",
                'data'=> $newexpediente,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "expediente guardado con exito.",
            'data'=> $newexpediente,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un expediente en especifico.

    public function update(Request $request, string $nombre)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $expediente = expediente::where('nombre', '=', $nombre);

        //2.Verificar la existencia del registro
        if ($expediente == NULL){
            return response()->json(array(
                'message'=> "expediente no encontrado.",
                'data'=> $expediente,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del expediente UPDATE expediente SET names = ? WHERE dui = ?

        $expediente->perfil_id=$request->perfil_id;
        $expediente->doc_id=$request->doc_id;
        $expediente->receta_id=$request->receta_id;
        $expediente->enfermedad=$request->enfermedad;
        $expediente->ingreso=$request->ingreso;
        $expediente->cita=$request->cita;
        $expediente->examen=$request->examen;
        $expediente->referencia=$request->referencia;

        if ($expediente->save()== false){
            return response()->json(array(
                'message'=> "Expediente no actualizado.",
                'data'=> $expediente,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "Expediente actualizado con exito.",
            'data'=> $expediente,
            'code'=> 200, 
        ),200);
    }
    //Inserta un nuevo elemeto la tabla
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM expedientes WHERE id=1;
        $expediente=expediente::find($id);

        $expediente-> delete();

        return response()->json(array(
            'message'=> "expediente eliminado",
            'data'=>$expediente,
            'code'=>200,
        ),200);

    } 
}
