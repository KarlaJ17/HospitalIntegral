<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Importando controladores(controllers)

use App\Http\Controllers\EspecialidadController; //<-Importación
use App\Http\Controllers\PerfilDoctorController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\CitaController; //cita y horario en el mismo controller

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//RUTAS EspecialidadController
//ruta seria http://localhost:8000/api/especialidad/show

//metodo("/asignar un nombre en singular"/el metodo que vamos a usar[index,get,get-all])
Route::get('/especialidad/index',array(   //el mismo nombre de abajo 
    EspecialidadController::class, //controlador
    'index', //metodo
))->name('especialidad.index');  //poner el nombre de la ruta despues del punto controlador/metodo

//ruta seria http://localhost:8000/api/especialidad/show/karla
Route::get('especialidad/show/{nombre}',array(   //El parametro estatico es dui
    EspecialidadController::class,
    'show',
))->name('especialidad.show'); 

//ruta seria http://localhost:8000/api/especialidad/store
Route::post('especialidad/store',array(   
    EspecialidadController::class,
    'store',
))->name('especialidad.store'); 

//ruta seria http://localhost:8000/api/especialidad/destroy
Route::delete('/especialidad/delete/{nombre}', array(
    EspecialidadController::class,
    'destroy'
))->name('especialidad.destroy');



//RUTAS PerfilDoctorController
//http://localhost:8000/api/perfil/index
Route::get('/perfil/index',array(   //el mismo nombre de abajo 
    PerfilDoctorController::class, //controlador
    'index', //metodo
))->name('perfil.index');  //poner el nombre de la ruta despues del punto controlador/metodo

//http://localhost:8000/api/perfil/show/karla
Route::get('perfil/show/{nombre}',array(   //
    PerfilDoctorController::class,
    'show',
))->name('perfil.show'); 

//http://localhost:8000/api/perfil/store
Route::post('perfil/store',array(   
    PerfilDoctorController::class,
    'store',
))->name('perfil.store'); 

//ruta seria http://localhost:8000/api/perfil/destroy
Route::delete('/perfil/delete/{nombre}', array(
    PerfilDoctorController::class,
    'destroy'
))->name('perfil.destroy');


//RUTAS DoctorController
//http://localhost:8000/api/doctor/index
Route::get('/doctor/index',array(   //el mismo nombre de abajo 
    DoctorController::class, //controlador
    'index', //metodo
))->name('doctor.index');  //poner el nombre de la ruta despues del punto controlador/metodo

//http://localhost:8000/api/doctor/show/karla
Route::get('doctor/show/{nombre}',array(   //
    DoctorController::class,
    'show',
))->name('doctor.show'); 

//http://localhost:8000/api/doctor/store
Route::post('doctor/store',array(   
    DoctorController::class,
    'store',
))->name('doctor.store'); 

//ruta seria http://localhost:8000/api/doctor/destroy
Route::delete('/doctor/delete/{nombre}', array(
    DoctorController::class,
    'destroy'
))->name('doctor.destroy');



//RUTAS CitaController

//HorarioModel
//http://localhost:8000/api/horario/index
Route::get('/horario/index',array(   //el mismo nombre de abajo 
    CitaController::class, //controlador
    'indexHorario', //metodo
))->name('horario.index');  //poner el nombre de la ruta despues del punto controlador/metodo

//http://localhost:8000/api/horario/show/karla
Route::get('horario/show/{dia}/{hora}',array(   //
    CitaController::class,
    'showHorario',
))->name('horario.show'); 

//http://localhost:8000/api/horario/store
Route::post('horario/store',array(   
    citaController::class,
    'storeHorario',
))->name('horario.store'); 

//ruta seria http://localhost:8000/api/horario/destroy
Route::delete('/horario/delete/{dia}{hora}', array(
    HorarioController::class,
    'destroy'
))->name('horario.destroy');


//CitaModel 
//http://localhost:8000/api/cita/index
Route::get('/cita/index',array(   //el mismo nombre de abajo 
    CitaController::class, //controlador
    'index', //metodo
))->name('cita.index');  //poner el nombre de la ruta despues del punto controlador/metodo

//http://localhost:8000/api/cita/show/karla
Route::get('cita/show/{fecha}',array(   //
    CitaController::class,
    'show',
))->name('cita.show'); 

//http://localhost:8000/api/cita/store
Route::post('cita/store',array(   
    CitaController::class,
    'store',
))->name('cita.store'); 

//ruta seria http://localhost:8000/api/cita/destroy
Route::delete('/cita/delete/{fecha}', array(
    CitaController::class,
    'destroy'
))->name('cita.destroy');



//PacienteCitaModel 

//http://localhost:8000/api/pacientecita/index
Route::get('/pacienteCita/index',array(   //el mismo nombre de abajo 
    CitaController::class, //controlador
    'indexPacienteCita', //metodo
))->name('pacientecita.index');  //poner el nombre de la ruta despues del punto controlador/metodo




//RUTAS EXPEDIENTE MODEL

//http://localhost:8000/api/expediente/index
Route::get('/expediente/index',array(   //el mismo nombre de abajo 
    ExpedienteController::class, //controlador
    'index', //metodo
))->name('expediente.index');  //poner el nombre de la ruta despues del punto controlador/metodo

//http://localhost:8000/api/expediente/show/karla
Route::get('expediente/show/{nombre}',array(   //
    ExpedienteController::class,
    'show',
))->name('expediente.show'); 

//http://localhost:8000/api/expediente/store
Route::post('expediente/store',array(   
    ExpedienteController::class,
    'store',
))->name('expediente.store'); 

//ruta seria http://localhost:8000/api/expediente/destroy
Route::delete('/expediente/delete/{nombre}', array(
    ExpedienteController::class,
    'destroy'
))->name('expediente.destroy');


//RUTAS REFERENCIA MODEL

//http://localhost:8000/api/referencia/index
Route::get('/referencia/index',array(   //el mismo nombre de abajo 
    ReferenciaController::class, //controlador
    'index', //metodo
))->name('referencia.index');  //poner el nombre de la ruta despues del punto controlador/metodo

//http://localhost:8000/api/referencia/show/karla
Route::get('referencia/show/{nombre}',array(   //
   ReferenciaController::class,
    'show',
))->name('referencia.show'); 

//http://localhost:8000/api/referencia/store
Route::post('referencia/store',array(   
   ReferenciaController::class,
    'store',
))->name('referencia.store'); 

//ruta seria http://localhost:8000/api/referencia/destroy
Route::delete('/referencia/delete/{nombre}', array(
    ReferenciaController::class,
    'destroy'
))->name('referencia.destroy');



//RECETA MODEL

//http://localhost:8000/api/receta/index
Route::get('/receta/index',array(   //el mismo nombre de abajo 
    RecetaController::class, //controlador
    'index', //metodo
))->name('receta.index');  //poner el nombre de la ruta despues del punto controlador/metodo

//http://localhost:8000/api/receta/show/karla
Route::get('receta/show/{nombre}',array(   //
   RecetaController::class,
    'show',
))->name('receta.show'); 

//http://localhost:8000/api/receta/store
Route::post('receta/store',array(   
   RecetaController::class,
    'store',
))->name('receta.store'); 

//ruta seria http://localhost:8000/api/receta/destroy
Route::delete('/receta/delete/{nombre}', array(
    RecetaController::class,
    'destroy'
))->name('receta.destroy');





//RUTAS LISTAS
/*especialidad, perfil doctor, doctor, cita, horario, pacienteCita, expediente, referencia, receta*/
