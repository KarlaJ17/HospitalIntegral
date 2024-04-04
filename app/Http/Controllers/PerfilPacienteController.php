<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PerfilPaciente; //llamar al modelo

class PerfilPacienteController extends Controller
{
    public function index(){
        //SELECT * FROM perfil
        $pacientes= PerfilPaciente::all(); //Ejemplo del modelo
        //Validando los perfiles del paciente si hay uno o más
        if (count($pacientes)<1)
        {
            return response()->jason(array(
            'message'=> "No se encontraron perfiles de pacientes registrados.",
            'data'=>$pacientes, //información de la tabla
            'code'=>404,

            ),404);
        }
        
        return response()->json(array(
            'message'=>"Perfiles de pacioentes disponibles",
            'data'=>$pacientes,
            'code'=>200,
        ),200);
    }

    //Usando string usado cómo validación

    public function show(Request $request, string $nombre){
    // SELECT FROM * pacientes WHERE nombre ? LIMIT 1 para esperar un dato
    //*Validando que hay al menos un paciente
    $pacientes = PerfilPaciente::where('nombre', '=', $nombre)->first();

    //Validando si hay almenos 1 paciente

    if ($pacientes == NULL){
        return response()->json(array(
            'message'=> "Perfil no encontrado.",
            'data'=> $pacientes,
            'code'=> 404,
        ),404);
    }
    
    return response()->json(array(
        'message'=> "Paciente encontrado exitosamente.",
        'data'=> $paciente,
        'code'=> 200, 
    ),200);

}
//3. Registro de nuevo paciente
public function store(Request $request)
{
    $data =array(
        'nombre_completo',$request->name,
        'email'=>$request->correo,
        'telefono'=>$request->telefono,
        'password'=>$request->password,
    
    );
    //INSERT INTO $pacientes () VALUES();
    $newPaciente = new Paciente($data);

    if ($newPaciente->save()== false){
        return response()->json(array(
            'message'=> "Información de perfil no procesada.",
            'data'=> $newPaciente,
            'code'=> 422,
        ),422);
    }
    
    return response()->json(array(
        'message'=> "Perfil guardado con exito.",
        'data'=> $newPaciente,
        'code'=> 201, 
    ),201);


}
}
