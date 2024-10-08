<?php

use App\Models\City;
use App\Models\Company;
use App\Models\FrontSetting;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\State;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * @return int
 */
function getLoggedInUserId()
{
    return Auth::id();
}

/**
 * @return User
 */
function getLoggedInUser()
{
    return Auth::user();
}

function formatNumber($number)
{
    return round(str_replace(',', '', $number), 2);
}

function dashboardURL()
{
    if (Auth::user()->hasRole('Admin')) {
        return \Illuminate\Support\Facades\URL::to(RouteServiceProvider::ADMIN_HOME);
    } else {
        if (Auth::user()->hasRole('Employer')) {
            return \Illuminate\Support\Facades\URL::to(RouteServiceProvider::EMPLOYER_HOME);
        } elseif (Auth::user()->hasRole('Candidate')) {
            return \Illuminate\Support\Facades\URL::to(RouteServiceProvider::CANDIDATE_HOME);
        }
    }
}

/**
 * @param $number
 *
 * @return string|string[]
 */
function removeCommaFromNumbers($number)
{
    return (gettype($number) == 'string' && ! empty($number)) ? str_replace(',', '', $number) : $number;
}


function settings()
{
    return Setting::pluck('value', 'key')->toArray();
}

/**
 * @param $key
 *
 * @return mixed
 */
function getSettingValue($key)
{
    $settingValue =  Setting::where('key', $key)->value('value');

    if ($settingValue == 'favicon.ico') {
        return asset($settingValue);
    }

    return $settingValue;
}

function getFrontSettingValue($key)
{
    $settingValue =  FrontSetting::where('key', $key)->first();

    if ($settingValue) {
        return $settingValue->value;
    }

    return null;
}

/**
 * @param $country
 *
 * @return mixed
 */
function getCountryName($country)
{
    if (empty($country)) {
        return;
    }

    return \App\Models\Country::find($country)->name;
}

/**
 * return avatar url.
 *
 * @return string
 */
function getAvatarUrl()
{
    return '//ui-avatars.com/api/';
}

/**
 * return avatar full url.
 *
 * @param  int  $userId
 * @param  string  $name
 *
 * @return string
 */
function getUserImageInitial($userId, $name)
{
    return getAvatarUrl()."?name=$name&size=100&rounded=true&color=fff&background=".getRandomColor($userId);
}

/**
 * return random color.
 *
 * @param  int  $userId
 *
 * @return string
 */
function getRandomColor($userId)
{
    $colors = ['329af0', 'fc6369', 'ffaa2e', '42c9af', '7d68f0'];
    $index = $userId % 5;

    return $colors[$index];
}

function getUniqueCompanyId()
{
    $companyUniqueId = Str::random(12);
    while (true) {
        $isExist = Company::whereUniqueId($companyUniqueId)->exists();
        if ($isExist) {
            getUniqueCompanyId();
        }
        break;
    }

    return $companyUniqueId;
}


function getUniqueStaffId()
{
    $staffUniqueId = Str::random(12);
    while (true) {
        $isExist = Staff::where('unique_id', $staffUniqueId)->exists();
        if ($isExist) {
            getUniqueStaffId();
        }
        break;
    }

    return $staffUniqueId;
}

/**
 * @return mixed
 */
function getLogoUrl()
{
    static $appLogo;

    if (empty($appLogo)) {
        $appLogo = Setting::where('key', '=', 'logo')->first();
    }

    return $appLogo->logo_url;
}

/**
 * Accessor for Age.
 * @param $date
 *
 * @return int
 */
function getAgeCount($date)
{
    return Carbon::parse($date)->age;
}

/**
 * @param $id
 *
 * @return string
 */
function getShiftClass($id)
{
    $class = [
        'btn btn-green btn-small btn-effect',
        'btn btn-purple btn-small btn-effect',
        'btn btn-blue btn-small btn-effect',
        'btn btn-orange btn-small btn-effect',
        'btn btn-red btn-small btn-effect',
        'btn btn-blue-grey btn-small btn-effect',
        'btn btn-green btn-small btn-effect',
    ];
    $index = $id % 7;

    return $class[$index];
}

/**
 * @return array
 */
function getCountries()
{
    return \App\Models\Country::pluck('name', 'id')->toArray();
}

/**
 * @param $countryId
 *
 * @return array
 */
function getStates($countryId)
{
    return State::where('country_id', $countryId)->pluck('name', 'id')->toArray();
}

