<?php

namespace App\Http\Controllers;

use App\Signature;
use App\User;
use App\Doctor;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AdminSignatureController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth:admin']); //supAdmin middleware lets only users with a //specific permission permission to access these resources
    }

	public function index()
    {
        //$user_id = auth()->user()->id;

        $signatures = Signature::where('status', 1)
                        ->get();

        foreach ($signatures as $signature) {
            # code...
           $user = User::findOrFail($signature->user_id);

           $signature->author_image = $user->profile_picture;

           $signature->author = $user->name;

           //$signature->author = $user->name.' '.$user->firstname;
        }

        return view('admin.signatures.pending')->with('signatures', $signatures);
    }


    public function pending()
    {
        //$user_id = auth()->user()->id;

        $signatures = Signature::where('status', 0)
                        ->get();

        foreach ($signatures as $signature) {
            # code...
           $user = User::findOrFail($signature->user_id);

           $signature->author_image = $user->profile_picture;

           $signature->author = $user->name;

           //$signature->author = $user->name.' '.$user->firstname;
        }

        return view('admin.signatures.pending')->with('signatures', $signatures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$doctors = Doctor::all();

        return view('admin.signatures.create', compact('doctors'));
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
        	'doctor_id' =>'required',
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
        $signature->doctor_id = $request->doctor_id;
        $doctor = Doctor::findOrFail($request->doctor_id);
        $signature->user_id = $doctor->user_id;
        $signature->status = $request->status;
        $signature->approuved_by = auth()->user()->id;
        $signature->approuved_by_name = auth()->user()->name.' '.auth()->user()->firstname;
        
        
        $signature->save();

        if($request->status == 0){

        	return redirect()->route('signatures.index')
            ->with('success',
             'Signature upload successfully.');

        }else{
        	return redirect()->route('signatures.index')
            ->with('success',
             'Signature upload as pending.');
        }

        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $signature = Signature::findOrFail($id); //Get signature specified by id

        return view('admin.signatures.show', compact('signature'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $signature = Signature::findOrFail($id); //Get signature specified by id

        return view('admin.signatures.edit', compact('signature'));

    }


    public function update(Request $request, $id)
    {
        $signature = Signature::findOrFail($id);

        $signature->status = $request->status;
        $signature->approuved_by = auth()->user()->id;
        $signature->approuved_by_name = auth()->user()->name.' '.auth()->user()->firstname;
        
        $signature->save();

        /*return redirect()->route('signatures.index')
            ->with('success',
             'Signature updated successfully.');*/
    }
}
