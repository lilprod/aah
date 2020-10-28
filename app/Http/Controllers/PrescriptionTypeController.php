<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrescriptionType;

class PrescriptionTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']); //supAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prescriptiontypes = PrescriptionType::all(); //Get all prescriptiontypes

        return view('admin.prescriptiontypes.index')->with('prescriptiontypes', $prescriptiontypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.prescriptiontypes.create');
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
            'title' => 'required|max:120',
            'description' => 'nullable',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $prescriptiontype = new PrescriptionType(); //Get prescriptiontype specified by id

        $prescriptiontype->title = $request->input('title');
        $prescriptiontype->description = $request->input('description');

        $prescriptiontype->save();

        return redirect()->route('prescriptiontypes.index')
            ->with('success',
             'Prescription Type added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescriptiontype = PrescriptionType::findOrFail($id);

        return view('admin.prescriptiontypes.show', compact('prescriptiontype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prescriptiontype = PrescriptionType::findOrFail($id);

        return view('admin.prescriptiontypes.edit', compact('prescriptiontype'));
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
        $this->validate($request, [
            'title' => 'required|max:120',
            'description' => 'nullable',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $prescriptiontype = PrescriptionType::findOrFail($id); //Get prescriptiontype specified by id

        $prescriptiontype->title = $request->input('title');
        $prescriptiontype->description = $request->input('description');

        $prescriptiontype->save();

        return redirect()->route('prescriptiontypes.index')
            ->with('success',
             'Prescription Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prescriptiontype = PrescriptionType::findOrFail($id);

        $prescriptiontype->delete();

        return redirect()->route('prescriptiontypes.index')
            ->with('success',
             'Prescription Type deleted successfully.');
    }
}
