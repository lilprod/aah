<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Department;
use App\Doctor;
use App\History;
use App\Notification;
use App\Patient;
use App\Schedule;
use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    protected $provider;

    public function __construct()
    {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
        $this->provider = new ExpressCheckout;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all appointments and pass it to the view
        $appointments = Appointment::all();

        return view('appointments.index')->with('appointments', $appointments);
    }


    public function getSchedule()
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$departments = Department::all();
        $doctors = Doctor::all();

        return view('patients.appointments.create', compact('doctors'));
    }

    public function check(Request $request)
    {
        $doctor =  $request->get('doctor');
        $department = $request->get('department');
        $date =  $request->get('date');
        $time = $request->get('time');
        //$time = $request->get('date').' '.$request->get('time');
        /* $base = Carbon::parse($time);
        $end = $base->copy()->addMinutes(30)->toTimeString();
        $end_time =Carbon::parse($end); */
        //dd($time);
        if (($date != '') && ($time != '')) {
            $appointments = Appointment::where('department_id', $department)
                                        ->where('doctor_id', $doctor)
                                        ->where('date_apt', $date)
                                        ->where('begin_time', $time)
                                        ->get();
            //return $appointment;
            //dd($appointment);
            if (count($appointments) > 0) {
                return 1;
            }
        }
         
        return  0;
        
    }

    public function action(Request $request)
    {
        $id = auth()->user()->id;
        $patient = Patient::where('user_id', '=' ,$id);
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('appointments')
         ->where('name', 'like', '%'.$query.'%')
         ->orWhere('firstname', 'like', '%'.$query.'%')
         ->orWhere('email', 'like', '%'.$query.'%')
         ->orWhere('phone_number', 'like', '%'.$query.'%')
         ->orWhere('address', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();
         
      }
      /* else
      {
       $data = DB::table('clients')
         ->orderBy('id', 'desc')
         ->limit(10)
         ->get();  

         $data = [];

        $data = Appointment::where('user_id', $id)
                            ->orderby('date_apt', 'desc')
                            ->paginate(5);
      } */ 
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->name.'</td>
         <td>'.$row->firstname.'</td>
         <td>'.$row->email.'</td>
         <td>'.$row->phone_number.'</td>
         <td>'.$row->address.'</td>
         <td><a href="'.route('depositedarticle.create', $row->id).'" class="btn btn-success btn-xs"><i class="fa fa-cart-arrow-down"></i> Nouveau Dépôt</a></td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">Pas de Client trouvé</td>
        <td><a href="'.route('customers.create').'" class="btn btn-success btn-xs"><i class="fa fa-smile-o"></i> Ajouter Client </a></td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function success($appointment, $doctor) {

        $appointment = Appointment::findOrFail($appointment);

        $doctor = Doctor::findOrFail($doctor);
        
        return view('patients.appointments.booking_success', compact('appointment', 'doctor'));
    }


    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'doctor_id' => 'required',
            'schedule_id' => 'required',
            'date_apt' => 'required',
            'user_id' => 'required',
            'payment_mode' => 'required',
        ]);

        $appointment = new Appointment();

        $patient = Patient::where('user_id', $request->input('user_id'))->first();

        $appointment->patient_user_id = $request->input('user_id');

        $appointment->patient_id = $patient->id;

        $appointment->date_apt = $request->input('date_apt');

        $appointment->schedule_id = $request->input('schedule_id');

        $schedule = Schedule::findOrFail($request->input('schedule_id'));

        $appointment->begin_time = $schedule->begin_time;

        $appointment->end_time = $schedule->end_time; 

        $appointment->identifier = $this->unique_code(9);

        $appointment->apt_amount = 1;

        $appointment->doctor_id = $request->input('doctor_id');

        $appointment->note = $request->input('note');

        $doctor = Doctor::findOrFail($appointment->doctor_id);

        $appointment->doctor_user_id = $doctor->user_id;

        $appointment->speciality_id = $doctor->speciality_id;

        $appointment->paymentmode_id = $request->payment_mode;

        $appointment->status = 0;

        $historique = new History();
        $historique->action = 'Create';
        $historique->table = 'Appointment';
        $historique->user_id = auth()->user()->id;

        $appointment->save();

        $historique->save();


        if(($request->payment_mode == 1) || ($request->payment_mode == 2)){

            /*$response = Http::post('https://paygateglobal.com/api/v1/pay', [
                'auth_token' => 'a81d1e51-bf4c-4fa1-ad94-ef30eb442c58',
                'identifier' => $appointment->identifier,
            ]);

            $result = $response->getBody()->getContents();

            $data = json_decode($result, true);*/

            $description = 'Patient '.$appointment->patient->name.' '.$appointment->patient->firstname.' Appointment Payment';
            $amount = $appointment->apt_amount;
            $token = "a81d1e51-bf4c-4fa1-ad94-ef30eb442c58";
            $identifier = $appointment->identifier;
            $url = route('dashboard');

            $payment = new Payment();
            $payment->apt_id = $appointment->id;
            $payment->apt_amount = 1;
            $payment->patient_id = $patient->id;
            $payment->patient_user_id = $appointment->patient_user_id;
            $payment->identifier = $appointment->identifier;
            $payment->description = $description;
            $payment->doctor_id = $appointment->doctor_id;
            $payment->doctor_user_id = $doctor->user_id;
            $payment->paymentmode_id = $request->payment_mode;
            $payment->status = 0;
            $payment->save();

            //dd($url);

            $urlString="https://paygateglobal.com/v1/page?token=$token&amount=$amount&description=$description&identifier=$identifier&url=$url";
            return Redirect::to($urlString);

        }elseif($request->payment_mode == 3){

            $data = [];
            $data['items'] = [
                [
                    'name' => 'Aah.care',
                    'price' => 1,
                    'desc'  => 'Paiement de consultation chez Aah.care',
                    'qty' => 1
                ]
            ];

            $payment = new Payment();
            $payment->apt_id = $appointment->id;
            $payment->apt_amount = 1;
            $payment->patient_id = $patient->id;
            $payment->patient_user_id = $appointment->patient_user_id;
            $payment->identifier = $appointment->identifier;
            $payment->doctor_id = $appointment->doctor_id;
            $payment->doctor_user_id = $doctor->user_id;
            $payment->description = 'Patient '.$appointment->patient->name.' '.$appointment->patient->firstname.' Appointment Payment';
            $payment->paymentmode_id = 3;
            $payment->status = 0;
            $payment->save();
      
            $data['invoice_id'] = $payment->id;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = 1;

            Session::put('invoice_id', $payment->id);
            Session::put('apt_id', $appointment->id);
      
            //$provider = new ExpressCheckout();
      
            $response = $this->provider->setExpressCheckout($data);
      
            $response = $this->provider->setExpressCheckout($data, true);

            //dd($data);
      
            return redirect($response['paypal_link']);

        }elseif($request->payment_mode == 4){

            //return view('payments.stripe', compact('doctor', 'patient', 'appointment'));

            return redirect()->route('stripe', $appointment->id);
        }

        /*$notification = new Notification();
        $notification->sender_id = auth()->user()->id;
        $notification->body = "Le patient $appointment->name $appointment->firstanme a fait une demande de rendez-vous pour le $appointment->date_apt!";
        //$notification->route = route('appointments.show', $appointment->id);
        $notification->route = route('doctor-pendingappointments');
        $notification->status = 0;
        $notification->receiver_id = $appointment->doctorUser_id;
        $notification->save();*/

        //Redirect to the users.index view and display message
        //return redirect()->route('booking.success', ['appointment'=>$appointment->id,'doctor'=>$doctor->id]);
        //route('remindHelper',['event'=>$eventId,'user'=>$userId]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id); //Get appointment with specified 
        //$user = User::findOrFail($appointment->user_id);
        //$appointment->profession = $user->profession;
        //$appointment->date = Carbon::parse($appointment->date_apt);
        //$doctor = Doctor::findOrFail($appointment->doctor_id);
        //$service = $doctor->department_name;

        return view('patients.appointments.show', compact('appointment')); //pass appointment data to view

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id); //Get appointment with specified id

        $departments = Department::all();

        return view('appointments.edit', compact('appointment', 'departments')); //pass appointment data to view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $this->validate($request, [
            //'department_id' => 'required',
            'doctor_id' => 'required',
            'schedule_id' => 'required',
            //'begin_time' => 'required',
            'date_apt' => 'required',
            'user_id' => 'required',
        ]);

        $patient = Patient::where('user_id', $request->input('user_id'))->first();

        $appointment->patient_user_id = $request->input('user_id');

        $appointment->patient_id = $patient->id;

        $appointment->date_apt = $request->input('date_apt');

        $appointment->schedule_id = $request->input('schedule_id');

        $schedule = Schedule::findOrFail($request->input('schedule_id'));

        $appointment->begin_time = $schedule->begin_time;

        $appointment->end_time = $schedule->end_time; 

        $appointment->identifier = $this->unique_code(9);

        //$appointment->department_id = $request->input('department_id');
        
        //$department = Department::findOrFail($appointment->department_id);

        //$appointment->department_name = $department->name;

        $appointment->apt_amount = 5000;

        $appointment->doctor_id = $request->input('doctor_id');

        $appointment->note = $request->input('note');

        $doctor = Doctor::findOrFail($appointment->doctor_id);

        $appointment->doctor_user_id = $doctor->user_id;

        $appointment->speciality_id = $doctor->speciality_id;

        $appointment->status = 0;

        $historique = new History();
        $historique->action = 'Update';
        $historique->table = 'Appointment';
        $historique->user_id = auth()->user()->id;

        $appointment->save();

        $historique->save();

        //Redirect to the users.index view and display message
        return redirect()->route('appointments.index')
            ->with('success',
             'Votre rendez-vous a mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id); //Get appointment with specified id

        $historique = new Historique();
        $historique->action = 'Delete';
        $historique->table = 'Appointment';
        $historique->user_id = auth()->user()->id;

        $appointment->delete();
        $historique->save();

        return redirect()->route('appointments.index')
            ->with('success',
             'Rendez-vous supprimé avec succès.');
    }
}
