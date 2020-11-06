<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Payment;

class PaypalController extends Controller
{
   
	protected $provider;

	public function __construct() {
	    $this->provider = new ExpressCheckout();
	}

	/**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'Aah.care',
                'price' => $request->input('amount'),
                'desc'  => 'Paiement de consultation chez Aah.care',
                'qty' => 1
            ]
        ];

        $payment = new Payment();
        $payment->amount = $request->input('amount');
        $payment->save();
  
        $data['invoice_id'] = $payment->id;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $request->input('amount');
  
        //$provider = new ExpressCheckout();
  
        $response = $this->provider->setExpressCheckout($data);
  
        $response = $this->provider->setExpressCheckout($data, true);
  
        return redirect($response['paypal_link']);
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
    	//dd($data);
        $payment = Payment::findOrFail($data['invoice_id']);

        $payment->delete();

        return redirect()->back()->with('error', 'Your payment is canceled!');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
    	$token = $request->get('token');

        //$PayerID = $request->get('PayerID');

        $status = '';

        // initaly we paypal redirects us back with a token
        // but doesn't provice us any additional data
        // so we use getExpressCheckoutDetails($token)
        // to get the payment details

        $response = $this->provider->getExpressCheckoutDetails($token);

        $payment_id = explode('_', $response['INVNUM'])[1];

        // find payment by id
        $payment = Payment::find($payment_id);

        
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

        	//$payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);

        	$status = $response['PAYMENTINFO_0_PAYMENTSTATUS'];

        	// set payment status
        	$payment->payment_status = $status;

        	// save the payment
        	$payment->save();

        	return redirect('/')->with('success', 'Order ' . $payment->id . ' has been paid successfully!');

            //dd('Your payment was successfully. You can create success page here.');
        }

        // if response ACK value is not SUCCESS or SUCCESSWITHWARNING
        // we return back with error
        // Delete the payment
        $payment->delete();
  
        return redirect()->back()->with('error', 'Error processing PayPal payment for Order ' . $invoice->id . '!');
    }

	public function expressCheckoutSuccess(Request $request) {

        // check if payment is recurring
        $recurring = $request->input('recurring', false) ? true : false;

        $token = $request->get('token');

        $PayerID = $request->get('PayerID');

        // initaly we paypal redirects us back with a token
        // but doesn't provice us any additional data
        // so we use getExpressCheckoutDetails($token)
        // to get the payment details
        $response = $this->provider->getExpressCheckoutDetails($token);

        // if response ACK value is not SUCCESS or SUCCESSWITHWARNING
        // we return back with error
        if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            return redirect('/')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment']);
        }

        // invoice id is stored in INVNUM
        // because we set our invoice to be xxxx_id
        // we need to explode the string and get the second element of array
        // witch will be the id of the invoice
        $invoice_id = explode('_', $response['INVNUM'])[1];

        // get cart data
        $cart = $this->getCart($recurring, $invoice_id);

        // check if our payment is recurring
        if ($recurring === true) {
            
            // if recurring then we need to create the subscription
            // you can create monthly or yearly subscriptions
            $response = $this->provider->createMonthlySubscription($response['TOKEN'], $response['AMT'], $cart['subscription_desc']);
            
            $status = 'Invalid';
            // if after creating the subscription paypal responds with activeprofile or pendingprofile
            // we are good to go and we can set the status to Processed, else status stays Invalid
            if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                $status = 'Processed';
            }

        } else {

            // if payment is not recurring just perform transaction on PayPal
            // and get the payment status
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);

            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

        }

        // find payment by id
        $payment = Payment::find($invoice_id);

        // set payment status
        $payment->payment_status = $status;

        // if payment is recurring lets set a recurring id for latter use
        if ($recurring === true) {

            $payment->recurring_id = $response['PROFILEID'];

        }

        // save the payment
        $payment->save();

        // App\Payment has a paid attribute that returns true or false based on payment status
        // so if paid is false return with error, else return with success message
        if ($payment->status ) {
            return redirect('/')->with(['code' => 'success', 'message' => 'Order ' . $invoice->id . ' has been paid successfully!']);
        }
        
        return redirect('/')->with(['code' => 'danger', 'message' => 'Error processing PayPal payment for Order ' . $invoice->id . '!']);
    }

	/*private function getCart($recurring, $invoice_id)
    {

        if ($recurring) {
            return [
                // if payment is recurring cart needs only one item
                // with name, price and quantity
                'items' => [
                    [
                        'name' => 'Monthly Subscription ' . config('paypal.invoice_prefix') . ' #' . $invoice_id,
                        'price' => 20,
                        'qty' => 1,
                    ],
                ],

                // return url is the url where PayPal returns after user confirmed the payment
                'return_url' => url('/paypal/express-checkout-success?recurring=1'),
                'subscription_desc' => 'Monthly Subscription ' . config('paypal.invoice_prefix') . ' #' . $invoice_id,
                // every invoice id must be unique, else you'll get an error from paypal
                'invoice_id' => config('paypal.invoice_prefix') . '_' . $invoice_id,
                'invoice_description' => "Order #". $invoice_id ." Invoice",
                'cancel_url' => url('/'),
                // total is calculated by multiplying price with quantity of all cart items and then adding them up
                // in this case total is 20 because price is 20 and quantity is 1
                'total' => 20, // Total price of the cart
            ];
        }

        return [
            // if payment is not recurring cart can have many items
            // with name, price and quantity
            'items' => [
                [
                    'name' => 'Product 1',
                    'price' => 10,
                    'qty' => 1,
                ],
                [
                    'name' => 'Product 2',
                    'price' => 5,
                    'qty' => 2,
                ],
            ],

            // return url is the url where PayPal returns after user confirmed the payment
            'return_url' => url('/paypal/express-checkout-success'),
            // every invoice id must be unique, else you'll get an error from paypal
            'invoice_id' => config('paypal.invoice_prefix') . '_' . $invoice_id,
            'invoice_description' => "Order #" . $invoice_id . " Invoice",
            'cancel_url' => url('/'),
            // total is calculated by multiplying price with quantity of all cart items and then adding them up
            // in this case total is 20 because Product 1 costs 10 (price 10 * quantity 1) and Product 2 costs 10 (price 5 * quantity 2)
            'total' => 20,
        ];
    }*/
}
