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
    //3. Registrar un nuevo RecordCita.
    public function store(Request $request)
    {
        $data =array(
           
            'expediente_id',$request->expediente_id,
            'especialida_id',$request->especialidad_id,
            'citas_pasadas',$request->citas_pasadas,
           
        );
        //INSERT INTO $expediente_doctor () VALUES();
        $newexpediente = new RecordCita($data);

        if ($newexpediente->save()== false){
            return response()->json(array(
                'message'=> "Información de RecordCita no procesada.",
                'data'=> $newexpediente,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "RecordCita guardado con exito.",
            'data'=> $newexpediente,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un RecordCita en especifico.

    public function update(Request $request, string $nombre)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $RecordCita = RecordCita::where('nombre', '=', $nombre);

        //2.Verificar la existencia del registro
        if ($RecordCita == NULL){
            return response()->json(array(
                'message'=> "Record de citas no encontrado.",
                'data'=> $RecordCita,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del RecordCita UPDATE RecordCita SET names = ? WHERE dui = ?

        $RecordCita->expediente_id=$request->expediente_id;
        $RecordCita->especialid_id=$request->especialidad_id;
        $RecordCita->citas_pasadas=$request->citas_pasadas;
       

        if ($RecordCita->save()== false){
            return response()->json(array(
                'message'=> "Expediente de citas no actualizado.",
                'data'=> $RecordCita,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "Expediente de citas actualizado con exito.",
            'data'=> $RecordCita,
            'code'=> 200, 
        ),200);
    }
    //Inserta un nuevo elemeto la tabla
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM expedientes WHERE id=1;
        $RecordCita=RecordCita::find($id);

        $RecordCita-> delete();

        return response()->json(array(
            'message'=> "RecordCita eliminado",
            'data'=>$RecordCita,
            'code'=>200,
        ),200);

    } 
}
