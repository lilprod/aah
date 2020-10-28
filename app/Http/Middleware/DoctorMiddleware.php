<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DoctorMiddleware
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
        if (Auth::user()->hasPermissionTo('Doctor Permissions')) { //If user has this //permission
            return $next($request);
        }

        return $next($request);
    }
}
