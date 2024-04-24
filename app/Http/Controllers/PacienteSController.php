<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pacientes; //Llamar al modelo

class IngresoPacientesController extends Controller{


    public function index(){
        // SELECT * FROM paciente_id;
        $pacientes = IngresoPacientes::all(); //Tal cual cómo lo indica el módelo
        
        //Validando si hay al menos un perfil en la base de datos
        if (count($pacientes)<1){
            return response()->json(array(
                'message'=> "No se encontró perfiles de pacientes registrados.",
                'data'=> $pacientes, //Extraer información
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Perfiles de pacientes registrados",
            'data'=> $pacientes,
            'code'=> 200, 
        ),200);
    }
    public function show(Request $request, string $nnombre) //Es ua validacio "strig" sio se poe por defecto será ua cadea de texto
    {
        #Select * From Perfil paciete where nombre=? o ":nombre" LIMIT 
        $paciente =Paciente::where('nombre','=',$nombre)->first();
        #Validando que haya almennos un paciente
        
        if ($paciente==NULL){
            return respose()->json(array(
                'message'=>"Registro de Paciente no encotrado",
                'data'=>$pacientes,
                'code'=>404,
            ),404);
        }
        return response()->json(array(
            'message'=>"Registro de paciente encontrado exitosamente",
            'data'=>$pacientes,
            'code'=>200,
        ),200);
    }
    # III. Registrar un nuevo Paciente
    public function store(Request $request)
    {
        $data=array(
            'nombre_completo',$request->nombre_completo,
            'email',$request->email,
            'telefono',$request->telefono,
            'password',$request->password,
        );
        #INSERT INTO $Paciente 
        $newPacientes = new Paciente($data);

        if ($newPaciente->save()==false){
            return response()->json(array(
                'message'=>"Registo de paciente no procesado",
                'data'=>$newPacientes,
                'code'=>422,
            ),422);
        }
        return response()->json(array(
            'message'=>"Paciente registrado con exito",
            'data'=>$newPacientes,
            'code'=>201,
        ),201);
    }

        #Actualizar un paciente en especifico
        public function update(Request $request, string $nombre)
        {
        # $request ->validated(); Archivo request

        #1. Validar los datos
        $paciente=Paciente::where('nombre','=',$nombre);

        # 2. Verificar la existencia del registro
        if ($Paciente== NULL){
            return response()->json(array(
                'mesage'=>"Registro de Paciente no encontrado",
                'data'=>$pacientes,
                'code'=>404,
            ),404);
        }
        
        #3. Sobreescribimos la información existente UPDATE
        #UPDATE
        #La variable trae la info del perfil update 
        $perfil->nombre_completo=$request->nombre_completo;
        $perfil->email=$request->email;
        $perfil->telefono=$request->telefono;
        $perfil->password=$request->password;

        if ($perfil->save()==false){
            return response()->json(array(
                'message'=>"Perfil de Paciente actualizado",
                'data'=>$pacientes,
                'cade'=>200,
            ),200);
        }


}
}