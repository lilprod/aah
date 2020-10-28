<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DrugType;

class DrugTypeController extends Controller
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
        $drugtypes = DrugType::all(); //Get all drugtypes

        return view('admin.drugtypes.index')->with('drugtypes', $drugtypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.drugtypes.create');
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

        $drugtype = new DrugType(); 

        $drugtype->title = $request->input('title');
        $drugtype->description = $request->input('description');

        $drugtype->save();

        return redirect()->route('drugtypes.index')
            ->with('success',
             'Drug Type added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drugtype = DrugType::findOrFail($id);

        return view('admin.drugtypes.show', compact('drugtype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drugtype = DrugType::findOrFail($id);

        return view('admin.drugtypes.edit', compact('drugtype'));
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
        $drugtype = DrugType::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|max:120',
            'description' => 'nullable',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $drugtype->title = $request->input('title');
        $drugtype->description = $request->input('description');

        $drugtype->save();

        return redirect()->route('drugtypes.index')
            ->with('success',
             'Drug Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drugtype = DrugType::findOrFail($id);

        $drugtype->delete();
        
        return redirect()->route('drugtypes.index')
            ->with('success',
             'Drug Type deleted successfully.');
    }
}
