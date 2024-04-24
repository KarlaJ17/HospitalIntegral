<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RedSocial; //llamar al modelo

class RedSocialController extends Controller
{
    public function index()
    {
        //SELECT *FROM perfil_doctor;
        $RedSocials = RedSocial::all(); //tal cual como el modelo

        //Validando si hay almenos 1 RedSocial de doctor o mas.
        if (count($RedSocials)<1){
            return response()->json(array(
                'message'=> "No se encontraron RedSocials de pacientes.",
                'data'=> $RedSocials, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "RedSocials de pacientes disponibles.",
            'data'=> $RedSocial,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM RedSocial doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $RedSocial = RedSocial::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($RedSocial == NULL){
            return response()->json(array(
                'message'=> "RedSocialno encontrado.",
                'data'=> $RedSocial,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "RedSocial  encontrado exitosamente.",
            'data'=> $RedSocial,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo RedSocial.
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
        //INSERT INTO $RedSocial_doctor () VALUES();
        $newRedSocial = new RedSocial($data);

        if ($newRedSocial->save()== false){
            return response()->json(array(
                'message'=> "Información de RedSocial no procesada.",
                'data'=> $newRedSocial,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "RedSocial guardado con exito.",
            'data'=> $newRedSocial,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un RedSocial en especifico.

    public function update(Request $request, string $nombre)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $RedSocial = RedSocial::where('nombre', '=', $nombre);

        //2.Verificar la existencia del registro
        if ($RedSocial == NULL){
            return response()->json(array(
                'message'=> "RedSocial no encontrado.",
                'data'=> $RedSocial,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del RedSocial UPDATE RedSocial SET names = ? WHERE dui = ?

        $RedSocial->perfil_id=$request->perfil_id;
        $RedSocial->doc_id=$request->doc_id;
        $RedSocial->receta_id=$request->receta_id;
        $RedSocial->enfermedad=$request->enfermedad;
        $RedSocial->ingreso=$request->ingreso;
        $RedSocial->cita=$request->cita;
        $RedSocial->examen=$request->examen;
        $RedSocial->referencia=$request->referencia;

        if ($RedSocial->save()== false){
            return response()->json(array(
                'message'=> "RedSocial no actualizado.",
                'data'=> $RedSocial,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "RedSocial actualizado con exito.",
            'data'=> $RedSocial,
            'code'=> 200, 
        ),200);
    }
    //Inserta un nuevo elemeto la tabla
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM RedSocials WHERE id=1;
        $RedSocial=RedSocial::find($id);

        $RedSocial-> delete();

        return response()->json(array(
            'message'=> "RedSocial eliminado",
            'data'=>$RedSocial,
            'code'=>200,
        ),200);

    } 
}
