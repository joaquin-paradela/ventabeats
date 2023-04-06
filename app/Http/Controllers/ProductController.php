<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use http\Env\Response;
//use Stripe\Stripe;
use App\Http\Controllers\Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        return view('product.index', compact('products'));

    }

    public function checkout(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51Mo6CnKOfUz2wpM5krBE8ZMeH7wY91d1B2f5sPVllkU03BhDs3nlwqmVmzvKYvnE0zTjQQ48iZ2X8oRHRCakpoSe00Pifl7aUS');
        $cartCollection = \Cart::getContent();

        $customer = \Stripe\Customer::create([
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => [
                'line1' => $request->address_line1,
                'line2' => $request->address_line2,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ],
        ]);

       // $products = Product::all();
        $lineItems = [];
        $totalPrice = 0;
        foreach ($cartCollection as $product) {
            $attributes = $product['attributes']; // Acceder a la propiedad "attributes" del elemento actual
            // Hacer algo con la variable $attributes, como imprimir sus valores
            $totalPrice += $product['price'];
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product['price'],
                        'images' => [$attributes['image']],
                       // 'audio' => [$attributes['audio']]
                    ],
                    'unit_amount' => $product['price'] * 100,
                ],
                'quantity' => 1,
            ];
        }

      

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
            'customer' => $customer->id, 
        ]);

       

        

        $order = new Order();
        $order->id_status = 1 ;
        $order->id_user = auth()->id();;
        $order->total_price = $totalPrice;
        $order->session_id = $session->id;
        $order->save();

        return redirect($session->url);
    }

    public function success(Request $request)
    {

        \Stripe\Stripe::setApiKey('sk_test_51Mo6CnKOfUz2wpM5krBE8ZMeH7wY91d1B2f5sPVllkU03BhDs3nlwqmVmzvKYvnE0zTjQQ48iZ2X8oRHRCakpoSe00Pifl7aUS');
        $sessionId = $request->get('session_id');


        try{
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }
            
          
          $customer = \Stripe\Customer::retrieve($session->customer);

          $order = Order::where('session_id', $session->id)->where('id_status', 1)->first();
            if(!$order){
                throw new NotFoundHttpException();
            }
            $order->id_status = 3;
            $order->customer_email = $customer->email;
            $order->save();

            \Cart::clear();
            
        return view('product.checkout-success', compact('customer'))->with('success_msg', 'Success');
        }catch(\Exception $e){
            throw new NotFoundHttpException();
        }
           
       
    }

    public function cancel()
    {

    }

    public function webhook()
    {
        // The library needs to be configured with your account's secret key.
        // Ensure the key is kept out of any version control system you might be using.
        //$stripe = new \Stripe\StripeClient('sk_test_...');

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_b067977213c0d5423603ea374b5a44239861fbd001b2918d501b5424b2612906';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
        } catch(\UnexpectedValueException $e) {
        // Invalid payload
        return response('', 400);
        
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        return response('', 400);
        exit();
        }

        // Handle the event
        switch ($event->type) {
        case 'payment_intent.succeeded':
            $paymentIntent = $event->data->object;
        // ... handle other event types
        default:
            echo 'Received unknown event type ' . $event->type;
        }

        return response('', 200);
    }
}
