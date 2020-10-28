<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\DrugType;

class DrugController extends Controller
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
        $drugs = Drug::all(); //Get all drugs

        return view('admin.drugs.index')->with('drugs', $drugs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drugtypes = DrugType::all(); //Get all drugtypes

        return view('admin.drugs.create', compact('drugtypes'));
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
            'name' => 'required|max:120',
            'generic_name' => 'required',
            'short_note' => 'nullable',
            'drug_type_id' => 'nullable',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $drug = new Drug(); 

        $drug->name = $request->input('name');
        $drug->generic_name = $request->input('generic_name');
        $drug->short_note = $request->input('short_note');
        $drug->drug_type_id = $request->input('drug_type_id');

        $drug->save();

        return redirect()->route('drugs.index')
            ->with('success',
             'Drug added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drug = Drug::findOrFail($id);

        return view('admin.drugs.show', compact('drug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drug = Drug::findOrFail($id);

        $drugtypes = DrugType::all(); //Get all drugtypes

        return view('admin.drugs.edit', compact('drug', 'drugtypes'));
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
        $drug = Drug::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:120',
            'generic_name' => 'required',
            'short_note' => 'nullable',
            'drug_type_id' => 'nullable',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $drug->name = $request->input('name');
        $drug->generic_name = $request->input('generic_name');
        $drug->short_note = $request->input('short_note');
        $drug->drug_type_id = $request->input('drug_type_id');

        $drug->save();

        return redirect()->route('drugs.index')
            ->with('success',
             'Drug updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drug = Drug::findOrFail($id);

        $drug->delete();

        return redirect()->route('drugs.index')
            ->with('success',
             'Drug deleted successfully.');
    }
}
