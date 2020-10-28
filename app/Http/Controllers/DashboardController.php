<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Countries;
use Illuminate\Support\Facades\Auth;
use App\Patient;
use App\Doctor;
use App\Appointment;
use App\Prescription;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$countries = Countries::all();

        if(auth()->user()->role_id == 1){

            $appointments = auth()->user()->patientappointments();

            return view('patients.dashboard', compact('appointments'));

        }elseif(auth()->user()->role_id == 2){

            $upcomapts = auth()->user()->doctorUpcomingapts();

            $todayapts = auth()->user()->doctorTodayapts();

            return view('doctors.dashboard' , compact('upcomapts', 'todayapts'));

        }else{

            //$token = auth()->user()->token();
            //$token->revoke();

            Auth::logout();

            return redirect()->route('admin.login')
            ->with('success',
             'Veuillez vous connecter ici!');
 
        }
        //return view('dashboard',compact('countries'));
    }

    
}
