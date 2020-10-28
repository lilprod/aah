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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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

        return $this->sendResponse($posts, 'Posts retrieved successfully.');

        //return $this->sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mydraftsposts()
    {
        $posts = auth()->user()->mydraftsposts();

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

        return $this->sendResponse($posts, 'Posts retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function myschedules() {

        $myschedules = auth()->user()->myschedules();

        return $this->sendResponse($myschedules, 'Schedules retrieved successfully.');
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
}
