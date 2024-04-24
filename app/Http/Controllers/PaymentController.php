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
    public function getOrCreateCustomer(int $pacienteId){

        //Obtenemos el cliente segun id
        $pacientesId = Paciente::where('id', '=', $pacienteId)->first();

        //Verificamos que exista el cliente. 
        if ($customer == NULL) {
            return NULL;
        }

        //Si existe, verificamos si tiene custumer_uid
        if ($customer->customer_uid == NULL) {
            //Generamos el UID por medio de Stripe
           $newCustomerUid =  $this->stripe->customers->create(array(
                'name' => $customer->names,
                'email' => "pay@test.com"
            ));

           
            //Asignamos el valor del UID al cliente
            $customer->customer_uid = $newCustomerUid->id;
            $customer->save();//Guardar los cambios. 
        }

        return $customer->customer_uid;
    }

    //Genera un ID para la tarjeta de forma temporal. **Codifica la informacion para que no se vea bulnerable cuando viaja. 
        public function createCard($cardDetails, $customerId)
    {
        //Generamos el ID de tarjeta temporal
        $paymentMethod = $this->stripe->customers->createSource(
            $customerId,
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

        $customer= Customer::where('dui','=',$dui)->first();

        if ($customer == NULL){
            return response()->json(array(
                'message'=>"Cliente no encontrado",
                'data'=> $customer,
                'code'=>404,
            ),404);
        }

        //Obtenemos o creamos el Token (ID de stripe) del cliente
        //esto es de Programacion Orientada a Objetos
        $customerToken =$this-> getOrCreateCustomer($customer->id);

        //Recolectar los datos de la tarjeta 
        $cardDetails=array(
            'number'=> $request->card_number,
            'exp_month'=>$request->exp_month,
            'exp_year'=>$request->exp_year,
            'object'=>'card'
        );
        //Generamos el ID teporal de la tarjeta 
        $cardToken =$this->createCard($cardDetails, $customerToken);

        //Obtener la información de pago

        //Monto a pagar (ctvs)
        $amount =$request->amount *100; //->$1.00=100
        $concept = "Pago por compra online.";

        //Generar el cargo, es lo que se envia a la plataforma
        $charge=$this->stripe->charges->create(array(
            'amount'=> $amount,
            'currency'=> 'usd', //Moneda de pago
            'source' =>$cardToken, //Metodo de pago o tarjeta a pagar
            'customer'=> $customerToken,//Cliente que paga
            'description'=>$concept,//El porque o el que se estan pagando
        ));
    }

        public function store(PaymentRequest $request){
            $request->validated();
            $data = array(
                'dui' => $request->dui, 
                'amount' => $request->amount, 
                'number' => $request->number, 
                'exp_month' =>$request->exp_month,
                'exp_year' =>$request->exp_year,
                
            );
        

        return  response()->json(array(
            'message'=>"Pago realizado con exito",
                'data'=> $charge,
                'code'=>200,
            ),200);

    }
}
