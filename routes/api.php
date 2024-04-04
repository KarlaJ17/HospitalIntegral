<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Importando controladores(controllers)

use App\Http\Controllers\EspecialidadController; //<-Importación
use App\Http\Controllers\PerfilDoctorController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HorarioController;

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


//RUTAS HorarioController
//http://localhost:8000/api/horario/index
Route::get('/horario/index',array(   //el mismo nombre de abajo 
    HorarioController::class, //controlador
    'index', //metodo
))->name('horario.index');  //poner el nombre de la ruta despues del punto controlador/metodo

//http://localhost:8000/api/horario/show/karla
Route::get('horario/show/{nombre}',array(   //
    HorarioController::class,
    'show',
))->name('horario.show'); 

//http://localhost:8000/api/horario/store
Route::post('horario/store',array(   
    HorarioController::class,
    'store',
))->name('horario.store'); 
