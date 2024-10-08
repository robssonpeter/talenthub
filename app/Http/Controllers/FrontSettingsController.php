<?php

namespace App\Http\Controllers;

use App\Models\FrontSetting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class FrontSettingsController extends Controller
{
    /**
     *
     * @return Factory|View
     * @throws Exception
     *
     */
    public function index()
    {
        $frontSettings = FrontSetting::pluck('value', 'key')->toArray();;
        return view('front_settings.index', compact('frontSettings'));
    }

    /**
     * @param Request $request
     *
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $inputArr = $request->all();
        $inputArr = Arr::except($inputArr, ['_token', 'save']);

        (isset($inputArr['featured_jobs_enable'])) ? $inputArr['featured_jobs_enable'] = 1 : $inputArr['featured_jobs_enable'] = 0;
        (isset($inputArr['featured_companies_enable'])) ? $inputArr['featured_companies_enable'] = 1 : $inputArr['featured_companies_enable'] = 0;
        (isset($inputArr['latest_jobs_enable'])) ? $inputArr['latest_jobs_enable'] = 1 : $inputArr['latest_jobs_enable'] = 0;
        (isset($inputArr['hide_subscription_plans'])) ? $inputArr['hide_subscription_plans'] = 1 : $inputArr['hide_subscription_plans'] = 0;

        foreach ($inputArr as $key => $value) {

            /** @var FrontSetting $frontSetting */
            $frontSetting = FrontSetting::where('key', $key)->first();
            if (!$frontSetting) {
                // create new entry
                $data = [
                    'key' => $key,
                    'value' => $value
                ];
                FrontSetting::create($data);
                continue;
            }

            $frontSetting->update(['value' => $value]);
        }
        Flash::success('Setting updated successfully.');

        return Redirect::back();
    }
}
