<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 300);

use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\Doctor;
use App\History;
use App\Appointment;
use App\Prescription;
use App\Payment;
use App\PrescribedDrugs;
use App\PrescriptionExam;
use App\Schedule;
use App\Region;
use App\Country;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PatientManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Favorite a particular doctor
     *
     * @param  Doctor $doctor
     * @return Response
     */
    public function favoriteDoctor(Doctor $doctor)
    {
        Auth::user()->favorites()->attach($doctor->id);

        return back();
    }

    /**
     * Unfavorite a particular doctor
     *
     * @param  Doctor $doctor
     * @return Response
     */
    public function unFavoriteDoctor(Doctor $doctor)
    {
        Auth::user()->favorites()->detach($doctor->id);

        return back();
    }

    /**
     * Get all favorite posts by user
     *
     * @return Response
     */
    public function myFavorites()
    {
        $myFavorites = Auth::user()->favorites;

        return view('patients.favourites', compact('myFavorites'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword(){

    	return view('patients.change_password');
    }

    public function updatePassword(Request $request)
    {
        //Validate password fields
        $this->validate($request, [
            //'password' => 'required|min:6|confirmed',
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user_id = auth()->user()->id;
        
        $user = User::findOrFail($user_id); //Get user specified by id

        if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {

            return back()->with('error', 'Your old password is not correct! Please check!');

        } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {

            return back()->with('error', 'Please enter a password which is not similar then current password.');

        } else {
            //User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);

            $user->password = $request->input('new_password');

            $user->save();

            return back()->with('success', 'Password updated successfully.');
        }
        //return redirect('profils')->with('success', 'Mot de passe mis à jour');
    }


    public function uploadCropImage(Request $request)
    {
        $patient = Patient::findOrFail($request->input('patient_id'));

        $user = User::findOrFail($patient->user_id);

        $folderPath = public_path('storage/profile_images/');
 
        $image_parts = explode(";base64,", $request->image);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
 
        $fileNameToStore = uniqid().'.png';
 
        $imageFullPath = $folderPath.$fileNameToStore;
 
        file_put_contents($imageFullPath, $image_base64);
         
        $patient->profile_picture = $fileNameToStore;

        $user->profile_picture = $fileNameToStore;

        $patient->save();

        $user->save();

        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function rating($id) {

        $doctor = Doctor::findOrFail($id);
        
        return view('patients.ratings.create', compact('doctor'));
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function booking($id) {

        $doctor = Doctor::findOrFail($id);
        
        return view('patients.appointments.create', compact('doctor'));
    }

    public function getSchedules(Request $request)
    {
        $day_num = 0;
        $check = Carbon::parse($request->date);
        $day_num = date('N', strtotime($check));

        $appointments = Appointment::where('doctor_id', $request->doctor)
                                    ->where('date_apt', $request->date)
                                    ->pluck('schedule_id');

        $schedules = Schedule::where('doctor_id', $request->doctor)
                              ->where('day_num', $day_num)
                              ->whereNotIn('id', $appointments)
                              ->get();

        return response()->json($schedules);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile($id) {

        $patient = Patient::findOrFail($id);

        $prescriptions = Prescription::orderBy('created_at', 'desc')
                            ->where('patient_id', $id)
                            ->get();

        $payments = Payment::orderBy('created_at', 'desc')
                            ->where('patient_id', $id)
                            ->get();

        $bookings = Appointment::orderBy('created_at', 'desc')
                            ->where('patient_id', $id)
                            ->get();

        $lastbookings = Appointment::orderBy('created_at', 'desc')
                            ->where('patient_id', $id)
                            ->limit(2)
                            ->get();
        
        return view('patients.patient_profile', compact('patient', 'lastbookings', 'bookings', 'prescriptions', 'payments'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setting() {

        $patient = Patient::where('user_id',auth()->user()->id)->first();
    	
    	return view('patients.profile_setting', compact('patient'));
    }

    public function check(Request $request)
    {

        /* $check = Carbon::now()->addHours($heure_retrait);

        if((date('N', strtotime($check)) >= 7)){
            $date = Carbon::parse($check);
            $order->delivery_date = $date->addDays(1);
        }else{
            $order->delivery_date = Carbon::parse($check);
        }*/


        /*$result = DB::table('exams')->whereNotIn('id', function($q){
        $q->select('examId')->from('testresults');
        })->get()*/

        //$users = User::whereNotIn('user_name', $courseUserNames)->select(...)->get();

        //$courseUserNames = BuyCourses::pluck('user_name')->all();

        $doctor =  $request->get('doctor');
        //$department = $request->get('department');
        $schedule = Schedule::findOrFail($request->get('schedule_id'));
        $date =  $request->get('date');
        //$time = $request->get('time');
        //$time = $request->get('date').' '.$request->get('time');
        /* $base = Carbon::parse($time);
        $end = $base->copy()->addMinutes(30)->toTimeString();
        $end_time =Carbon::parse($end); */
        //dd($time);
        if ($date != '') {
            $appointments = Appointment::where('doctor_id', $doctor)
                                        ->where('date_apt', $date)
                                        ->where('begin_time', $schedule->begin_time)
                                        ->get();
            //return $appointment;
            //dd($appointment);
            if (count($appointments) > 0) {
                return 1;
            }
        }
         
        return  0;
        
    }

    //$birthday = new DateTime($user->date_of_birth);
    //$currentDate = new DateTime(date("Y-m-d"));
    //$interval = $birthday->diff($currentDate);

    //$age= $interval->format('%Y');


    public function postSetting(Request $request) {

        $patient = Patient::findOrFail($request->input('patient_id'));

        $user = User::findOrFail($patient->user_id);
        //Validate name, email and password fields
        $this->validate($request, [
            'patient_id' => 'required|max:120',
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            //'email' => 'required|email|unique:users,email,'.$user->id,
            //'phone_number' => 'required',
        ]);

        if ($request->hasfile('profile_picture')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('profile_picture')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('profile_picture')->storeAs('public/profile_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'avatar.jpg';
        }


        
        
        $patient->name = $request->input('name');
        $patient->firstname = $request->input('firstname');
        //$patient->email = $request->input('email');
        $patient->gender = $request->input('gender');
        $patient->marital_status = $request->input('marital_status');
        if ($request->hasfile('profile_picture')) {
            $patient->profile_picture = $fileNameToStore;
        }
        $patient->phone_number = $request->input('phone_number');
        $patient->address = $request->input('address');
        $patient->birth_date = $request->input('birth_date');
        $patient->place_birth = $request->input('place_birth');

        $region = Region::findOrFail($request->input('region'));
        $patient->region = $region->title;

        if($request->input('country') != ''){

           $patient->country = $request->input('country'); 

        }else{

            $patient->country = $request->input('old_country'); 
        }

        if($patient->matricule == ''){
            
            $country = Country::where('title' ,'=', $patient->country)->first();

            $country_code = Str::upper($country->code);

            $date = Carbon::parse($patient->created_at)->toDateString();

            $timestamp = strtotime($date);

            $month = date('m', $timestamp);

            $name = Str::of($patient->name)->substr(0,3)->upper();

            $firstname = Str::of($patient->firstname)->substr(0,1)->upper();

            $patient->matricule = $country_code.date("y").$month.$name.$firstname;
        }
        //$patient->country = $request->input('country');
        $patient->city = $request->input('city');
        //$patient->nationality = $request->input('nationality');
        //$patient->ethnic_group = $request->input('ethnic_group');
        $patient->blood_group = $request->input('blood_group');
        $patient->rhesus = $request->input('rhesus');
        //$patient->profession = $request->input('profession');
        $patient->status = 1;
        //$patient->status = $request->input('status');

        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        //$user->email = $request->input('email');
        if ($request->hasfile('profile_picture')) {
            $user->profile_picture = $fileNameToStore;
        }
        $user->phone_number = $request->input('phone_number');
        //$user->gender = $request->input('gender');
        //$user->birth_date = $request->input('birth_date');
        $user->address = $request->input('address');

        $patient->save();
        $user->save();

        $historique = new History();
        $historique->action = 'Update Patient Profile';
        $historique->table = 'User/Patient';
        $historique->user_id = auth()->user()->id;

        $historique->save();

        //Redirect to the users.index view and display message
        return redirect()->back()->with('success', 'Profile Updated successfully.');

    }


    public function pdfInvoice($id)
    {

        $payment = Payment::findOrFail($id);

        $date = Carbon::now();

        $data = ['payment' => $payment,
                'date' => $date,
        ];

        $pdf = PDF::loadView('patients.appointments.pdf', $data);

        //return $pdf->download('Invoice'.$date.'.pdf');

        return $pdf->stream('Invoice'.$date.'.pdf'); 
    }

    public function pdfexport($id)
    {
        $prescription = Prescription::findOrFail($id); //Find prescription of id = $id
        $doctor = Doctor::findOrFail($prescription->doctor_id);
        $prescribeddrugs = PrescribedDrugs::where('patient_id', '=', $prescription->patient_id)
                                            ->where('prescription_id', '=', $prescription->id)
                                            ->get();
        
        
        $date = Carbon::now();

        $data = ['prescription' => $prescription,
                'prescribeddrugs' => $prescribeddrugs,
                //'service' => $service,
                'date' => $date,
        ];

        $pdf = PDF::loadView('doctors.prescriptions.pdf', $data);

        //return $pdf->download('ordonnance'.$date.'.pdf');

        return $pdf->stream('Prescription'.$date.'.pdf');
    }

    public function postResult(Request $request)
    {
        $this->validate($request, [
            'prescription_id' => 'required',
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'examination_picture' => 'required',
            'examination_picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
            //'examination_picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $examination = new Examination();
        $examination->prescription_id = $request->input('prescription_id');
        $prescription = PrescriptionExam::findOrFail($examination->prescription_id);
        $prescription->status = 1;
        $examination->prescription = $prescription->prescription;
        //$examination->examination_picture = $fileNameToStore;

        $examination->date = $request->input('date');

        $consultation = Consultation::findOrFail($prescription->consultation_id);

        $examination->consultation_id = $consultation->id;
        $examination->consultation_reason = $consultation->reason;
        $examination->consultation_height = $consultation->height;
        $examination->consultation_weight = $consultation->weight;
        $examination->consultation_pulse = $consultation->pulse;
        $examination->consultation_blood_pressure = $consultation->blood_pressure;
        $examination->diagnostic = $consultation->diagnostic;

        $examination->patient_id = $request->input('patient_id');

        $patient = Patient::findOrFail($examination->patient_id);
        $examination->user_id = $patient->user_id;

        $examination->patient_name = $patient->name;
        $examination->patient_firstname = $patient->firstname;
        $examination->patient_email = $patient->email;
        $examination->patient_phone = $patient->phone_number;
        $examination->patient_address = $patient->address;
        $examination->gender = $patient->gender;
        $examination->birth_date = $patient->birth_date;
        $examination->age = $consultation->age;
        $examination->patient_profession = $patient->profession;

        $examination->doctor_id = $request->input('doctor_id');

        $doctor = Doctor::findOrFail($examination->doctor_id);

        $examination->doctor_name = $doctor->name;
        $examination->doctor_firstname = $doctor->firstname;
        $examination->doctor_email = $doctor->email;
        $examination->doctor_phone = $doctor->phone_number;
        $examination->doctor_address = $doctor->address;
        $examination->doctor_profession = $doctor->profession;
        $examination->doctor_userId = $doctor->user_id;
        
        $examination->status = 0;

        $historique = new Historique();
        $historique->action = 'Create-without-Result';
        $historique->table = 'Examination';
        $historique->user_id = auth()->user()->id;

        $examination->save();
        $prescription->save();
        $historique->save();

        if ($request->hasfile('examination_picture')) {

            foreach ($request->file('examination_picture') as $file) {
                // Get filename with the extension
                $fileNameWithExt = $file->getClientOriginalName();

                // Get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // Get just ext
                $extension = $file->getClientOriginalExtension();

                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;

                // Upload Image
                $path = $file->storeAs('public/examination_files', $fileNameToStore);

                $examimage = new ExamImage();

                $examimage->examination_picture = $fileNameToStore;
                $examimage->examination_id = $examination->id;
                $examimage->patient_id = $request->input('patient_id');
                $examimage->doctor_id = $request->input('doctor_id');
                $examimage->prescription_id = $request->input('prescription_id');

                $examimage->save();
            }
            
        }

        $notification = new Notification();
        $notification->sender_id = auth()->user()->id;
        $notification->body = "Le patient $examination->patient_name $examination->patient_firstanme vous a envoyé le(s) clichet(s) de son examen du $examination->date!";
        $notification->route = route('result.show', $examination->id);
        $notification->status = 0;
        $notification->receiver_id = $doctor->user_id;
        $notification->save();

        //Redirect to the users.index view and display message
        return redirect()->route('dashboard')
            ->with('success',
             'Votre résultat d\'examen a été transmis à votre Medécin avec succès!');
    }
}
