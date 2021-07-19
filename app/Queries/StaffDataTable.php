<?php

namespace App\Queries;

/*use App\Models\Company;*/
use App\Models\Staff;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class StaffDataTable
 */
class StaffDataTable
{
    /**
     * @param array $input
     * @return array
     */
    public function get($input = [])
    {
        /** @var Staff $query */
        $query = Staff::with('user')->whereHas('user')->select('staff.*')->get();

        /*$query->when(isset($input['is_featured']) && $input['is_featured'] == 1,
            function (Builder $q) use ($input) {
                $q->has('activeFeatured');
            });*/

        /*$query->when(isset($input['is_featured']) && $input['is_featured'] == 0,
            function (Builder $q) use ($input) {
                $q->doesnthave('activeFeatured');
            });*/

        /*$query->when(isset($input['is_status']) && $input['is_status'] == 1,
            function (Builder $q) use ($input) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 1);
                });
            });*/

        /*$query->when(isset($input['is_status']) && $input['is_status'] == 0,
            function (Builder $q) use ($input) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 0);
                });
            });*/

        /*$query->when(in_array('attempted', $input),
            function (Builder $q) use ($input) {
                $q->whereHas('verification_attempt', function (Builder $q) {
                    //$q->whereDoesntHave('verification');
                });
            });*/

        /*if(in_array('attempted', $input)){
            dd('hello there');
        }*/

        /*$subQuery = $query->get();*/

        //dd($subQuery);

        $result = $data = [];

        /*foreach($query as $staff){

            $row = [
                'id' => $staff->id,
                'user' => [
                    'first_name' => $staff->user->first_name,
                    'last_name'  => $staff->user->last_name,
                    'email'      => $staff->user->email,
                    'is_active'  => $staff->user->is_active,
                ]
            ];
            array_push($result, $row);
        }*/
        /*$subQuery->map(function (Staff $staff) use ($data, &$result) {

            $data['id'] = $staff->id;
            //dd($staff->user->first_name);
            $first_name = $staff->user->first_name;
            $last_name = $staff->user->last_name;
            $email= $staff->user->email;
            $is_active = $staff->user->is_active;
            $data['user'] = [
                'first_name' => '',
                'last_name'  => '',
                'email'      => '',
                'is_active'  => '',
            ];

            $result[] = $data;
        });*/
        //dd($query);
        return $query;
    }
}
