<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prescription;
use App\Patient;
use App\Doctor;
use App\Appointment;
use App\User;
use App\History;
use App\PrescribedDrugs;
use App\Drug;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prescriptions = Prescription::all();

        return view('doctors.prescriptions.index')->with('prescriptions', $prescriptions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('doctors.prescriptions.create');
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
            //'type_id' => 'required',
            'doctor_id' => 'required',
            'patient_id' => 'required',
        ]);

        $prescription = new Prescription();
        $data = $request->all();

        //dd($data);
        //$prescription->prescriptionType_id = $request->input('prescriptionType_id');
        $prescription->prescriptionType_id = 1;
        $prescription->chief_complains = $request->input('chief_complains');
        $prescription->on_examinations = $request->input('on_examinations');
        $prescription->provisional_diagnosis = $request->input('provisional_diagnosis');
        $prescription->differential_diagnosis = $request->input('differential_diagnosis');
        $prescription->lab_workup = $request->input('lab_workup');
        $prescription->advices = $request->input('advices');
        $prescription->next_visit = $request->input('next_visit');

        $prescription->appointment_id = $request->input('appointment_id');

        $apt = Appointment::findOrFail($prescription->appointment_id);
        $prescription->identifier = $apt->identifier;
        //$prescription->reason = $request->input('reason');
        //$prescription->height = $request->input('height');
        //$prescription->weight = $request->input('weight');
        //$prescription->pulse = $request->input('pulse');
        //$prescription->blood_pressure = $request->input('blood_pressure');
        //$prescription->quantity_med = 0;

        $prescription->patient_id = $request->input('patient_id');
        $patient = Patient::findOrFail($prescription->patient_id);
        $prescription->patient_userid = $patient->user_id;

        //$birthday = new DateTime($patient->birth_date);
        //$currentDate = new DateTime(date("Y-m-d"));
        //$interval = $birthday->diff($currentDate);

        //$prescription->age = $interval->format('%Y');
        $prescription->doctor_id = $request->input('doctor_id');
        $doctor = Doctor::findOrFail($prescription->doctor_id);
        $prescription->doctor_userid = $doctor->user_id;
        
        $prescription->save();
        
        $i = 0;

        foreach($data['drug_id'] as $item){
            
            $drugprescribed = Drug::findOrFail($item);
            
            $prescribeddrug = new PrescribedDrugs();

            $prescribeddrug->drug_id = $item;
            $prescribeddrug->drug_name = $drugprescribed->name;
            $prescribeddrug->prescription_id = $prescription->id;
            $prescribeddrug->patient_id = $prescription->patient_id;
            $prescribeddrug->doctor_id = $prescription->doctor_id;
            $prescribeddrug->doctor_userid = $prescription->doctor_userid;
            $prescribeddrug->patient_userid = $prescription->patient_userid;
            $prescribeddrug->drugtype_id = $drugprescribed->type_id;
            $prescribeddrug->appointment_id = $prescription->appointment_id;
            $prescribeddrug->quantity = $data['quantity'][$i];
            $prescribeddrug->strength = $data['strength'][$i];
            //$prescribeddrug->dose = $data['dose'][$i];
            $prescribeddrug->duration = $data['duration'][$i];
            //$prescribeddrug->advice = $data['advice'][$i];
            if (isset($data['morning'][$i])) {
                $prescribeddrug->morning = $data['morning'][$i];
            }

            if (isset($data['afternoon'][$i])) {
                $prescribeddrug->afternoon = $data['afternoon'][$i];
            }

            if (isset($data['evening'][$i])) {
               $prescribeddrug->evening = $data['evening'][$i];
            }

            if (isset($data['night'][$i])) {
                $prescribeddrug->night = $data['night'][$i];
            }
            //$prescribeddrug->medecine_family = $drugprescribed->medecine_family;
            //$prescribeddrug->form = $drugprescribed->form;
            //$prescribeddrug->dosage = $drugprescribed->dosage;
            //$prescribeddrug->presentation = $drugprescribed->presentation;
            //$prescribeddrug->observation= $drugprescribed->observation;
            $prescribeddrug->save();

            $i++;
            $n = $i;
        }

        //$prescription = Prescription::findOrFail($prescription->id);
        //$prescription->quantity_med = $n;

        $historique = new History();
        $historique->action = 'Create';
        $historique->table = 'Prescription';
        $historique->user_id = auth()->user()->id;

        $prescription->save();
        $historique->save();

        //Redirect to the users.index view and display message
        return redirect()->route('dashboard')
            ->with('success',
             'New Prescription added successfuly!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::findOrFail($id);

        $prescribeddrugs = $prescription->prescribeddrugs;

        return view('prescriptions.show', compact('prescription', 'prescribeddrugs'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
