<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Doctor;
use App\User;
use App\Schedule;
use App\History;

class ScheduleController extends Controller
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
       /* $check = Carbon::now()->addHours($heure_retrait);

        if((date('N', strtotime($check)) >= 7)){
            $date = Carbon::parse($check);
            $order->delivery_date = $date->addDays(1);
        }else{
            $order->delivery_date = Carbon::parse($check);
        }*/

        $schedulesMonday = Schedule::where('day_num', 1)
                                    ->where('doctor_userid', auth()->user()->id)
                                    ->get();

        $schedulesTuesday = Schedule::where('day_num', 2)
                                    ->where('doctor_userid', auth()->user()->id)
                                    ->get();

        $schedulesWednesday = Schedule::where('day_num', 3)
                                        ->where('doctor_userid', auth()->user()->id)
                                        ->get();

        $schedulesThursday = Schedule::where('day_num', 4)
                                        ->where('doctor_userid', auth()->user()->id)
                                        ->get();

        $schedulesFriday = Schedule::where('day_num', 5)
                                        ->where('doctor_userid', auth()->user()->id)
                                        ->get();

        $schedulesSaturday = Schedule::where('day_num', 6)
                                        ->where('doctor_userid', auth()->user()->id)
                                        ->get();

        $schedulesSunday = Schedule::where('day_num', 7)
                                    ->where('doctor_userid', auth()->user()->id)
                                    ->get();

        return view('doctors.schedules.index', compact('schedulesMonday', 'schedulesTuesday', 'schedulesWednesday', 'schedulesThursday', 'schedulesFriday', 'schedulesSaturday', 'schedulesSunday'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {

        $data = $request->all();

        $i = 0;

        foreach($data['begin_time'] as $item){

            $schedule = new Schedule();

            $schedule->day_num = $request->input('day_num');

            $schedule->begin_time = $item;
            $schedule->end_time = $data['end_time'][$i];

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

            $i++;
        }

        return redirect()->route('schedules.index')
            ->with('success',
             'Schedule(s) added successfully.');

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
            'day_num'  => 'required',
            'begin_time' => 'required',
        ]);

        $schedule = new Schedule();

        //$time = $request->input('date_apt').' '.$request->input('begin_time');
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

        return redirect()->route('schedules.index')
            ->with('success',
             'Schedule added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);

        return view('doctors.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedules = Schedule::where('day_num', $id)
                    ->where('doctor_userid', auth()->user()->id)
                    ->get();

        return view('doctors.schedules.edit', compact('schedules', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function modif(Request $request)
    {
        $data = $request->all();

        $i = 0;

        $schedules = Schedule::where('day_num', $request->day_num)
                              ->where('doctor_userid', auth()->user()->id)
                              ->get();
    
        if(!$schedules->isEmpty()){
            
            DB::table('schedules')->where('day_num', $request->day_num)
                                  ->where('doctor_userid', auth()->user()->id)
                                  ->delete();
        }

        foreach($data['begin_time'] as $item){

            $schedule = new Schedule();

            $schedule->day_num = $request->input('day_num');

            $schedule->begin_time = $item;

            $schedule->end_time = $data['end_time'][$i];

            $schedule->doctor_userid = auth()->user()->id;

            $doctor = Doctor::where('user_id', auth()->user()->id)->first();

            $schedule->doctor_id = $doctor->id;

            $schedule->status = 1;
            
            $schedule->save();

            $i++;
        }

        return redirect()->route('schedules.index')->with('success', 'Schedule(s) updated successfully.');

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
        $schedule = Schedule::findOrFail($id);

        $this->validate($request, [
            //'department_id' => 'required',
            //'doctor_id' => 'required',
            'day_num'  => 'required',
            'begin_time' => 'required',
        ]);

        $time = $request->input('begin_time');
        $base = Carbon::parse($time);
        $end = $base->copy()->addMinutes(30)->toTimeString();

        $schedule->begin_time = $request->input('begin_time');
        $schedule->end_time = $end; 
        $schedule->day_num  = $request->input('day_num');
        
        $schedule->doctor_userid = auth()->user()->id;
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();
        $schedule->doctor_id = $doctor->id;
        $schedule->status = 1;

        $historique = new History();
        $historique->action = 'Update';
        $historique->table = 'Schedule';
        $historique->user_id = auth()->user()->id;

        return redirect()->route('schedules.index')
            ->with('success',
             'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success',
             'Schedule deleted successfully.');
    }
}
