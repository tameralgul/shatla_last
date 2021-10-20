<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Essam\TapPayment\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Tap\TapPayment\Facade\TapPayment;

class PaymentController extends Controller
{
    private $secret_api_Key ="sk_test_XKokBfNWv6FIYuTMg5sLPjhJ" ;
    public function index()
    {
        return view('payment');
    }

    public function payment(Request $request)
    {
        dd($request->all());

        try {
        $payment = TapPayment::createCharge();
        $payment->setCustomerName("Shatla");
        $payment->setCustomerPhone("965", "123456789");
        $payment->setAmount(200);
        $payment->setSource();
        $payment->setCurrency("USD");
        $invoice = $payment->pay();
        dd($payment);
    } catch( \Exception $exception ) {
    // your handling of request failure
            dd($exception);
        }

       /* $ammout  = $request->input('amount') * 100;
        \Stripe\Stripe::setApiKey('sk_test_51JbkgNA9tNi29dVHpLvU4HS0K2vW2N41FPNfw8UC1rhW1NE4izJlcPp3Kdbi905oiA4qD93zJGTfgB7OgZEnonvQ00JB9bF8u1');
        try {
            \Stripe\Charge::create(array(
                "amount" => $ammout,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "عملية دفع من خلال موقع شتلة"
            ));
           
            Session::flash('success-message', 'تمت عملية الدفع بنجاح !');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('fail-message', "Error! Please Try again.");
            return redirect()->back();        
        }*/
    }
}
