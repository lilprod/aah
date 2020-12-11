<?php

namespace App\Http\Middleware;

//use App\Support\Google2FAAuthenticator;
use PragmaRX\Google2FALaravel\Support\Authenticator;
use Closure;
use Illuminate\Support\Facades\Auth;

class LoginSecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->google2fa_enable  == 0) {

            return redirect('/get2fasetting');
        }

        $authenticator = app(Authenticator::class)->boot($request);

        if ($authenticator->isAuthenticated()) {
            return $next($request);
        }

        return $authenticator->makeRequestOneTimePasswordResponse();
    }
}