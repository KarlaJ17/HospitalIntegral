<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon; //Sirve para crear fechas.
use Illuminate\Http\Request;

//Librerias para cambio de contraseña. 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\PasswordReset;

use App\Models\User; //Modelos para consultar usuarios. 

class AuthController extends Controller
{
    //Registro POST
    public function register(Request $request)
    {
        //Es necesario hacer la validacion mas adelante
        //$request->validated();

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        );

        $newUser = new User($data);
        if ($newUser->save() == false) {
            return response()->json(array(
                'message' => "Informacion no procesada",
                'data' => $data,
                'code' => 422,
            ),422);
        }

        return response()->json(array(
            'message' => 'Registrado con exito',
            'data' => $newUser,
            'code' =>201,
        ),201);
    }

    //Iniciar sesion POST
    public function login(Request $request){
        //$request->validated();

        //Se verifica si el usuario existe. 
        $user = User::where('email', '=', $request->email)->first();

        //Obtenemos las credenciales de acceso.
        $credentials = request(array(
            'email',
            'password'
        )); 

        //Limpiamos los espacios al inicio y final de la contraseña. 
        $credentials['password'] =trim($credentials['password']);
        
        //Verificamos que el usuario exista mientas intentamos iniciar sesion.

        if(
            Auth::attempt($credentials) == false || /*Or (o)*/ $user == NULL ){  //Es una doble validacion, va a determinar si va vacio o si tiene algun registro. 
             return response()->json(array(
                'message' => "Usuario no encontrada. Verifique sus credenciales.",
                'data',
                'code' => 401 //401 significa que no podra iniciar sesion. 
             ),401);   
        }

        //Se obtiene el usuario de ina sesion inicial. 
        $user = $request->user();

        //Definimos el nombre para el token
        $tokenResult = $user->createToken('User Acces Token');

        //Generamos el token 
        $token = $tokenResult->token;

        //Generamos una fecha de vencimiento
        $token->expires_at = Carbon::now()->addHours(2);

        //Guardar el token 
        $token->save(); 

        $result =array(
            'access_token' =>$tokenResult->accessToken,
            'token_type' => 'Bearer', //Eso no va a variar 
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        );

        return response()->json(array(
            'message' => 'Bienvenido',
            'data' => $result,
            'code' =>200
        ),200);


    }

    //Cerrar sesion GET
    public function logout(Request $request){
        //Obtener el usuario de la peticion.
        $user = $request->user();

        //Obtenemos el toquen del usuario. 
        $token= $user->token();
        
        //Revocamos (Desahabilitar) el token

        $token->revoke();

        return response()->json(array(
            'message' => 'Cierre de sesion exitoso',
            'data' => true,
            'code' =>200
        ),200);



    }

    //Perfil GET
    public function profile(Request $request){

        //Obtenemos la info del usuario segun token 
        $user = $request->user();

        return response()->json(array(
            'message' => 'Perfil del usuario',
            'data' => $user,
            'code' =>200
        ),200);

    }

    //Enviando correo de cambio de contraseña (POST)
    public function sendResetlink(Request $request){

        //$request->validated();

        //Validando si el correo corresponde a un usuario dentro de la aplicacion. 

        $user = User::where('email', '=', $request->email)->first();

        //Validando en caso que no este. 

        if (  $user == NULL) {
            return response()->json(array(
                'message' => "Usuario no encontrado. Verifique sus credenciales",
                'data' => $user,
                'code' => 401, 

            ),401); 
        }


        //Recuperamos el email de la peticion. 
        $input = $request->only('email');

        //Enviando correo de cambio de contraseña. 
        $send = Password::sendResetLink($input); //Le mando el correo que estoy tomando en la linea anterior. 
        // return $send;
        //Validando que el correo se envie con exito. 
        if ($send != Password::RESET_LINK_SENT) {
            return response()->json(array(
                'message' => "No se ha logrado enviar el correo de cambio de contraseña",
                'data' => $user,
                'code' => 400, 

            ),400); 
        } 
        return response()->json(array(
            'message' => "Correo enviado con exito. ",
            'data' => $user,
            'code' => 200, 

        ),200); 


    }

    //Cambio de contraseña (POST)
    public function resetPassword(Request $request){
        /*
            Se necesitan 4 datos para cambiar la contraseña
            *email 
            *token (Se genera al enviar el correo)
            *password
            *password_confirmation. 
        
        */
        //$request->validated();

        //Obtenemos los datos de la peticion. 
        $input = $request->only('email', 'token', 'password', 'password_confirmation');

        //Cambiamos la contraseña segun los datos enviados. 
        $chanche = Password::reset($input, function($user, $password){
           //Forzamos el cambio del usuario. 
            $user->forceFill(array(
                //Cambiamos la contraseña por una nueva encriptada. 
                'password' => bcrypt($password),
            ))
            ->save();//Guardamos la informacion una vez modificada. 

            //Indicamos que el cambio se realizo. 
            event(new PasswordReset($user));
        }); //Esto va a permitir cambiar la contraseña. 

        //Validamos que el cambio se realizo con exito. 
        if ($chanche != Password::PASSWORD_RESET) {
            return response()->json(array(
                'message' => "No se logro realizar el cambio de contraseña",
                'data' => $input,
                'code' => 400, 

            ),400); 
        }

        return response()->json(array(
            'message' => "Cambio de contraseña realizado con exito.",
            'data' => true,
            'code' => 200, 

        ),200); 


    }




}
