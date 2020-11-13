<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\Drug;
use App\Patient;
use App\History;
use App\Appointment;
use App\Clinic;
use App\ClinicImage;
use App\Education;
use App\Experience;
use App\Award;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorManagerController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews(){

        return view('doctors.reviews');
    }

    public function myInvoices(){

        $payments = auth()->user()->doctorpayments();

        return view('doctors.invoices', compact('payments'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword(){

    	return view('doctors.change_password');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile($id){

        $doctor = Doctor::findOrFail($id);

        return view('doctors.profile', compact('doctor'));
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

    public function take($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->status = 1;

        $patient = Patient::findOrFail($appointment->patient_id);

        $doctor = Doctor::findOrFail($appointment->doctor_id);

        //dd($doctor->id);

        $doctor->patients()->attach($patient->id, ['status' => 1]);

        $appointment->save();


        /*$notification = new Notification();
        $notification->sender_id = auth()->user()->id;
        $notification->body = "Le médecin $appointment->doctor_name $appointment->docor_firstanme a accépté prendre votre rendez-vous du $appointment->date_apt de $appointment->begin_time au $appointment->end_time!";
        $notification->route = route('appointments.show', $appointment->id);
        $notification->status = 0;
        $notification->receiver_id = $appointment->user_id;
        $notification->save();*/

        return redirect()->route('doctor_my_appointments')
            ->with('success', 'Votre confirmation de rendez-vous a été enregistré avec succès!');
    }

    public function takeUp(Request $request)
    {
        $appointment = Appointment::findOrFail($request->get('id'));
        
        $appointment->status = 1;

        $patient = Patient::where('user_id', $appointment->user_id)->first();

        $doctor = Doctor::findOrFail($appointment->doctor_id);
        $patient->doctor_id = $doctor->id;
        $patient->doctor_name = $doctor->name;
        $patient->doctor_firstname = $doctor->firstname;
        $patient->doctor_email = $doctor->email;
        $patient->doctor_gender = $doctor->gender;
        $patient->doctor_phone = $doctor->phone_number;
        $patient->doctor_address = $doctor->address;
        $patient->doctor_profession = $doctor->profession;
        $patient->department_id = $doctor->department_id;
        $patient->department_name = $doctor->department_name;
        $patient->doctor_userId = $doctor->user_id;

        $patient->save();
        $appointment->save();

        /*$notification = new Notification();
        $notification->sender_id = auth()->user()->id;
        $notification->body = "Le médecin $appointment->doctor_name $appointment->docor_firstanme a accépté prendre votre rendez-vous du $appointment->date_apt de $appointment->begin_time au $appointment->end_time!";
        $notification->route = route('appointments.show', $appointment->id);
        $notification->status = 0;
        $notification->receiver_id = $appointment->user_id;
        $notification->save();*/

        //return $appointment;
        return $appointment;
    }


    public function archivedApt(Request $request)
    {
        $appointment = Appointment::findOrFail($request->get('id'));
        $appointment->status = 2;
        $appointment->save();

        return $appointment;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setting() {

        $doctor = Doctor::where('user_id',auth()->user()->id)->first();
    	
    	return view('doctors.profile_setting', compact('doctor'));
    }

    public function postSetting(Request $request) {

        $doctor = Doctor::findOrFail($request->input('doctor_id'));

        $user = User::findOrFail($doctor->user_id);

        $data = $request->all();
        //Validate name, email and password fields
        $this->validate($request, [
            'doctor_id' => 'required|max:120',
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            //'email' => 'required|email|unique:users,email,'.$user->id,
            'phone_number' => 'required',
            //'password' => 'required|min:6|confirmed',
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

        
        $doctor->name = $request->input('name');
        $doctor->firstname = $request->input('firstname');
        //$doctor->email = $request->input('email');
        $doctor->gender = $request->input('gender');
        //$doctor->marital_status = $request->input('marital_status');
        if ($request->hasfile('profile_picture')) {
            $doctor->profile_picture = $fileNameToStore;
        }
        $doctor->phone_number = $request->input('phone_number');
        $doctor->address = $request->input('address');
        $doctor->region = $request->input('region');
        $doctor->country = $request->input('country');
        $doctor->city = $request->input('city');
        $doctor->birth_date = $request->input('birth_date');
        $doctor->place_birth = $request->input('place_birth');
        $doctor->biography = $request->input('biography');
        //$doctor->nationality = $request->input('nationality');
        //$doctor->profession = $request->input('profession');
        //$doctor->status = $request->input('status');

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

        

        if($data['clinic_name'] != ''){
            $clinic = Clinic::where('doctor_id', $doctor->id)->first();

            if($clinic){

                $clinic->name = $request->input('clinic_name');
                $clinic->address = $request->input('clinic_address');
                $clinic->doctor_id = $doctor->id;
                $clinic->doctor_userid = $doctor->user_id;
                $clinic->save();

            }else{

                $clinic = new Clinic();
                $clinic->name = $request->input('clinic_name');
                $clinic->address = $request->input('clinic_address');
                $clinic->doctor_id = $doctor->id;
                $clinic->doctor_userid = $doctor->user_id;
                $clinic->save();
            }
        }
        

        $i = 0;
        $j = 0;
        $k = 0;

        /*if (isset($data['awards'])) {

            foreach($data['awards'] as $row){

                $award = new Award();
                $award->awards = $data['awards'][$i];
                $award->year = $data['year'][$i];
                $award->doctor_id = $doctor->id;
                $award->doctor_user_id = $doctor->user_id;

                $award->save();

                $i++;
            }
        }

        if (isset($data['degree'])) {

            foreach($data['degree'] as $row){

                $education = new Education();
                $education->degree = $data['degree'][$j];
                $education->institute = $data['institute'][$j];
                $education->year_completion = $data['year_completion'][$j];
                $education->doctor_id = $doctor->id;
                $education->doctor_user_id = $doctor->user_id;

                $education->save();

                $j++;
            }
        }

        if (isset($data['exercice_place'])) {

            foreach($data['exercice_place'] as $row){

                $experience = new Experience();
                $experience->exercice_place = $data['exercice_place'][$k];
                $experience->from = $data['from'][$k];
                $experience->to = $data['to'][$k];
                $experience->year_completion = $data['year_completion'][$k];
                $experience->doctor_id = $doctor->id;
                $experience->doctor_user_id = $doctor->user_id;

                $experience->save();

                $k++;
            }
        }*/

        $doctor->save();

        $user->save();

        $historique = new History();
        $historique->action = 'Update Doctor Profile';
        $historique->table = 'User/Doctor';
        $historique->user_id = auth()->user()->id;

        $historique->save();

        //Redirect to the users.index view and display message
        return redirect()->back()->with('success', 'Profile Updated successfully.');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function myAppointments() {

        //$upcomapts = auth()->user()->doctorUpcomingapts();
        //$pendingapts = auth()->user()->doctorPendingapts();
        $myallapts = auth()->user()->myallapts();

        return view('doctors.appointments', compact('myallapts'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function myPatients() {

        $doctor = Doctor::where('user_id', auth()->user()->id)->first();

        $mypatients = $doctor->patients;
        
        return view('doctors.my_patients', compact('mypatients'));
    }

    public function start($id)
    {
        $appointment = Appointment::findOrFail($id);

        $drugs = Drug::all();

        return view('doctors.prescriptions.create', compact('appointment', 'drugs'));
    }

    public function finish($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->status = 3;

        $appointment->save();

        return redirect()->route('doctor_my_appointments')
            ->with('success', 'Appointment closed successfully!');
    }
}
