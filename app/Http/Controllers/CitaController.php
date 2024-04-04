<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cita; //llamar al modelo


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
    public function showHorario(Request $request, string $dia, string $hora) //el string es una validacion, si no se pone por defecto sera una cadena de texto
    {
        //SELECT *FROM Doctor WHERE dia= "?" o ":dia" LIMIT 1 para especificar que solo se espera un dato;
        $horario = Horario::where('dia', '=', $dia)
                            ->where('hora','=', $hora)
                            ->get();//para v er todas las disponibles.

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
    public function storeHorario(Request $request)
    {
        $data =array(
           
            'doctor_id',$request->doctor_id,
            'perfil_id',$request->perfil_id,
            'nombre',$request->nombre,
            'dia',$request->dia,
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

    public function updateHorario(Request $request, string $dia)
    {
        //$request -> validated();//Agregar esta linea cuando se haya hecho el archivo request

        //1.validar los datos
        $horario = Horario::where('dia', '=', $dia);

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

        $horario->doctor_id=$request->doctor_id;
        $horario->perfil_id=$request->perfil_id;
        $horario->nombre=$request->nombre;
        $horario->dia=$request->dia;
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


}
