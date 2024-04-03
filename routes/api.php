<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Importando controladores(controllers)

use App\Http\Controllers\EspecialidadController; //<-Importación

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

//metodo("/asignar un nombre en singular"/el metodo que vamos a usar[index,get,get-all])
Route::get('/especialidad/index',array(   //el mismo nombre de abajo 
    EspecialidadController::class, //controlador
    'index', //metodo
))->name('especialidad.index');  //poner el nombre de la ruta despues del punto controlador/metodo