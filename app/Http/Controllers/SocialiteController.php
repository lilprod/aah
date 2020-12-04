<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\Patient;

class SocialiteController extends Controller
{
    // Les tableaux des providers autorisés
    protected $providers = ['google', 'facebook'];

    # La vue pour les liens vers les providers
    /*public function loginRegister () {

    	return view("socialite.login-register");
    }*/

    # redirection vers le provider
    public function redirect (Request $request) {

        $provider = $request->provider;

        // On vérifie si le provider est autorisé
        if (in_array($provider, $this->providers)) {

            return Socialite::driver($provider)->redirect(); // On redirige vers le provider
        }

        //abort(404); // Si le provider n'est pas autorisé
        return redirect(route('login'))->with('error', 'Provider not found');
    }


    // Callback du provider
    public function callback (Request $request) {

        $provider = $request->provider;

        if (in_array($provider, $this->providers)) {

        	// Les informations provenant du provider
            //$data = Socialite::driver($request->provider)->user();

            $data = Socialite::driver($request->provider)->stateless()->user();

            # Social login - register

            $email = $data->getEmail(); // L'adresse email
            $name = $data->getName(); // le nom
            $id = $data->getId(); //id
            //$avatar = $data->getAvatar(); //avatar

            # 1. On récupère l'utilisateur à partir de l'adresse email
            $user = User::where('email', $email)->first();

            # 2. Si l'utilisateur existe
            if (isset($user)) {

                // Mise à jour des informations de l'utilisateur
                $user->name = $name;
                $user->save();
                $patient = Patient::where('user_id', $user->id)->first();
                $patient->name = $name;
                $patient->save();

            # 3. Si l'utilisateur n'existe pas, on l'enregistre
            } else {
                
                // Enregistrement de l'utilisateur
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => 123456, // On attribue un mot de passe
                    'provider' => $provider,
         			'provider_id' => $id,
         			'role_id' => 1,
         			'is_activated' => 1,
            		'lang' => 'FR',
                    'profile_picture' => 'avatar.jpg',

                ]);

                $user->assignRole('Patient');

                $patient = new Patient();
                $patient->name = $name;
                $patient->firstname = $name;
                $patient->email = $email;
                $patient->profile_picture = 'avatar.jpg';
                $patient->user_id = $user->id;
                $patient->status = 0;

                $patient->save();
            }

            # 4. On connecte l'utilisateur
            auth()->login($user);

            # 5. On redirige l'utilisateur vers /dashboard
            if (auth()->check()) {

            	return redirect(route('dashboard'));
            }

         }

         abort(404);
         //return redirect(route('login'))->with(['status' => 'Login failed. Please try again']);
    }

}
