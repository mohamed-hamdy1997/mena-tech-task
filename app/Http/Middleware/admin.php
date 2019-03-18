<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;


class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next ,$role)
    {
       if( Auth::user()->rolls->roll == $role){

       }else{

           return redirect("/home");
       }

        return $next($request);
    }
}
