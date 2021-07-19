<?php

namespace App\Http\Middleware;
use App\Models\Company;

use Closure;

class CheckForCompanyVerification
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
        $exception = [
            'company.verify'
        ];
        $route = \Route::currentRouteName();
        if(is_array($route)){
            return $next($request);
        }

        if(\Auth::check() && \Auth::user()->owner_type == 'App\Models\Company'){
            $company = Company::where('user_id', \Auth::user()->id)->with('verification_attempt', 'verification_rejected')->first();
            $disAllowRoutes = [
              'front.candidate.details'
            ];
            $noMessageRoutes = [
                'company.verify'
            ];
            $routeName = \Route::currentRouteName();
            if(!$company->verification){
                if($company->verification_rejected && $company->verification_rejected->attempt_id == $company->verification_attempt->id){
                    $message = [
                        'message' => __('messages.alert.verification_rejected'),
                        'dismissible' => false,
                        'action' => [
                            'name' => __('messages.action.take_action'), 'url' => route('company.verify')
                        ],
                        'type' => 'danger'
                    ];
                }else{
                    if(!$company->verification_attempt){
                        $message = [
                            'message' => __('messages.alert.company_verify'),
                            'dismissable' => false,
                            'action' => [
                                'name' => __('messages.action.verify'), 'url' => route('company.verify')
                            ],
                            'type' => 'info'
                        ];
                    }
                }


                if(isset($message)){
                    if(!in_array($routeName, $noMessageRoutes)){
                        //dd($message);
                        session()->flash('message', $message);
                    }
                }/*else{
                    dd('hi there');
                }*/
                if(in_array($routeName, $disAllowRoutes)){
                    return response(view('web.verified-only'));
                }
                /*dd(\Route::currentRouteName());*/
            }
        }
        return $next($request);
    }
}
