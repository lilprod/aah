<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Speciality;
use Illuminate\Support\Facades\Storage;

class SpecialityController extends Controller
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
        $specialities = Speciality::all(); //Get all specialities

        return view('admin.specialities.index')->with('specialities', $specialities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.specialities.create');
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
            'cover_image' => 'nullable|image|mimes:jpeg,png,bmp,tiff |max:4096',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'Only jpeg, png, bmp,tiff are allowed.'
            ]
        );

        if ($request->hasfile('cover_image')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'cover_image.jpg';
        }

        $speciality = new Speciality(); //Get speciality specified by id

        $speciality->title = $request->input('title');
        $speciality->description = $request->input('description');
        $speciality->cover_image = $fileNameToStore;

        $speciality->save();

        return redirect()->route('specialities.index')
            ->with('success',
             'Speciality added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $speciality = Speciality::findOrFail($id);

        return view('admin.specialities.show', compact('speciality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $speciality = Speciality::findOrFail($id);
        
        return view('admin.specialities.edit', compact('speciality'));
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
        $speciality = Speciality::findOrFail($id); //Get speciality specified by id

        //Validate name, email and password fields
        $this->validate($request, [
            'title' => 'required|max:120',
            'description' => 'nullable',
            'cover_image' => 'image|nullable',
        ]);

        if ($request->hasfile('cover_image')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'cover_image.jpg';
        }

        $speciality->title = $request->input('title');
        $speciality->description = $request->input('description');
        if ($request->hasfile('cover_image')) {
            $speciality->cover_image = $fileNameToStore;
        }

        $speciality->save();

        return redirect()->route('specialities.index')
            ->with('success',
             'Speciality updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a user with a given id and delete
        $speciality = Speciality::findOrFail($id);
        if ($speciality->file != 'cover_image.jpg') {
            Storage::delete('public/cover_images/'.$speciality->file);
        }
        $speciality->delete();

        return redirect()->route('specialities.index')
            ->with('success',
             'Speciality deleted successfully.');
    }
}
