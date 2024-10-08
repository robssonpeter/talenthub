<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Models\FAQ;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AboutUsController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function FAQLists()
    {
        $faqLists = FAQ::all();

        return view('web.about_us.index', compact('faqLists'));
    }

    public function termsAndConditions(){
        return view('web.about_us.terms-and-conditions');
    }
    public function termsAndConditionSale(){
        return view('web.about_us.terms-and-conditions-sale');
    }


}
