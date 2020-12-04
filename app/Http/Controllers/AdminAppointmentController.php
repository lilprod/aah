<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Speciality;
use App\Doctor;
use App\History;
use App\Notification;
use App\Patient;
use App\Schedule;
use App\User; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminAppointmentController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth:admin']);
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

        return view('admin.appointments.index')->with('appointments', $appointments);
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

        $historique = new History();
        $historique->action = 'Delete';
        $historique->table = 'Appointment';
        $historique->user_id = auth()->user()->id;

        $appointment->delete();
        $historique->save();

        return redirect()->route('admin_appointments_delete')
            ->with('success',
             'Rendez-vous supprimé avec succès.');
    }
}
