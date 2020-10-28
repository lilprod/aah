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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PatientManagerController extends BaseController
{
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
}
