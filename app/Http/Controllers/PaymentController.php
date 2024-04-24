<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe\StripeClient;

//Importando los modelos. 
use App\Models\Factura;
use App\Models\Pago;
use App\Models\TpoPago;

class PaymentController extends Controller
{
    
    //Conecta con la plataforma de Stripe. 
    public $stripe = NULL;

    function __construct() {

       $this->stripe = new StripeClient(
            env('STRIPE_SECRET_KEY')
       );
    }


    //Obtener o crear ID de cliente para la pasarela. 
    public function getOrCreatePaciente(int $pacienteId){

        //Obtenemos el cliente segun id
        $pacientesId = Paciente::where('id', '=', $pacienteId)->first();

        //Verificamos que exista el cliente. 
        if ($paciente == NULL) {
            return NULL;
        }

        //Si existe, verificamos si tiene custumer_uid
        if ($paciente->paciente_uid == NULL) {
            //Generamos el UID por medio de Stripe
           $newPacienteUid =  $this->stripe->pacientes->create(array(
                'name' => $paciente->names,
                'email' => "pay@test.com"
            ));

           
            //Asignamos el valor del UID al cliente
            $paciente->paciente_uid = $newpacienteUid->id;
            $paciente->save();//Guardar los cambios. 
        }

        return $paciente->paciente_uid;
    }

    //Genera un ID para la tarjeta de forma temporal. **Codifica la informacion para que no se vea bulnerable cuando viaja. 
        public function createCard($cardDetails, $pacienteId)
    {
        //Generamos el ID de tarjeta temporal
        $paymentMethod = $this->stripe->pacientes->createSource(
            $pacienteId,
            array(
               // 'source'=>array(
                //     'number'=>4242424242424242,
                //     'exp_month'=>4,
                //     'exp_year'=>2025,
                //     'objet' =>'card'
                // ),
                //'source'->$cardDetails,
                'source'=>'tok_gb_mastercard'//Tarjeta predefinida
            )
        );
        return $paymentMethod->id;
    }


    //Realiza el pago del servicio
    public function makePayment(PaymentRequest $request){

        $request->validated();

        //Almacenamos el valor del dui
        $dui= $request->dui;

        //Buscamos el cliente según el dui con el que se registro

        $paciente= paciente::where('dui','=',$dui)->first();

        if ($paciente == NULL){
            return response()->json(array(
                'message'=>"Paciente no encontrado",
                'data'=> $paciente,
                'code'=>404,
            ),404);
        }

        //Obtenemos o creamos el Token (ID de stripe) del cliente
        //esto es de Programacion Orientada a Objetos
        $pacienteToken =$this-> getOrCreatepaciente($paciente->id);

        //Recolectar los datos de la tarjeta 
        $cardDetails=array(
    
            'perf_id'=> $request->perf_id,
            'pago_id'=> $request->pago_id,
            'tipo_tarjeta'=> $request->tipo_tarjeta,
            'numero'=> $request->numero,
            'exp_month'=> $request->exp_month,
            'exp_year'=> $request->exp_year,
            'cvv'=> $request->cvv,
        );
        //Generamos el ID teporal de la tarjeta 
        $cardToken =$this->createCard($cardDetails, $pacienteToken);

        //Obtener la información de pago

        //Monto a pagar (ctvs)
        $amount =$request->amount *100; //->$1.00=100
        $concept = "Pago por cita online.";

        //Generar el cargo, es lo que se envia a la plataforma
        $charge=$this->stripe->charges->create(array(
            'amount'=> $amount,
            'currency'=> 'usd', //Moneda de pago
            'source' =>$cardToken, //Metodo de pago o tarjeta a pagar
            'paciente'=> $pacienteToken,//Cliente que paga
            'description'=>$concept,//El porque o el que se estan pagando
        ));
    }

        public function store(PaymentRequest $request){
            $request->validated();
            $data = array(
                'perf_id'=> $request->perf_id,
                'pago_id'=> $request->pago_id,
                'tipo_tarjeta'=> $request->tipo_tarjeta,
                'numero'=> $request->numero,
                'exp_month'=> $request->exp_month,
                'exp_year'=> $request->exp_year,
                'cvv'=> $request->cvv,
            );
        

        return  response()->json(array(
            'message'=>"Pago realizado con exito",
                'data'=> $charge,
                'code'=>200,
            ),200);

    }
}
