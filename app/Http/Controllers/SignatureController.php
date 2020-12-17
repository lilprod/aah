<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\Signature;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Doctor::where('user_id', auth()->user()->id)->first();

        $signature = $doctor->signature;

        return view('doctors.signatures.index')->with('signature', $signature); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctor = Doctor::where('user_id',auth()->user()->id)->first();

        return view('doctors.signatures.create', compact('doctor'));
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
            'signature_file' =>'image|required',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        if ($request->hasfile('signature_file')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('signature_file')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('signature_file')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('signature_file')->storeAs('public/signatures', $fileNameToStore);
        } else {
            $fileNameToStore = 'nosignature.jpg';
        }

        $signature = new Signature();

        $signature->signature_file = $fileNameToStore;
        $signature->user_id = auth()->user()->id;
        $signature->doctor_id = $request->doctor_id;
        
        $signature->save();

        return redirect()->route('signatures.index')
            ->with('success',
             'Signature upload successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $signature = Signature::findOrFail($id);

        return view('doctors.signatures.edit', compact('signature'));
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
        $signature = Signature::findOrFail($id);

        $this->validate($request, [
            'signature_file' =>'image|required',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        if ($request->hasfile('signature_file')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('signature_file')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('signature_file')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('signature_file')->storeAs('public/signatures', $fileNameToStore);
        } else {
            $fileNameToStore = 'nosignature.jpg';
        }

        $signature->signature_file = $fileNameToStore;
        $signature->user_id = auth()->user()->id;
        $signature->doctor_id = $request->doctor_id;
        $signature->status = 0;
        
        $signature->save();

        return redirect()->route('signatures.index')
            ->with('success',
             'Signature updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $signature = Signature::findOrFail($id);

        if ($signature->signature_file != 'nosignature.jpg') {
            Storage::delete('public/signatures/'.$signature->signature_file);
        }

        $signature->delete();

        return redirect()->route('signatures.index')
            ->with('success', 'Signature deleted successfully.');
    }
}
