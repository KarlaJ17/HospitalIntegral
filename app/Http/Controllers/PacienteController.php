<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paciente; //Llamar al modelo

class IngresoPacienteController extends Controller{


    public function index(){
        // SELECT * FROM paciente_id;
        $pacientes = IngresoPacientes::all(); //Tal cual cómo lo indica el módelo
        
        //Validando si hay al menos un perfil en la base de datos
        if (count($pacientes)<1){
            return response()->json(array(
                'message'=> "No se encontró perfiles de pacientes registrados.",
                'data'=> $paciente, //Extraer información
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Perfiles de pacientes registrados",
            'data'=> $paciente,
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
                'data'=>$paciente,
                'code'=>404,
            ),404);
        }
        return response()->json(array(
            'message'=>"Registro de paciente encontrado exitosamente",
            'data'=>$paciente,
            'code'=>200,
        ),200);
    }
    # III. Registrar un nuevo Paciente
    public function store(Request $request)
    {
        $data=array(
            'citas_id',$request->citas_id,
            'nombre_completo',$request->nombre_completo,
            'email',$request->email,
            'telefono',$request->telefono,
            'password',$request->password,
        );
        #INSERT INTO $Paciente 
        $newPaciente = new Paciente($data);

        if ($newPaciente->save()==false){
            return response()->json(array(
                'message'=>"Registo de paciente no procesado",
                'data'=>$newPaciente,
                'code'=>422,
            ),422);
        }
        return response()->json(array(
            'message'=>"Paciente registrado con exito",
            'data'=>$newPaciente,
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
                'data'=>$paciente,
                'code'=>404,
            ),404);
        }
        
        #3. Sobreescribimos la información existente
        }


}
