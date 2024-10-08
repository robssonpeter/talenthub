<?php

namespace App\Queries;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CompanyDataTable
 */
class CompanyDataTable
{
    /**
     * @return Company
     */
    public function get($input = [])
    {
        /** @var Company $query */
        $query = Company::with('user', 'activeFeatured', 'verification_attempt', 'verification_rejected', 'verification')->select('companies.*');

        $query->when(isset($input['is_featured']) && $input['is_featured'] == 1,
            function (Builder $q) use ($input) {
                $q->has('activeFeatured');
            });



        $query->when(isset($input['is_featured']) && $input['is_featured'] == 0,
            function (Builder $q) use ($input) {
                $q->doesnthave('activeFeatured');
            });

        $query->when(isset($input['is_status']) && $input['is_status'] == 1,
            function (Builder $q) use ($input) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 1);
                });
            });

        $query->when(isset($input['is_status']) && $input['is_status'] == 0,
            function (Builder $q) use ($input) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 0);
                });
            });

        $query->when(in_array('attempted', $input),
            function (Builder $q) use ($input) {
                $q->whereHas('verification_attempt', function (Builder $q) {
                    //$q->whereDoesntHave('verification');
                });
            });

        $query->when(in_array('not-rejected', $input),
            function (Builder $q) use ($input) {
                $q->whereDoesntHave('verification_rejected', function (Builder $q) {
                    //$q->whereDoesntHave('verification');
                });
            });
        /*$query->where(in_array('not-rejected', $input), function(Builder $q) use ($input){
             $q->whereDoesntHave('verification_rejected');
        });*/
        /*if(in_array('attempted', $input)){
            dd('hello there');
        }*/
        if(in_array('not-rejected', $input)){

        }
        if(in_array('attempted', $input)){
            $subQuery = $query->whereDoesntHave('verification')->get();
        }else{
            $subQuery = $query->get();
        }



        $result = $data = [];
        $subQuery->map(function (Company $company) use ($data, &$result) {
            $data['id'] = $company->id;
            $data['user'] = [
                'full_name'  => htmlspecialchars_decode($company->user->full_name),
                'first_name' => htmlspecialchars_decode($company->user->first_name),
                'last_name'  => $company->user->last_name,
                'email'      => $company->user->email,
                'is_active'  => $company->user->is_active,
                'verification' => $company->verification,
                'document'   => isset($company->verification_attempt)?$company->verification_attempt->documents:'hello',
            ];
            $data['company_url'] = $company->company_url;
            $data['active_featured'] = $company->activeFeatured;

            $result[] = $data;
        });

        return $result;
    }
}
