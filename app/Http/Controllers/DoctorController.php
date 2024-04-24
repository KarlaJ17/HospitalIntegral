<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//importando Request de validaciones
use App\Http\Requests\DoctorRequest;

use App\Models\Doctor; //llamar al modelo

class DoctorController extends Controller
{
    public function index()
    {
        //SELECT *FROM Doctor;
        $doctores = Doctor::all(); //tal cual como el modelo

        //Validando si hay almenos 1 perfil de doctor o mas.
        if (count($doctores)<1){
            return response()->json(array(
                'message'=> "No se encontraron perfiles de doctores.",
                'data'=> $doctores, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Perfiles de doctores disponibles.",
            'data'=> $doctores,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM perfil doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $doctor = Doctor::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($doctor == NULL){
            return response()->json(array(
                'message'=> "Registro Doctor no encontrado.",
                'data'=> $doctor,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Registro Doctor encontrado exitosamente.",
            'data'=> $doctor,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo doctor.
    public function store(Request $request)
    {
        $data =array(
            'especialidad_id', $request->especialidad_id,
            'nombre', $request->nombre,
            'email', $request->email,
            'password', $request->password,
        
        );
        //INSERT INTO $perfil_doctor () VALUES();
        $newDoctor = new Doctor($data);

        if ($newDoctor->save()== false){
            return response()->json(array(
                'message'=> "Registro de doctor no procesada.",
                'data'=> $newDoctor,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "Doctor registrado con exito.",
            'data'=> $newDoctor,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un cliente en especifico.

    public function update(Request $request, string $nombre)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $doctor = Doctor::where('nombre', '=', $nombre);

        //2.Verificar la existencia del registro
        if ($doctor == NULL){
            return response()->json(array(
                'message'=> "Registro de Doctor no encontrado.",
                'data'=> $doctor,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del doctor UPDATE doctor SET names = ? WHERE dui = ?

        $doctor->especialidad_id=$request->especialidad_id;
        $doctor->nombre=$request->nombre;
        $doctor->email=$request->email;
        $doctor->password=$request->password;


        if ($doctor->save()== false){
            return response()->json(array(
                'message'=> "Información de registro no actualizada.",
                'data'=> $doctor,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "Registro de Doctor actualizado con exito.",
            'data'=> $doctor,
            'code'=> 200, 
        ),200);
    }
    //Inserta un nuevo elemeto la tabla
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM doctors WHERE id=1;
        $doctor=doctor::find($id);

        $doctor-> delete();

        return response()->json(array(
            'message'=> "doctor eliminado",
            'data'=>$doctor,
            'code'=>200,
        ),200);

    } 
}
