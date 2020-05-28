<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class OwnUser
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
        // dd($request->route('user')->id);
        $id = $request->route('user')->id; // For example, the current URL is: /users/1/edit
        if(Auth::user()->type_id !== 1)
        {
            if(Auth::id() === $id)
            {
               // All is fine, user is accessing his own page
               return $next($request);
            }
            return redirect()->back();    
        }
        return $next($request);
    }
}
