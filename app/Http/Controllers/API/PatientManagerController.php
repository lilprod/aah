<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\Doctor;
use App\History;
use App\Appointment;
use App\Schedule;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PatientManagerController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function patientPendingapts()
    {
        $appointments = auth()->user()->patientPendingapts();

        foreach ($appointments as $appointment) {
            # code...
            
            $appointment['doctor_name'] = $appointment->doctor->name;

            $appointment['doctor_firstname'] = $appointment->doctor->firstname;

            $appointment['doctor_email'] = $appointment->doctor->email;

            $appointment['doctor_phone_number'] = $appointment->doctor->phone_number;

            $appointment['doctor_speciality'] = $appointment->doctor->speciality->title;

            $appointment['doctor_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->doctor->profile_picture;

        }

        return $this->sendResponse($appointments, 'Appointments retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function patientUpcomingapts()
    {
        $appointments = auth()->user()->patientUpcomingapts();

        foreach ($appointments as $appointment) {
            # code...
            
            $appointment['doctor_name'] = $appointment->doctor->name;

            $appointment['doctor_firstname'] = $appointment->doctor->firstname;

            $appointment['doctor_email'] = $appointment->doctor->email;

            $appointment['doctor_phone_number'] = $appointment->doctor->phone_number;

            $appointment['doctor_speciality'] = $appointment->doctor->speciality->title;

            $appointment['doctor_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->doctor->profile_picture;

        }

        return $this->sendResponse($appointments, 'Appointments retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function patientArchivedapts()
    {
        $appointments = auth()->user()->patientArchivedapts();

        foreach ($appointments as $appointment) {
            # code...
            
            $appointment['doctor_name'] = $appointment->doctor->name;

            $appointment['doctor_firstname'] = $appointment->doctor->firstname;

            $appointment['doctor_email'] = $appointment->doctor->email;

            $appointment['doctor_phone_number'] = $appointment->doctor->phone_number;

            $appointment['doctor_speciality'] = $appointment->doctor->speciality->title;

            $appointment['doctor_profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$appointment->doctor->profile_picture;

        }

        return $this->sendResponse($appointments, 'Appointments retrieved successfully.');
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

        $success = true;

        return $this->sendResponse($success, 'Doctor marked as Favourite');
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

        $success = true;

        return $this->sendResponse($success, 'Doctor marked as Unfavourite');
    }

    /**
     * Get all favorite doctors by user
     *
     * @return Response
     */
    public function myfavourites()
    {
        $myFavorites = Auth::user()->favorites;

        return $this->sendResponse($myFavorites, 'Favourites Doctors retreive sucessfully!');
    }


    public function postSetting(Request $request) {

        $user = User::findOrFail(auth()->user()->id);

        $patient = Patient::where('user_id', $user->id)->first();
        
        //Validate these fields
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            'address' => 'nullable',
            //'email' => 'nullable|email|unique:users,email,'.$user->id,
            'gender' => 'required',
            'birth_date' => 'required',
            'place_birth' => 'nullable',
            'blood_group' => 'required',
            'rhesus' => 'required',
            'marital_status' => 'required',
            'profile_picture' => 'nullable',
            //'nationality' => 'nullable',
            //'ethnic_group' => 'nullable',
            //'profession' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $patient->name = $request->input('name');
        $patient->firstname = $request->input('firstname');
        //$patient->email = $request->input('email');
        $patient->gender = $request->input('gender');
        $patient->marital_status = $request->input('marital_status');
        
        if(!empty($request->input('profile_picture'))){
            
            $patient->profile_picture = $request->input('profile_picture');
        }
        //$patient->profile_picture = $fileNameToStore;
        //$patient->phone_number = $request->input('phone_number');
        $patient->address = $request->input('address');
        $patient->birth_date = $request->input('birth_date');
        $patient->place_birth = $request->input('place_birth');
        //$patient->nationality = $request->input('nationality');
        //$patient->ethnic_group = $request->input('ethnic_group');
        $patient->blood_group = $request->input('blood_group');
        $patient->rhesus = $request->input('rhesus');
        //$patient->profession = $request->input('profession');

        $patient->status = 1;

        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        //$user->email = $request->input('email');
        if(!empty($request->input('profile_picture'))){

            $user->profile_picture = $request->input('profile_picture');
        }
        //$user->profile_picture = $fileNameToStore;
        //$user->phone_number = $request->input('phone_number');
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

        $success = true;

        // Send response
        return $this->sendResponse($success, 'Profil édité avec succès.');

    }

     /**
     * Rating a particular doctor
     *
     * @param  Doctor $doctor
     * @return Response
     */
    public function rating(Request $request) {

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'user_id' => 'required',
            'rating' => 'required',
            'body' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $doctor = Doctor::findOrFail($request->doctor_id);

        $rating = $request->rating;

        $body = $request->body;

        $author = User::findOrFail($request->user_id);

        $doctor->createRating($rating, $author, $body);
        
        return $this->sendResponse($doctor, 'Doctor rate sucessfully!');
    }

    /**
     * Check doctor availability
     *
     * @return Response
     */
    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'schedule_id' => 'required',
            'date' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $doctor =  $request->get('doctor_id');
        //$department = $request->get('department');
        $schedule = Schedule::findOrFail($request->get('schedule_id'));

        $date =  $request->get('date');

        if ($date != '') {

            $appointments = Appointment::where('doctor_id', $doctor)
                                        ->where('date_apt', $date)
                                        ->where('begin_time', $schedule->begin_time)
                                        ->get();
 
            if (count($appointments) > 0) {

                return $this->sendResponse($appointments, 'Doctor is available at these period!');
            }
        }
         
        $response = [
            'success' => false,
            'data'    => [],
            'message' =>'Doctor is not available!',
        ];

        return response()->json($response, 200);
        
    }

    public function getSchedules(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'schedule_id' => 'required',
            'date' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $day_num = 0;

        $check = Carbon::parse($request->date);

        $day_num = date('N', strtotime($check));

        $appointments = Appointment::where('doctor_id', $request->doctor_id)
                                    ->where('date_apt', $request->date)
                                    ->pluck('schedule_id');

        $schedules = Schedule::where('doctor_id', $request->doctor_id)
                              ->where('day_num', $day_num)
                              ->whereNotIn('id', $appointments)
                              ->get();

        if($schedules){

            return $this->sendResponse($schedules, 'Doctor\'s availability time
');
        }

        return $this->sendResponse([], 'No availability time for this Doctor!');
    }
}
