<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\Speciality;
use App\History;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all doctors and pass it to the view
        $doctors = Doctor::all();
        //$doctors = Doctor::orderby('id', 'asc')->paginate(8);

        return view('admin.doctors.index')->with('doctors', $doctors);
    }

    public function changeUserStatus(Request $request)
    {
        $doctor = Doctor::findOrFail($request->doctor_id);
        $user = User::where('id', $doctor->user_id)->first();
        //$doctor->status = $request->status;
        $user->is_activated = $request->status;

        //$doctor->save();
        $user->save();
  
        return response()->json(['success'=>'User status change successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialities = Speciality::all();

        return view('admin.doctors.create',compact('specialities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name, email and password fields
        $this->validate($request, [
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            'email' => 'required|email|unique:users',
            //'password' => 'required|min:6|confirmed',
            'phone_number' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'profile_picture' => 'image|nullable',
        ]);

        if ($request->hasfile('profile_picture')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('profile_picture')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('profile_picture')->storeAs('public/profile_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'avatar.jpg';
        }

        $doctor = new Doctor();
        $doctor->name = $request->input('name');
        $doctor->firstname = $request->input('firstname');
        $doctor->email = $request->input('email');
        $doctor->gender = $request->input('gender');
        $doctor->profile_picture = $fileNameToStore;
        $doctor->phone_number = $request->input('phone_number');
        $doctor->address = $request->input('address');
        $doctor->birth_date = $request->input('birth_date');
        $doctor->profession = $request->input('profession');
        $doctor->biography = $request->input('biography');
        $doctor->status = $request->input('status');
        $doctor->create_user_id = auth()->user()->id;
        $doctor->speciality_id = $request->input('speciality_id');

        $user = new User();
        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        $user->email = $request->input('email');
        //$user->password = $request->input('password');
        $user->password = 123456;
        //$user->user_profession = $request->input('profession');
        $user->profile_picture = $fileNameToStore;
        $user->phone_number = $request->input('phone_number');
        //$user->gender = $request->input('gender');
        //$user->birth_date = $request->input('birth_date');
        $user->address = $request->input('address');
        $user->role_id = 2;

        $doctor->save();
        $user->save();
        $user->assignRole('Doctor');
        
        $historique = new History();
        $historique->action = 'Create';
        $historique->table = 'User/Doctor';
        $historique->user_id = auth()->user()->id;
        

        $doctor = Doctor::findOrFail($doctor->id);
        $doctor->user_id = $user->id;

        $doctor->save();
        $historique->save();

        //Redirect to the users.index view and display message
        return redirect()->route('doctors.index')
            ->with('success',
             'Nouveau Medécin ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id); //Get doctor with specified id

        return view('admin.doctors.show', compact('doctor')); //pass doctor data to view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id); //Get doctor with specified id

        $specialities = Speciality::all();

        return view('admin.doctors.edit', compact('doctor', 'specialities')); //pass doctor data to view
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
        $doctor = Doctor::findOrFail($id); //Get role specified by id

        //Validate name, email and password fields
        $this->validate($request, [
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            'email' => 'required|email|unique:doctors,email,'.$id,
            //'password' => 'required|min:6|confirmed',
            'phone_number' => 'required',
            'address' => 'required',
            'profile_picture' => 'image|nullable',
        ]);

        if ($request->hasfile('profile_picture')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('profile_picture')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('profile_picture')->storeAs('public/profile_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'avatar.jpg';
        }

        $doctor->name = $request->input('name');
        $doctor->firstname = $request->input('firstname');
        $doctor->email = $request->input('email');
        $doctor->gender = $request->input('gender');
        if ($request->hasfile('profile_picture')) {
            $doctor->profile_picture = $fileNameToStore;
        }
        $doctor->phone_number = $request->input('phone_number');
        $doctor->address = $request->input('address');
        $doctor->speciality_id = $request->input('speciality_id');

        $doctor->birth_date = $request->input('birth_date');
        $doctor->profession = $request->input('profession');
        $doctor->biography = $request->input('biography');
        $doctor->status = $request->input('status');
        $doctor->create_user_id = auth()->user()->id;

        $user = User::findOrFail($doctor->user_id);

        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        $user->email = $request->input('email');
        //$user->password = $request->input('password');
        $user->user_profession = $request->input('profession');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->gender = $request->input('gender');
        $user->birth_date = $request->input('birth_date');
        $user->role_id = 2;
        if ($request->hasfile('profile_picture')) {
            $user->profile_picture = $fileNameToStore;
        }

        $doctor->save();
        $user->save();
        
        $historique = new History();
        $historique->action = 'Update';
        $historique->table = 'User/Doctor';
        $historique->user_id = auth()->user()->id;

        return redirect()->route('doctors.index')
            ->with('success',
             'Docteur '.$doctor->name.' edité avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = User::findOrFail($doctor->user_id);

        if ($user->profile_picture != 'avatar.jpg') {
            Storage::delete('public/profile_images/'.$user->profile_picture);
        }

        $historique = new History();
        $historique->action = 'Delete';
        $historique->table = 'User/Doctor';
        $historique->user_id = auth()->user()->id;

        $user->delete();
        $doctor->delete();
        $historique->save();

        return redirect()->route('doctors.index')
            ->with('success',
             'Docteur supprimé avec succès.');
    }
}
