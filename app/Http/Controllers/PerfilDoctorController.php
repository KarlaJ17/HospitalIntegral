<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PerfilDoctor; //llamar al modelo

class PerfilDoctorController extends Controller
{
    public function index()
    {
        //SELECT *FROM perfil_doctor;
        $perfiles = PerfilDoctor::all(); //tal cual como el modelo

        //Validando si hay almenos 1 perfil de doctor o mas.
        if (count($perfiles)<1){
            return response()->json(array(
                'message'=> "No se encontraron perfiles de doctores.",
                'data'=> $perfiles, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Perfiles de doctores disponibles.",
            'data'=> $perfiles,
            'code'=> 200, 
        ),200);
    }

    public function show(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM perfil doctor WHERE nombre= "?" o ":nombre" LIMIT 1 para especificar que solo se espera un dato;
        $perfil = PerfilDoctor::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 cliente

        if ($perfil == NULL){
            return response()->json(array(
                'message'=> "Perfil de doctor no encontrado.",
                'data'=> $perfil,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Perfil de Doctor encontrado exitosamente.",
            'data'=> $perfil,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo doctor.
    public function store(Request $request)
    {
        $data =array(
            'doc_id',$request->doc_id,
            'redes_sociales_id'=>$request->redes_sociales_id,
            'nombre',$request->name,
            'especialidad'=>$request->especialidad,
            'experiencie'=>$request->experiencie,
            'ubicacion'=>$request->ubicacion,
            'numero_contacto'=>$request->numero_contacto,
            'fecha_nacimiento'=>$request->fecha,
           
           
        
        );
        //INSERT INTO $perfil_doctor () VALUES();
        $newPerfil = new PerfilDoctor($data);

        if ($newPerfil->save()== false){
            return response()->json(array(
                'message'=> "Información de perfil no procesada.",
                'data'=> $newPerfil,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "Perfil guardado con exito.",
            'data'=> $newPerfil,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un cliente en especifico.

    public function update(Request $request, string $nombre)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $perfil = PerfilDoctor::where('nombre', '=', $nombre);

        //2.Verificar la existencia del registro
        if ($perfil == NULL){
            return response()->json(array(
                'message'=> "Perfil no encontrado.",
                'data'=> $perfil,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del perfil UPDATE perfil SET names = ? WHERE dui = ?
        $perfil->doc_id=$request->doc_id;
        $perfil->redes_sociales_id=$request->redes_sociales_id;
        $perfil->nombre=$request->nombre;
        $perfil->especialidad=$request->especialidad;
        $perfil->experience=$request->experience;
        $perfil->ubicacion=$request->ubicacion;
        $perfil->numero_contacto=$request->numero_contacto;
        $perfil->fecha_nacimiento=$request->fecha;
      
        

        if ($perfil->save()== false){
            return response()->json(array(
                'message'=> "Perfil de doctor no actualizada.",
                'data'=> $perfil,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "Perfil de doctor actualizado con exito.",
            'data'=> $perfil,
            'code'=> 200, 
        ),200);
    }
    //
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM perfils WHERE id=1;
        $perfil=perfil::find($id);

        $perfil-> delete();

        return response()->json(array(
            'message'=> "perfil eliminada",
            'data'=>$perfil,
            'code'=>200,
        ),200);

    } 
    #Controller RedSocial 
    public function indexRedSocial() 
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

    public function showRedSocial(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
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

}
