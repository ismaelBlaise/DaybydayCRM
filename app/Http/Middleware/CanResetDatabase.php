<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CanResetDatabase
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
        if (!Auth()->check() || !Auth()->user()->hasRole('administrator')) {
            Session::flash('flash_message_warning', __("Vous n'avez pas l'autorisation de réinitialiser la base de données."));
            return redirect()->route('dashboard');  
        }

        return $next($request);
    }
}
