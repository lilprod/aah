<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Post;
use Validator;
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
use App\Schedule;
use App\Prescription;
use App\DrugType;
use App\PrecribedDrug;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;


class DoctorManagerController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myposts()
    {
        $posts = auth()->user()->myposts();

        foreach ($posts as $post) {
            # code...
            $post['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$post->cover_image;

            $post['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.auth()->user()->profile_picture;

            $post['author']= auth()->user()->name;

            $post['category_title'] = $post->category->title;
        }

        return $this->sendResponse($posts, 'Posts retrieved successfully.');

        //return $this->sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function myprescriptions()
    {
        $precriptions = auth()->user()->doctorprescriptions();

        return $this->sendResponse($precriptions, 'Precriptions retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mydraftsposts()
    {
        $posts = auth()->user()->mydraftsposts();

        foreach ($posts as $post) {
            # code...
            $post['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$post->cover_image;

            $post['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.auth()->user()->profile_picture;

            $post['author']= auth()->user()->name;

            $post['category_title'] = $post->category->title;
        }

        return $this->sendResponse($posts, 'Posts retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myactivatedposts()
    {
        $posts = auth()->user()->myactivatedposts();

        foreach ($posts as $post) {
            # code...
            $post['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$post->cover_image;

            $post['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.auth()->user()->profile_picture;

            $post['author']= auth()->user()->name;

            $post['category_title'] = $post->category->title;
        }

        return $this->sendResponse($posts, 'Posts retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function doctorPendingapts()
    {
        $appointments = auth()->user()->doctorPendingapts();

        foreach ($appointments as $appointment) {
            # code...
            
            $appointment['patient_name'] = $appointment->patient->name;

            $appointment['patient_firstname'] = $appointment->patient->firstname;

            $appointment['patient_email'] = $appointment->patient->email;

            $appointment['patient_phone_number'] = $appointment->patient->phone_number;

            $appointment['patient_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->patient->profile_picture;

        }

        return $this->sendResponse($appointments, 'Appointments retrieved successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doctorTodayapts()
    {
        $appointments = auth()->user()->doctorTodayapts();

        foreach ($appointments as $appointment) {
            # code...

            $appointment['patient_name'] = $appointment->patient->name;

            $appointment['patient_firstname'] = $appointment->patient->firstname;

            $appointment['patient_email'] = $appointment->patient->email;

            $appointment['patient_phone_number'] = $appointment->patient->phone_number;

            $appointment['patient_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->patient->profile_picture;

        }

        return $this->sendResponse($appointments, 'Appointments retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function doctorUpcomingapts()
    {
        $appointments = auth()->user()->doctorUpcomingapts();

        foreach ($appointments as $appointment) {
            # code...

            $appointment['patient_name'] = $appointment->patient->name;

            $appointment['patient_firstname'] = $appointment->patient->firstname;

            $appointment['patient_email'] = $appointment->patient->email;

            $appointment['patient_phone_number'] = $appointment->patient->phone_number;

            $appointment['patient_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->patient->profile_picture;

        }

        return $this->sendResponse($appointments, 'Appointments retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function doctorArchivedapts()
    {
        $appointments = auth()->user()->doctorArchivedapts();

        foreach ($appointments as $appointment) {
            # code...

            $appointment['patient_name'] = $appointment->patient->name;

            $appointment['patient_firstname'] = $appointment->patient->firstname;

            $appointment['patient_email'] = $appointment->patient->email;

            $appointment['patient_phone_number'] = $appointment->patient->phone_number;

            $appointment['patient_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->patient->profile_picture;

        }

        return $this->sendResponse($appointments, 'Appointments retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function take(Appointment $appointment)
    {
        $appointment->status = 1;

        $patient = Patient::findOrFail($appointment->patient_id);

        $doctor = Doctor::findOrFail($appointment->doctor_id);

        $doctor->patients()->attach($patient->id, ['status' => 1]);

        $appointment->save();

        return $this->sendResponse($appointment, 'Appointment confirmation saved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archivedApt(Appointment $appointment)
    {
        $appointment->status = 2;

        $appointment->save();

        return $this->sendResponse($appointment, 'Appointment Cancelled!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function start(Appointment $appointment)
    {
        $appointment['drugs'] = Drug::all();

        return $this->sendResponse($appointment, 'Appointment start successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function finish(Appointment $appointment)
    {
        $appointment->status = 3;

        $appointment->save();

        return $this->sendResponse($appointment, 'Appointment closed successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function myschedules() {

        //$myschedules = auth()->user()->myschedules();

        $day_nums = [1,2,3,4,5,6,7];
        
        $days = [   0 => '1',
                    1 => '2',
                    2 => '3', 
                    3 => '4', 
                    4 => '5', 
                    5 => '6', 
                    6 => '7'
                ];

        $i = 0;

        foreach ($day_nums as $day_num) {
                # code...
                $schedules[$i] = Schedule::where('day_num', $day_num)
                                    ->where('doctor_userid', auth()->user()->id)
                                    ->get();
                $i++;
        }
        
        $myschedules = collect($days)->zip($schedules)->transform(function ($values) {
            return [
                'day' => $values[0],
                'schedules' => $values[1],
            ];
        });
        
        return $this->sendResponse($myschedules, 'Schedules retrieved successfully.');
    }


    public function postSetting(Request $request) {

        $user = User::findOrFail(auth()->user()->id);

        $doctor = Doctor::where('user_id', $user->id)->first();

        $data = $request->all();
        //Validate these fields
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            //'email' => 'nullable|email|unique:users,email,'.$user->id,
            //'phone_number' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'place_birth' => 'nullable',
            'address' => 'nullable',
            'biography' => 'nullable',
            'profile_picture' => 'nullable',
            'speciality_id' => 'required',
            'country' => 'required',
            'region' => 'required',
            'city' => 'required',
            //'marital_status' => 'required',
            //'nationality' => 'required',
            //'profession' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $doctor->name = $request->input('name');
        $doctor->firstname = $request->input('firstname');
        //$doctor->email = $request->input('email');
        $doctor->gender = $request->input('gender');
        //$doctor->marital_status = $request->input('marital_status');
        
        if(!empty($request->input('profile_picture'))){
            
            $doctor->profile_picture = $request->input('profile_picture');
        }
        //$doctor->phone_number = $request->input('phone_number');
        $doctor->address = $request->input('address');
        $doctor->region = $request->input('region');
        $doctor->country = $request->input('country');
        $doctor->city = $request->input('city');
        $doctor->exercice_place = $request->input('city');
        $doctor->birth_date = $request->input('birth_date');
        $doctor->place_birth = $request->input('place_birth');
        $doctor->biography = $request->input('biography');
        $doctor->speciality_id = $request->input('speciality_id');
        $doctor->status = 1;
        //$doctor->nationality = $request->input('nationality');
        //$doctor->profession = $request->input('profession');

        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        //$user->phone_number = $request->input('phone_number');
        //$user->gender = $request->input('gender');
        //$user->birth_date = $request->input('birth_date');
        $user->address = $request->input('address');
        //$user->email = $request->input('email');
        if(!empty($request->input('profile_picture'))){
            
            $user->profile_picture = $request->input('profile_picture');
        }
        
        /*if($data['clinic_name'] != ''){
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
        }*/        

        //$i = 0;
        //$j = 0;
        //$k = 0;

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

        $success = true;

        // Send response
        return $this->sendResponse($success, 'Profil édité avec succès.');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myMondayschedules()
    {
        $myMondayschedules = auth()->user()->myMondayschedules();

        return $this->sendResponse($myMondayschedules, 'Docotr Monday Schedules retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myTuesdayschedules()
    {
        $myTuesdayschedules = auth()->user()->myTuesdayschedules();

        return $this->sendResponse($myTuesdayschedules, 'Doctor Monday Schedules retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myWednesdayschedules()
    {
        $myWednesdayschedules = auth()->user()->myWednesdayschedules();

        return $this->sendResponse($myWednesdayschedules, 'Doctor Wednesday Schedules retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myThursdayschedules()
    {
        $myThursdayschedules = auth()->user()->myThursdayschedules();

        return $this->sendResponse($myThursdayschedules, 'Doctor Thursday Schedules retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myFridayschedules()
    {
        $myFridayschedules = auth()->user()->myFridayschedules();

        return $this->sendResponse($myFridayschedules, 'Doctor Friday Schedules retrieved successfully.');
    }  
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */                  
    public function mySaturdayschedules()
    {
        $mySaturdayschedules = auth()->user()->mySaturdayschedules();

        return $this->sendResponse($mySaturdayschedules, 'Doctor Saturday Schedules retrieved successfully.');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function mySundayschedules()
    {
       $mySundayschedules = auth()->user()->mySundayschedules();

        return $this->sendResponse($mySundayschedules, 'Doctor Sunday Schedules retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function myAppointments() {

        //$upcomapts = auth()->user()->doctorUpcomingapts();
        //$pendingapts = auth()->user()->doctorPendingapts();
        $myallapts = auth()->user()->myallapts();

        return $this->sendResponse($myallapts, 'Appointments retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myPatients() {

        $doctor = Doctor::where('user_id', auth()->user()->id)->first();

        $mypatients = $doctor->patients;
        
        return $this->sendResponse($mypatients, 'Patients retrieved successfully.');
    }


}
