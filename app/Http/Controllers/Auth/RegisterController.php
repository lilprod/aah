<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Admin;
use App\Doctor;
use App\Patient;
use App\Speciality;
use App\Region;
use App\Country;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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

    /*use RegistersUsers {
     // change the name of the name of the trait's method in this class
     // so it does not clash with our own register method
        register as registration;
    }*/

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = '/verify';

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
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user) ?: redirect('/verify?email='.$request->email.'&phone_number='.$request->phone_number);
    }

    /*public function register(Request $request)
    {
        //Validate the incoming request using the already included validator method
        $this->validator($request->all())->validate();

        // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // Save the registration data in an array
        $registration_data = $request->all();

        // Add the secret key to the registration data
        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();

        $registration_data["google2fa_enable"] = 1;

        // Save the registration data to the user session for just the next request
        $request->session()->flash('registration_data', $registration_data);

        // Generate the QR image. This is the image the user will scan with their app
     // to set up two factor authentication
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $registration_data['email'],
            $registration_data['google2fa_secret']
        );

        // Pass the QR barcode image to our view
        return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registration_data['google2fa_secret']]);
    }*/

    /*public function completeRegistration(Request $request)
    {        
        // add the session data back to the request input
        $request->merge(session('registration_data'));

        // Call the default laravel authentication
        return $this->registration($request);
    }*/

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


    public static function sendCode($email, $phone_number)
    {
        $code = rand(1111, 9999);
        Mail::to($email)->send(new SendMailable($code));

        /*$basic = new \Nexmo\Client\Credentials\Basic('81de9211', '2uK4uXgfutl3LgtC');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => $phone_number,
            'from' => '14373703901',
            'text' => 'Code de Vérification: '.$code,
        ]);*/

        return $code;
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
            //'google2fa_secret' => $data['google2fa_secret'],
            'role_id' => 1,
            'is_activated' => 0,
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
        $patient->status = 0;
        $patient->country = $data['country'];

        $country = Country::where('title' ,'=', $data['country'])->first();

        $country_code = Str::upper($country->code);

        $date = Carbon::today()->toDateString();

        $timestamp = strtotime($date);

        $month = date('m', $timestamp);

        $name = Str::of($data['name'])->substr(0,3)->upper();

        $firstname = Str::of($data['firstname'])->substr(0,1)->upper();

        $patient->matricule = $country_code.date("y").$month.$name.$firstname;

        $patient->save();

        if ($user) {
            $user->code = $this::sendCode($user->email, $user->phone_number);
            $user->save();
        }

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
            'region' => ['required'],
            'country' => ['required', 'string'],
            'exercice_place' => ['required', 'string'],
        ]);
    }


    protected function registerDoctor(Request $request)
    {
        $this->validatorDoctor($request->all())->validate();

        event(new Registered($user = $this->createDoctor($request->all())));

        return $this->registered($request, $user) ?: redirect('/verify?email='.$request->email.'&phone_number='.$request->phone_number);
    }


    protected function createDoctor(array $data)
    {
        //$this->validatorDoctor($request->all())->validate();

        $fileNameToStore = 'avatar.jpg';

        $user = User::create([
            'name' => $data['name'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'],
            //'address' => $data['address'],
            'profile_picture' => $fileNameToStore,
            'role_id' => 2,
            'is_activated' => 0,
            'lang' => 'FR',
        ]);

        $user->assignRole('Doctor');

        $doctor = new Doctor();
        $doctor->name = $data['name'];
        $doctor->firstname = $data['firstname'];
        //$doctor->username = $data['username'];
        $doctor->email = $data['email'];
        $doctor->phone_number = $data['phone_number'];
        //$doctor->address = $data['address'];
        //$doctor->title = $data['title'];
        //$doctor->gender = $data['gender'];
        //$doctor->birth_date = $data['birth_date'];
        //$doctor->place_birth = $data['place_birth'];
        //$doctor->nationality = $data['nationality'];
        //$doctor->speciality_id =$data['speciality_id'];
        $region = Region::findOrFail($data['region']);
        $doctor->region = $region->title;
        $doctor->country =$data['country'];
        $doctor->exercice_place =$data['exercice_place'];
        $doctor->city =$data['exercice_place'];
        $doctor->profile_picture = $fileNameToStore;
        $doctor->user_id = $user->id;
        $doctor->status = 0;

        $country = Country::where('title' ,'=', $data['country'])->first();

        $country_code = Str::upper($country->code);

        $date = Carbon::today()->toDateString();

        $timestamp = strtotime($date);

        $month = date('m', $timestamp);

        $name = Str::of($data['name'])->substr(0,3)->upper();

        $firstname = Str::of($data['firstname'])->substr(0,1)->upper();

        $doctor->matricule = $country_code.date("y").$month.$name.$firstname;

        $doctor->save(); 

        if ($user) {
            $user->code = $this::sendCode($user->email, $user->phone_number);
            $user->save();
        }

        return $user;

        return redirect()->intended('login');
    }



    /*protected function createDoctor(Request $request)
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

        $fileNameToStore = 'avatar.jpg';

        $user = User::create([
            'name' => $request['name'],
            'firstname' => $request['firstname'],
            'email' => $request['email'],
            'password' => $request['password'],
            'phone_number' => $request['phone_number'],
            //'address' => $data['address'],
            'profile_picture' => $fileNameToStore,
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
        //$doctor->place_birth = $request['place_birth'];
        //$doctor->nationality = $request['nationality'];
        //$doctor->speciality_id =$request['speciality_id'];
        $region = Region::findOrFail($request['region']);
        $doctor->region = $region->title;
        $doctor->country =$request['country'];
        $doctor->exercice_place =$request['exercice_place'];
        $doctor->city =$request['exercice_place'];
        $doctor->profile_picture = $fileNameToStore;
        $doctor->user_id = $user->id;
        $doctor->status = 0;

        $country = Country::where('title' ,'=', $request['country'])->first();

        $country_code = Str::upper($country->code);

        $date = Carbon::today()->toDateString();

        $timestamp = strtotime($date);

        $month = date('m', $timestamp);

        $name = Str::of($request['name'])->substr(0,3)->upper();

        $firstname = Str::of($request['firstname'])->substr(0,1)->upper();

        $doctor->matricule = $country_code.date("y").$month.$name.$firstname;

        $doctor->save();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...

            // initialise the 2FA class
            $google2fa = app('pragmarx.google2fa');

            // generate a new secret key for the user
            $user->google2fa_secret = $google2fa->generateSecretKey();

            // save the user
            $user->save();

            // generate the QR image
            $QR_Image = $google2fa->getQRCodeInline(
                config('app.name'),
                $user->email,
                $user->google2fa_secret
            );

            // Pass the QR barcode image to our view.
            return view('google2fa.2fa_settings', ['user' => $user,
                                            'QR_Image' => $QR_Image, 
                                            'secret' => $user->google2fa_secret
                                        ]);
        }

        //return redirect()->intended('login');
    }*/
}
