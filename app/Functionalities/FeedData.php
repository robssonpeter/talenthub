<?php


namespace App\Functionalities;


use App\Models\City;
use App\Models\Country;
use App\Models\EducationInstitution;

class FeedData
{
    public static function schools(){
        $universities = universities();
        $countries = array_keys($universities);
        foreach($countries as $country){
            $region = ucwords(str_replace('-', ' ', $country));
            $countryData = Country::where('name', $region)->first();
            if(!$countryData){
                continue;
            }
            foreach($universities[$country] as $university){
                /*$universityWord = str_replace(' ', '-', strtolower($university));
                $uniInfo = (array) university($universityWord);
                $uniCity = isset($uniInfo['address'])?$uniInfo['address']['city']:'';
                if(strlen($uniCity)){
                    $city = City::where('name', 'like', '%'.$uniCity.'%')->first();
                }else{
                    $city = null;
                }*/
                $data = ['name' => $university, 'city_id' => isset($city->id)?$city->id:null, 'country_id' => $countryData->id];
                $create = EducationInstitution::updateOrCreate($data, $data);
            }
        }
    }

}
