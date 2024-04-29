<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TarjetaController extends Controller
{
    public function index()
    {
        //SELECT *FROM tarjeta
        $tarjeta = tarjeta::all(); //tal cual como el modelo

        //Validando si hay almenos 1 tarjeta o mas.
        if (count($tarjeta)<1){
            return response()->json(array(
                'message'=> "No se encontraron tarjetas registradas del pacientes.",
                'data'=> $tarjeta, //informacion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "tarjetas registradas del pacientes disponibles.",
            'data'=> $tarjeta,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM tarjeta doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $tarjeta = tarjeta::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($tarjeta == NULL){
            return response()->json(array(
                'message'=> "tarjeta no encontrado.",
                'data'=> $tarjeta,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "tarjeta registrada encontrada exitosamente.",
            'data'=> $tarjeta,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar una nueva tarjeta.
    public function store(Request $request)
    {
        $data =array(
           
            'perf_id',$request->perfil_id,
            'monto_id',$request->monto_id,
            'tipo_tarjeta',$request->tipo_tarjeta,
            'vencimiento',$request->vencimiento,
            'cuatro_digitos',$request->cuatro_digitos,


        );
        //INSERT INTO $tarjeta () VALUES();
        $newtarjeta = new tarjeta($data);

        if ($newtarjeta->save()== false){
            return response()->json(array(
                'message'=> "Información de tarjeta no procesada.",
                'data'=> $newtarjeta,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "dato de la tarjeta guardado con exito.",
            'data'=> $newtarjeta,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un tarjeta en especifico.

    public function update(Request $request, string $nombre)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $tarjeta = tarjeta::where('nombre', '=', $nombre);

        //2.Verificar la existencia del registro
        if ($tarjeta == NULL){
            return response()->json(array(
                'message'=> "tarjeta no encontrado.",
                'data'=> $tarjeta,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del tarjeta UPDATE tarjeta SET names = ? WHERE dui = ?

        $tarjeta->perf_id=$request->perf_id;
        $tarjeta->monto_id=$request->monto_id;
        $tarjeta->tipo_tarjeta=$request->tipo_tarjeta;
        $tarjeta->vencimiento=$request->vencimiento;
        $tarjeta->cuatro_digitos=$request->cuatro_digitos;

     

        if ($tarjeta->save()== false){
            return response()->json(array(
                'message'=> "Datos de tarjeta no actualizada.",
                'data'=> $tarjeta,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "tarjeta actualizada con exito.",
            'data'=> $tarjeta,
            'code'=> 200, 
        ),200);

    }

    //
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM tarjeta WHERE id=1;
        $tarjeta=tarjeta::find($id);

        $tarjeta-> delete();

        return response()->json(array(
            'message'=> "tarjeta eliminada",
            'data'=>$tarjeta,
            'code'=>200,
        ),200);

    } 
}
