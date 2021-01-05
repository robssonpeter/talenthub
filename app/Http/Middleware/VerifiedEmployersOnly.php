<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\User;
use Closure;

class VerifiedEmployersOnly
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
        $routes = [
            'front.candidate.details'
        ];
        $route = \Route::currentRouteName();

        if(\Auth::check()){

            $user_id = \Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            $company = Company::where('user_id', $user_id)->with(['verification_attempt', 'verification'])->first();
            if(in_array($route, $routes) && $company && !$company->has('verification')){
                return response(view('web.company.verified_only', $company));
            }
            return $next($request);
        }
        return $next($request);
    }
}
