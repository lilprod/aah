<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Doctor;
use App\Payment;
use App\Patient;

class PaymentController extends Controller
{
    public function show($id){

    	$payment = Payment::findOrFail($id);

    	return view('patients.appointments.invoice', compact('payment'));
    }
}