function getSchools($countryId)
{
    return \App\Models\EducationInstitution::where('country_id', $countryId)->pluck('name', 'id')->toArray();
}

/**
 * @param $stateId
 *
 * @return array
 */
function getCities($stateId)
{
    return City::where('state_id', $stateId)->pluck('name', 'id')->toArray();
}

/**
 * @return array
 */
function getUserLanguages()
{
    return User::LANGUAGES;
}

/**
 * @return string
 */
function getCompanyLogo()
{
    // get the company logo
    $user = Auth::user();
    if (! empty($user->avatar)) {
        return $user->avatar;
    }

    return asset('assets/img/infyom-logo.png');
}

// number formatted code

/**
 * @param $currencyValue
 *
 * @return string
 */
function formatCurrency($currencyValue)
{
    $amountValue = $currencyValue;
    $currencySuffix = ""; //thousand,lac, crore
    $numberOfDigits = countDigit($amountValue); //this is call :)
    if ($numberOfDigits > 3) {
        if ($numberOfDigits % 2 != 0) {
            $divider = divider($numberOfDigits - 1);
        } else {
            $divider = divider($numberOfDigits);
        }
    } else {
        $divider = 1;
    }

    $formattedAmount = $amountValue / $divider;
    $formattedAmount = number_format($formattedAmount, 2);
    if ($numberOfDigits == 4 || $numberOfDigits == 5) {
        $currencySuffix = "k";
    }
    if ($numberOfDigits == 6 || $numberOfDigits == 7) {
        $currencySuffix = "Lac";
    }
    if ($numberOfDigits == 8 || $numberOfDigits == 9) {
        $currencySuffix = "Cr";
    }

    return $formattedAmount." ".$currencySuffix;
}

/**
 * @param $number
 *
 * @return int
 */
function countDigit($number)
{
    return strlen($number);
}

/**
 * @param $numberOfDigits
 *
 * @return int|string
 */
function divider($numberOfDigits)
{
    $tens = "1";
    if ($numberOfDigits > 8) {
        return 10000000;
    }

    while (($numberOfDigits - 1) > 0) {
        $tens .= "0";
        $numberOfDigits--;
    }

    return $tens;
}

function setStripeApiKey()
{
    \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));
}

/**
 * @param  array  $input
 * @param  string  $key
 *
 * @return string|null
 */
function preparePhoneNumber($phone, $regionCode)
{
    return (! empty($phone)) ? '+'.$regionCode.$phone : null;
}

/**
 *
 * @return string[]
 */
function getLanguages()
{
    return User::LANGUAGES;
}

/**
 * @return mixed|null
 */
function checkLanguageSession()
{
    if (Session::has('languageName')) {
        return Session::get('languageName');
    }

    return 'en';
}

/**
 * @return mixed|null
 */
function getCurrentLanguageName()
{
    return User::LANGUAGES[checkLanguageSession()];
}

/**
 * @param $fileName
 *
 * @param $attachment
 *
 * @return string
 */
function getFileName($fileName, $attachment)
{
    $fileNameExtension = $attachment->getClientOriginalExtension();
    $newName = $fileName.'-'.time();

    return $newName.'.'.$fileNameExtension;
}

/**
 * @param  array  $models
 * @param  string  $columnName
 * @param  int  $id
 *
 * @return bool
 */
function canDelete($models, $columnName, $id)
{
    foreach ($models as $model) {
        $result = $model::where($columnName, $id)->exists();
        if ($result) {
            return true;
        }
    }

    return false;
}

function daysToYearsAndMonths($days){
    if($days<365){
        $years = 0;
        $months = round($days/30);
    }else{
        $toMonths = $days%365;
        $months = round($toMonths/30);
        $years = ($days - $toMonths)/365;
    }
    return [
        'years' => $years,
        'months' => (int) $months
    ];
}

function isStaff($user_id){
    $user = User::find($user_id);
    $roles = [
        'Admin', 'Moderator', 'Recruiter'
    ];
    $userRoles = $user->roles()->pluck('name')->toArray();
    if(array_intersect($roles, $userRoles)){
        return true;
    }
    return false;
}

function verifyUserEmail($email){
    $user = User::where('email', $email)->first();
    if($user && !$user->email_verified_at){
        $verification_time = Carbon::now()->toDateTimeString();
        $user->update(['email_verified_at' => $verification_time]);
    }
}
