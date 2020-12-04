<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        
        $this->middleware('guest:admin')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        //-----------------------------

        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();
            if ($user->is_activated && $this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            } else {
                $this->incrementLoginAttempts($request);
                $user->code = SendCode::sendCode($user->email, $user->phone_number);
                if ($user->save()) {
                    return redirect('/verify?email='.$user->email.'&phone_number='.$user->phone_number);
                }
            }
        }

        //--------------------------

        $this->IncrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /*public function showPatientLoginForm()
    {
        return view('auth.login', ['url' => 'patient']);
    }*/


    /*public function showDoctorLoginForm()
    {
        return view('auth.login', ['url' => 'doctor']);
    }*/

    /*protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){
            //return ['phone_number'=>$request->get('email'),'password'=>$request->get('password')];

            $credentials = ['phone_number'=>$request->get('email'),'password'=>$request->get('password')];

            $credentials['is_activated'] = 1;

            return $credentials;
        }
        elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
        //return ['email' => $request->get('email'), 'password'=>$request->get('password')];

            $credentials = ['email' => $request->get('email'), 'password'=>$request->get('password')];

            $credentials['is_activated'] = 1;

            return $credentials;
        }
        //return ['username' => $request->get('email'), 'password'=>$request->get('password')];

        $credentials = ['username' => $request->get('email'), 'password'=>$request->get('password')];

        $credentials['is_activated'] = 1;

        return $credentials;
    }*/

    protected function credentials(Request $request)
    {

        if(is_numeric($request->get('email'))){

            $credentials = $request->only($this->username(), 'password');

            $credentials['is_activated'] = 1;

            return $credentials;

        }
        elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {

            $credentials = $request->only($this->username(), 'password');

            $credentials['is_activated'] = 1;

            return $credentials;
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
 
        // Fetching user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();
        //dd($user);
        // Checking if user is sucessfully logged in, if login is sucessfull
        // and status is false i.e. 0 w will override the default error message
        if($user && Hash::check($request->password, $user->password) && $user->is_activated !=1){
            
            $errors = [$this->username() => 'Your account is not activated.'];
        }
 
        if ($request->expectsJson()) {
            # code...
            return response()->json($errors,422);
        }
 
        return redirect()->back()->withInput($request->only($this->username(), 'remember'))->withErrors($errors);
    }


    /**
    * Get the login username to be used by the controller.
    *
    * @return string
    */
    public function username()
    {
         $login = request()->input('email');

         /*if(is_numeric($login)){

            $field = $login ? 'phone_number' : 'username';

            request()->merge([$field => $login]);

            return $field;
         }*/

         //$field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
         $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

         request()->merge([$field => $login]);

         return $field;
    }
}
