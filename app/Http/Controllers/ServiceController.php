<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Speciality;

class ServiceController extends Controller
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
        $services = Service::all(); //Get all services

        return view('admin.services.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialities = Speciality::all(); //Get all specialities

        return view('admin.services.create', compact('specialities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate title, speciality_id 
        $this->validate($request, [
            'title' => 'required|max:120',
            'description' => 'nullable',
            'speciality_id' => 'required',
            //'cover_image' => 'image|nullable',
        ]);

        $service = new Service();

        $service->title = $request->input('title');

        $service->speciality_id = $request->input('speciality_id');

        $service->description = $request->input('description');

        $service->save();

        return redirect()->route('services.index')
            ->with('success',
             'Service added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);

        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        $specialities = Speciality::all(); //Get all specialities

        return view('admin.services.edit', compact('service', 'specialities'));
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
        $service = Service::findOrFail($id);

        //Validate title, speciality_id 

        $this->validate($request, [
            'title' => 'required|max:120',
            'description' => 'nullable',
            'speciality_id' => 'required',
            //'cover_image' => 'image|nullable',
        ]);


        $service->title = $request->input('title');
        $service->speciality_id = $request->input('speciality_id');
        $service->description = $request->input('description');

        $service->save();

        return redirect()->route('services.index')
            ->with('success',
             'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return redirect()->route('services.index')
            ->with('success',
             'Service deleted successfully.');
    }
}
