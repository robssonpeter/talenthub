<?php


namespace App\Functionalities;


use App\Models\EmailTemplate;

class Employer
{
    public static function defaultEmailTemplate($template_type){
        $template = EmailTemplate::where('type', $template_type)->orderBy('id', 'DESC')->first();
        return $template;
    }
}
