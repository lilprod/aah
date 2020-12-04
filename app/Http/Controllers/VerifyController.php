<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VerifyController extends Controller
{
    public function getVerify()
    {
        return view('verify');
    }

    public function postVerify(Request $request)
    {
        if ($user = User::where('code', $request->code)->first()) {

            if($user->role_id == 1){
               $user->is_activated = 1;
               $user->code = null;
               $user->save(); 

               return redirect()->route('login')->with('success', 'Your account has been verified!');
            }else{
               $user->code = null;
               $user->save(); 

               return redirect()->route('login')->with('success', 'Your account has been verified!');
            }
            
        } else {
            return back()->with('error', 'Error Verification!');
        }
    }
}
