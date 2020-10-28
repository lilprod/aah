<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Admin;
use App\Doctor;
use App\Patient;
use App\Speciality;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:8'],
            'address' => ['nullable', 'string'],
            //'username' => ['nullable', 'string'],
        ]);
    }


    /*public function showPatientRegisterForm()
    {
        return view('auth.register', ['url' => 'patient']);
    }*/

    public function showDoctorRegisterForm()
    {
        
        $specialities = Speciality::all();

        return view('auth.register_doctor', ['url' => 'doctor', 'specialities' => $specialities ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
         
         $fileNameToStore = 'avatar.jpg';

         $user = User::create([
            'name' => $data['name'],
            'firstname' => $data['firstname'],
            //'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'profile_picture' => 'avatar.jpg',
            //'profile_picture' => $_ENV['APP_URL'].'/storage/profile_images/'.$fileNameToStore,
            'role_id' => 1,
            'is_activated' => 1,
            'lang' => 'FR',
        ]);

        $user->assignRole('Patient');

        $patient = new Patient();
        $patient->name = $data['name'];
        $patient->firstname = $data['firstname'];
        //$patient->username = $data['username'];
        $patient->email = $data['email'];
        $patient->phone_number = $data['phone_number'];
        $patient->address = $data['address'];
        $patient->profile_picture = 'avatar.jpg';
        $patient->user_id = $user->id;
        $patient->status = 1;

        $patient->save();

        return $user;
       
    }

    protected function validatorDoctor(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:8'],
            //'address' => ['required', 'string'],
            //'username' => ['nullable', 'string'],
            //'title' => ['required', 'string'],
            //'gender' => ['required'],
            //'birth_date' => ['required'],
            //'place_birth' => ['required', 'string'],
            //'nationality' => ['required'],
            //'marital_status' => ['required'],
            //'speciality_id' => ['required'],
            'country' => ['required', 'string'],
            'region' => ['required', 'string'],
            'exercice_place' => ['required', 'string'],
        ]);
    }

    protected function createDoctor(Request $request)
    {
        $this->validatorDoctor($request->all())->validate();

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

        $user = User::create([
            'name' => $request['name'],
            'firstname' => $request['firstname'],
            'email' => $request['email'],
            'password' => $request['password'],
            'phone_number' => $request['phone_number'],
            'address' => $request['address'],
            'profile_picture' => $fileNameToStore,
             //'profile_picture' => $_ENV['APP_URL'].'/storage/profile_images/'.$fileNameToStore,
            'role_id' => 2,
            'is_activated' => 0,
            'lang' => 'FR',
        ]);

        $user->assignRole('Doctor');

        $doctor = new Doctor();
        $doctor->name = $request['name'];
        $doctor->firstname = $request['firstname'];
        //$doctor->username = $request['username'];
        $doctor->email = $request['email'];
        $doctor->phone_number = $request['phone_number'];
        //$doctor->address = $request['address'];
        //$doctor->title = $request['title'];
        //$doctor->gender = $request['gender'];
        //$doctor->birth_date = $request['birth_date'];
        //$doctor->place_birth = $data['place_birth'];
        //$doctor->nationality = $data['nationality'];
        //$doctor->speciality_id =$request['speciality_id'];
        $doctor->country =$request['country'];
        $doctor->region =$request['region'];
        $doctor->exercice_place =$request['exercice_place'];

        $doctor->profile_picture = $fileNameToStore;
        //$doctor->profile_picture = $_ENV['APP_URL'].'/storage/profile_images/'.$fileNameToStore;
        $doctor->user_id = $user->id;
        $doctor->status = 0;

        $doctor->save();

        return redirect()->intended('login');
    }
}
