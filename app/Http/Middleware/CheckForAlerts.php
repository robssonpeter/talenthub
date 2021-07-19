<?php

namespace App\Http\Middleware;

use App\Models\Alert;
use Closure;

class CheckForAlerts
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
        if(Auth()->check()){
            $alerts = Alert::where('user_id', Auth()->user()->id)->whereNull('status')->get();
            session()->flash('user_alerts', $alerts);
        }
        return $next($request);
    }
}
