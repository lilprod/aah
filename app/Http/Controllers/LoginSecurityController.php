<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginSecurityController extends Controller
{

    public function get2fasetting()
    {
        // get the logged in user
        $user = \Auth::user();

        // initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // Add the secret key to the registration data
        $user->google2fa_enable = 1;

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

	public function reauthenticate(Request $request)
    {
        // get the logged in user
        $user = \Auth::user();

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
        return view('google2fa.register', ['QR_Image' => $QR_Image, 
                                            'secret' => $user->google2fa_secret,
                                            'reauthenticating' => true
                                        ]);
    }

     /**
     * Generate 2FA secret key
     */
    public function generate2faSecret(Request $request){

        $user = Auth::user();

        // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // Add the secret key to the registration data
        $user->google2fa_enable = 1;

        $user->google2fa_secret = $google2fa->generateSecretKey();

        $user->save();

        if($user->role_id == 1){
            return redirect('dashboard')->with('success',"Secret key is generated."); 
        }

        return redirect('doctor/dashboard')->with('success',"Secret key is generated.");
    }

    /**
     * Enable 2FA
     */
    public function enable2fa(Request $request){

        $user = Auth::user();

        // initialise the 2FA class

        $google2fa = app('pragmarx.google2fa');

        $secret = $request->input('secret');

        $valid = $google2fa->verifyKey($user->google2fa_secret, $secret);

        if($valid){

            $user->google2fa_enable = 1;

            $user->save();

            if($user->role_id == 1){
               return redirect('dashboard')->with('success',"2FA is enabled successfully."); 
            }

            return redirect('doctor/dashboard')->with('success',"2FA is enabled successfully.");

        }else{
            return redirect()->back()->with('error',"Invalid verification Code, Please try again.");
        }
    }

    /**
     * Disable 2FA
     */
    public function disable2fa(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your password does not matches with your account password. Please try again.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);

        $user = Auth::user();

        $user->google2fa_enable = 0;

        $user->save();

        if($user->role_id == 1){
            return redirect('dashboard')->with('success',"2FA s now disabled."); 
        }

        return redirect('doctor/dashboard')->with('success',"2FA is now disabled.");
    }
}
