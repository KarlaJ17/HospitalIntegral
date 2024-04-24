<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//importando Request de validaciones
use App\Http\Requests\HorarioRequest;
use App\Http\Requests\CitaRequest;

use App\Models\Cita; //llamar al modelo
use App\Models\Horario;



class CitaController extends Controller
{
    public function index()
    {
        //SELECT *FROM citas;
        $citas = Cita::all(); //tal cual como el modelo

        //Validando si hay almenos 1 cita o mas.
        if (count($citas)<1){
            return response()->json(array(
                'message'=> "No se encontraron citas disponibles.",
                'data'=> $citas, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "citas disponibles.",
            'data'=> $citas,
            'code'=> 200, 
        ),200);
    }

    
    public function show(Request $request, string $fecha) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM Doctor WHERE dia= "?" o ":dia" LIMIT 1 para especificar que solo se espera un dato;
        $cita = Cita::where('fecha', '=', $fecha);

        //Validando si hay almenos 1 dia

        if ($cita == NULL){
            return response()->json(array(
                'message'=> "Cita no disponible.",
                'data'=> $cita,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Cita encontrado exitosamente.",
            'data'=> $cita,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar una nueva cita disponible.//porque se habilita el horaro?
    public function store(Request $request)
    {
        $data =array(

            'paciente_id',$request->paciente_id,
            'horario_id',$request->horario_id,
            'fecha',$request->fecha,
            'agendar',$request->agrendada,
            'reprogramar',$request->reprogramar,
            'cancelar',$request->cancelar,
        );
        //INSERT INTO $cita() VALUES();
        $newCita = new Cita(data);

        if ($newCita->save()== false){
            return response()->json(array(
                'message'=> "Información de cita no procesada.",
                'data'=> $newCita,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "Cita guardada con exito.",
            'data'=> $newCita,
            'code'=> 201, 
        ),201);

    }

    //Actualizar una cita en especifico.

    public function update(Request $request, string $fecha)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $cita = Cita::where('dia', '=', $fecha);

        //2.Verificar la existencia del registro
        if ($cita == NULL){
            return response()->json(array(
                'message'=> "Cita no encontrada.",
                'data'=> $cita,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del perfil UPDATE perfil SET names = ? WHERE dui = ?

        $cita->paciente_id=$request->paciente_id;
        $cita->horario_id=$request->horario_id;
        $cita->fecha=$request->fecha;
        $cita->agendadar=$request->agrendada;
        $cita->reprograr=$request->reprogramar;
        $cita->cancelar=$request->cancelar;
    

        if ($cita->save()== false){
            return response()->json(array(
                'message'=> "Cita no actualizado.",
                'data'=> $cita,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "Cita actualizada con exito.",
            'data'=> $cita,
            'code'=> 200, 
        ),200);
    }
    //
    public function delete(Request $request){

        $id = $request->id;

        //SELECT *FROM citas WHERE id=1;
        $cita=cita::find($id);

        $cita-> delete();

        return response()->json(array(
            'message'=> "cita eliminada",
            'data'=>$cita,
            'code'=>200,
        ),200);

    } 

    //HorarioController

    public function indexHorario()
    {
        //SELECT *FROM Horario;
        $horarios = Horario::all(); //tal cual como el modelo

        //Validando si hay almenos 1 perfil de doctor o mas.
        if (count($horarios)<1){
            return response()->json(array(
                'message'=> "No se encontraron horarios disponibles.",
                'data'=> $horarios, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "horarios disponibles.",
            'data'=> $horarios,
            'code'=> 200, 
        ),200);
    }

    //PREGUNTAR SI SE BUSCARIA POR DIA Y HORA O SOLO POR DIA, COMO RESTRINGIR LA FECHA Y HORA
    public function showHorario(Request $request, string $fecha, string $hora) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //CONSULTAR POR REVISION DE IF
        //SELECT *FROM Doctor WHERE dia= "?" o ":dia" LIMIT 1 para especificar que solo se espera un dato;
        $horario = Horario::where('fecha', '=', $fecha)
                            ->where('hora','=', $hora)
                            ->get();//para ver todas las disponibles.

        //Validando si hay almenos 1 dia y hora

        if ($horario == NULL){
            return response()->json(array(
                'message'=> "Horario no disponible.",
                'data'=> $horario,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Horario encontrado exitosamente.",
            'data'=> $horario,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo horario disponible.

    //Aqui van los request 
    public function storeHorario(Request $request)
    {
        $request -> validated();//Agregar esta linea cuando se haya hecho el archivo request
        $data =array(
           
            'doctor_id',$request->doctor_id,
            'perfil_id',$request->perfil_id,
            'nombre',$request->nombre,
            'fecha',$request->fecha,
            'hora',$request->hora,
            'estado',$request->estado,
        );
        //INSERT INTO $horario() VALUES();
        $newHorario = new Horario($data);

        if ($newHorario->save()== false){
            return response()->json(array(
                'message'=> "Información de horario no procesada.",
                'data'=> $newHorario,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "Horario guardado con exito.",
            'data'=> $newHorario,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un horario en especifico.

    public function updateHorario(Request $request, string $fecha)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $horario = Horario::where('fecha', '=', $fecha);

        //2.Verificar la existencia del registro
        if ($horario == NULL){
            return response()->json(array(
                'message'=> "Horario no encontrado.",
                'data'=> $horario,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del perfil UPDATE perfil SET names = ? WHERE dui = ?
        //Solo se llaman los request

        $horario->doctor_id=$request->doctor_id;
        $horario->perfil_id=$request->perfil_id;
        $horario->nombre=$request->nombre;
        $horario->fecha=$request->fecha;
        $horario->hora=$request->hora;
        $horario->estado=$request->estado;

        if ($horario->save()== false){
            return response()->json(array(
                'message'=> "Horario no actualizado.",
                'data'=> $horario,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "Horario actualizado con exito.",
            'data'=> $horario,
            'code'=> 200, 
        ),200);
    }
    //Inserta un nuevo elemeto la tabla
    public function deleteHorario(Request $request){

        $id = $request->id;

        //SELECT *FROM categorias WHERE id=1;
        $horario=horario::find($id);

        $horario-> delete();

        return response()->json(array(
            'message'=> "horario eliminado",
            'data'=>$horario,
            'code'=>200,
        ),200);

    } 

    //PacienteCitaController

    public function indexPacienteCita()
    {
        //SELECT *FROM Horario;
        $pacientecitas = PacienteCita::all(); //tal cual como el modelo

        //Validando si hay almenos 1 perfil de doctor o mas.
        if (count($pacientecitas)<1){
            return response()->json(array(
                'message'=> "No se encontraron Datos disponibles.",
                'data'=> $pacientecitas, //infomracion que trae
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Datos disponibles.",
            'data'=> $pacienteCitas,
            'code'=> 200, 
        ),200);
    }

    public function showPacienteCita(Request $request, string $nombre) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
      
        $referencia = referencia::where('nombre', '=', $nombre)->first();

        //Validando si hay almenos 1 nombre

        if ($pacienteCita == NULL){
            return response()->json(array(
                'message'=> "Cita no disponible.",
                'data'=> $pacienteCita,
                'code'=> 404,
            ),404);
        }
        
        return response()->json(array(
            'message'=> "Cita encontrado exitosamente.",
            'data'=> $pacienteCita,
            'code'=> 200, 
        ),200);

    }
    //3. Registrar un nuevo horario disponible.

    //Aqui van los request 
    public function storePacienteCita(Request $request)
    {
        $request -> validated();//Agregar esta linea cuando se haya hecho el archivo request
        $data =array(
           
            'cita_id',$request->cita_id,
            'paciente_id',$request->paciente_id,
            'doctor_id',$request->doctor_id,
        );

        //INSERT INTO $horario() VALUES();
        $newHorario = new Horario($data);

        if ($newHorario->save()== false){
            return response()->json(array(
                'message'=> "Información de horario no procesada.",
                'data'=> $newHorario,
                'code'=> 422,
            ),422);
        }
        
        return response()->json(array(
            'message'=> "Horario guardado con exito.",
            'data'=> $newHorario,
            'code'=> 201, 
        ),201);

    }

    //Actualizar un horario en especifico.

    public function updateHoraro(Request $request, string $fecha)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $horario = Horario::where('fecha', '=', $fecha);

        //2.Verificar la existencia del registro
        if ($horario == NULL){
            return response()->json(array(
                'message'=> "Horario no encontrado.",
                'data'=> $horario,
                'code'=> 404,
            ),404);
        }

        //3.Sobreescribimos la info existente
        //la variable trae la info del perfil UPDATE perfil SET names = ? WHERE dui = ?
        //Solo se llaman los request

        $horario->doctor_id=$request->doctor_id;
        $horario->perfil_id=$request->perfil_id;
        $horario->nombre=$request->nombre;
        $horario->fecha=$request->fecha;
        $horario->hora=$request->hora;
        $horario->estado=$request->estado;

        if ($horario->save()== false){
            return response()->json(array(
                'message'=> "Horario no actualizado.",
                'data'=> $horario,
                'code'=> 422,
            ),422);
        }
        return response()->json(array(
            'message'=> "Horario actualizado con exito.",
            'data'=> $horario,
            'code'=> 200, 
        ),200);
    }
    //Inserta un nuevo elemeto la tabla
    public function deleteHorario(Request $request){

        $id = $request->id;

        //SELECT *FROM categorias WHERE id=1;
        $horario=horario::find($id);

        $horario-> delete();

        return response()->json(array(
            'message'=> "horario eliminado",
            'data'=>$horario,
            'code'=>200,
        ),200);

    } 
}
