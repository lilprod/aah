<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Speciality;
use App\Doctor;
use App\History;
use App\Notification;
use App\Patient;
use App\Schedule;
use App\User; 
use App\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all payments and pass it to the view
        $payments = Payment::all();

        return view('admin.transactions.index')->with('payments', $payments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::findOrFail($id);

        return view('admin.transactions.show', compact('payment'));
    }
}
