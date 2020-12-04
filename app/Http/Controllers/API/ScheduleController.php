<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Schedule as ScheduleResource;
use Carbon\Carbon;
use App\Doctor;
use App\User;
use App\Schedule;
use App\History;
use Validator;

class ScheduleController extends BaseController
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            //'speciality_id' => 'required',
            //'doctor_id' => 'required',
            'day_num'  => 'required',
            'begin_time' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $schedule = new Schedule();

        $time = $request->input('begin_time');

        $base = Carbon::parse($time);

        $end = $base->copy()->addMinutes(30)->toTimeString();

        $schedule->day_num  = $request->input('day_num');

        $schedule->begin_time = $request->input('begin_time');

        $schedule->end_time = $end; 
        
        $schedule->doctor_userid = auth()->user()->id;

        $doctor = Doctor::where('user_id', auth()->user()->id)->first();

        $schedule->doctor_id = $doctor->id;
        
        $schedule->status = 1;

        $historique = new History();
        $historique->action = 'Create';
        $historique->table = 'Schedule';
        $historique->user_id = auth()->user()->id;

        
        $schedule->save();
        $historique->save();

        return $this->sendResponse($schedule, 'Schedule added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
  
        if (is_null($schedule)) {
            return $this->sendError('Schedule not found.');
        }
   
        return $this->sendResponse($schedule, 'Schedule retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            //'speciality_id' => 'required',
            //'doctor_id' => 'required',
            'day_num'  => 'required',
            'begin_time' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $time = $request->input('begin_time');

        $base = Carbon::parse($time);

        $end = $base->copy()->addMinutes(30)->toTimeString();

        $schedule->day_num  = $request->input('day_num');

        $schedule->begin_time = $request->input('begin_time');

        $schedule->end_time = $end; 
        
        $schedule->doctor_userid = auth()->user()->id;

        $doctor = Doctor::where('user_id', auth()->user()->id)->first();

        $schedule->doctor_id = $doctor->id;
        
        $schedule->status = 1;

        $historique = new History();
        $historique->action = 'Update';
        $historique->table = 'Schedule';
        $historique->user_id = auth()->user()->id;

        
        $schedule->save();
        $historique->save();

        return $this->sendResponse($schedule, 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
   
        return $this->sendResponse([], 'Schedule deleted successfully.');
    }
}
