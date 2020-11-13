<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Appointment;
use App\Department;
use App\Doctor;
use App\History;
use App\Notification;
use App\Patient;
use App\Schedule;
use App\User; 
use App\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Session;
use Stripe;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($id)
    {
        $appointment = Appointment::findOrFail($id);

        return view('payments.stripe', compact('appointment'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 0.7 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Paiement de consultation chez Aah.care."
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        $payment = new Payment();
        $payment->apt_id = $appointment->id;
        $payment->apt_amount = $request->amount;
        $payment->patient_id = $appointment->patient_id;
        $payment->patient_user_id = $appointment->patient_user_id;
        $payment->doctor_id = $appointment->doctor_id;
        $payment->doctor_user_id = $appointment->doctor->user_id;
        $payment->description = 'Patient '.$appointment->patient->name.' '.$appointment->patient->firstname.' Appointment Payment';
        $payment->paymentmode_id = 4;
        $payment->status = 1;
        $payment->save();
   
        //Session::flash('success', 'Payment successful!');
        return redirect()->route('dashboard')->with('success', 'Payment successful!');
           
        //return back();
    }
}
