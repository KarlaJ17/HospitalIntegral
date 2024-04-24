<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function index()
    {
        //SELECT *FROM examen
        $examen = examen::all(); //tal cual como el modelo

        //Validando si hay almenos 1 examen o mas.
        if (count($examen)<1){
            return response()->json(array(
                'message'=> "No se encontraron examenes de pacientes.",
                'data'=> $examen, //informacion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "examen de pacientes disponibles.",
            'data'=> $examen,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM examen doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $examen = examen::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($examen == NULL){
            return response()->json(array(
                'message'=> "examen no encontrado.",
                'data'=> $examen,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "examen de datos encontrado exitosamente.",
            'data'=> $examen,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo examen.
    public function store(Request $request)
    {
        $data =array(
           
            'expediente_id',$request->expediente_id,
            'especialidad_id',$request->especialidad_id,
            'nombre_doctor',$request->diagnostico,
            'nombre_paciente',$request->diagnostico,


        );
        //INSERT INTO $examen () VALUES();
        $newexamen = new examen($data);

        if ($newexamen->save()== false){
            return response()->json(array(
                'message'=> "Información de examen no procesada.",
                'data'=> $newexamen,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "examen guardado con exito.",
            'data'=> $newexamen,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un examen en especifico.

    public function update(Request $request, string $nombre)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $examen = examen::where('nombre', '=', $nombre);

        //2.Verificar la existencia del registro
        if ($examen == NULL){
            return response()->json(array(
                'message'=> "examen no encontrado.",
                'data'=> $examen,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del examen UPDATE examen SET names = ? WHERE dui = ?

        $examen->expediente_id=$request->expediente_id;
        $examen->especialidad_id=$request->especialidad_id;
        $examen->nombre_doctor=$request->nombre_doctor;
        $examen->nombre_paciente=$request->nombre_paciente;

     

        if ($examen->save()== false){
            return response()->json(array(
                'message'=> "examen no actualizado.",
                'data'=> $examen,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "examen actualizado con exito.",
            'data'=> $examen,
            'code'=> 200, 
        ),200);

    }

    //
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM examen WHERE id=1;
        $examen=examen::find($id);

        $examen-> delete();

        return response()->json(array(
            'message'=> "examen eliminada",
            'data'=>$examen,
            'code'=>200,
        ),200);

    } 
}
