<?php


namespace App\Functionalities;


use App\Models\City;
use App\Models\Country;
use App\Models\EducationInstitution;
use SimpleXMLElement;

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


    public static function xmlRequest($xml, $url, $method){
        $curl = curl_init($url);
        //Set the Content-Type to text/xml.
        curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));

        if(strtolower($method) === 'post'){
            //Set CURLOPT_POST to true to send a POST request.
            curl_setopt($curl, CURLOPT_POST, true);
        }

        //Attach the XML string to the body of our request.
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);

        //Tell cURL that we want the response to be returned as
        //a string instead of being dumped to the output.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if(env('APP_DEBUG')){
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        }

        //Execute the POST request and send our XML.
        $result = curl_exec($curl);

        //Do some basic error checking.
        if(curl_errno($curl)){
            throw new \Exception(curl_error($curl));
        }

        //Close the cURL handle.
        curl_close($curl);

        return $result;
    }

    public static function parseXML($xml){
        $content = new SimpleXMLElement($xml);
        return (object) $content;
    }

}
