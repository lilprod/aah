<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Countries;
use Illuminate\Support\Facades\Auth;
use App\Patient;
use App\Doctor;
use App\Appointment;
use App\Prescription;
use App\Payment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware(['auth', '2fa']);
    }*/

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

            $prescriptions = auth()->user()->patientprescriptions();

            $payments = auth()->user()->patientpayments();

            return view('patients.dashboard', compact('appointments', 'prescriptions', 'payments'));

        }elseif(auth()->user()->role_id == 2){

            $upcomapts = auth()->user()->doctorUpcomingapts();

            $todayapts = auth()->user()->doctorTodayapts();

            $prescriptions = auth()->user()->doctorprescriptions();

            $payments = auth()->user()->doctorpayments();

            $doctor = Doctor::where('user_id', auth()->user()->id)->first();

            $today = Carbon::today();

            return view('doctors.dashboard' , compact('upcomapts', 'todayapts', 'prescriptions', 'payments', 'doctor', 'today'));

        }else{

            Auth::logout();

            return redirect()->route('admin.login')
            ->with('success',
             'Veuillez vous connecter ici!');
 
        }
    }


    public function reauthenticate(Request $request)
    {
        // get the logged in user
        $user = \Auth::user();

        // initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // generate a new secret key for the user
        $user->google2fa_secret = $google2fa->generateSecretKey();

        // save the user
        $user->save();

        // generate the QR image
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        // Pass the QR barcode image to our view.
        return view('google2fa.register', ['QR_Image' => $QR_Image, 
                                            'secret' => $user->google2fa_secret,
                                            'reauthenticating' => true
                                        ]);
    }

    
}
