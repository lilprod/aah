<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Post;
use Validator;
use App\User;
use App\Doctor;
use App\Patient;
use App\History;
use App\Appointment;
use App\Schedule;
use App\Disease;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoctorController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allDoctors()
    {
        $doctors = Doctor::where('status', 1)
                        ->where('speciality_id','<>', '')
        				->get();

        foreach ($doctors as $doctor) {

            $doctor['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$doctor->profile_picture;
            $speciality = $doctor->speciality;
            $speciality['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$speciality->cover_image;
            $doctor['speciality'] = $speciality;
            $doctor['rating'] = $doctor->averageRating;
        }

        return $this->sendResponse($doctors, 'Doctors retrieved successfully.');

        //return $this->sendResponse(PostResource::collection($doctors), 'Doctors retrieved successfully.');
    }


    public function profileDoctor($id){

        $doctor = Doctor::findOrFail($id);
        $doctor['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$doctor->profile_picture;
        $speciality = $doctor->speciality;
        $speciality['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$speciality->cover_image;
        $doctor['speciality'] = $speciality;
        $doctor['rating'] = $doctor->averageRating;

        return $this->sendResponse($doctor, 'Doctor retrieved successfully.');
    }

    public function profilePatient($id){

        $patient = Patient::findOrFail($id);
        $patient['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$patient->profile_picture;

        return $this->sendResponse($patient, 'Patient retrieved successfully.');
    }


    public function filterDoctor(Request $request)
    {
        $params = $request->except('_token');

        //$doctors = Doctor::filter($params)->get();

        $doctors = Doctor::filter($params)->orderByDesc('id')->paginate(10);;

        if (count($doctors) > 0){

            foreach ($doctors as $doctor) {

                $doctor['profile_picture'] = $_ENV['APP_URL'].'/storage/profile_images/'.$doctor->profile_picture;
                $speciality = $doctor->speciality;
                $speciality['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$speciality->cover_image;
                $doctor['speciality'] = $speciality;
                $doctor['rating'] = $doctor->averageRating;
            }

            return $this->sendResponse($doctors, 'Doctors retrieved successfully.');

        }

        return $this->sendResponse([], 'No Doctor found for your query. Try to search again!');
    }


    public function check_slug(Request $request)
    {
        // New version: to generate unique slugs
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return $this->sendResponse($slug, 'Slug of Title.');

        //return response()->json(['slug' => $slug]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function check_disease_slug(Request $request)
    {
        // New version: to generate unique slugs
        $slug = SlugService::createSlug(Disease::class, 'slug', $request->title);

        return $this->sendResponse($slug, 'Slug of Title.');
    }


    public function getSchedules(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            //'schedule_id' => 'required',
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
