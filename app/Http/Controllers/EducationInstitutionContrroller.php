<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalaryCurrencyRequest;
use App\Http\Requests\UpdateSalaryCurrencyRequest;
use App\Models\Candidate;
use App\Models\Country;
use App\Models\EducationInstitution;
use App\Models\Job;
use App\Models\SalaryCurrency;
use App\Queries\EducationInstitutionDataTable;
use App\Queries\SalaryCurrencyDataTable;
use App\Repositories\SalaryCurrencyRepository;
use App\Repositories\EducationInstitutionRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class EducationInstitutionContrroller extends AppBaseController
{
    /** @var  SalaryCurrencyRepository */
    private $salaryCurrencyRepository;

    public function __construct(/*SalaryCurrencyRepository $salaryCurrencyRepo*/)
    {
        //$this->salaryCurrencyRepository = $salaryCurrencyRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new EducationInstitutionDataTable())->get())->make(true);
        }
        //dd(Datatables::of((new EducationInstitutionDataTable())->get())->make(true));
        $countries = Country::all();
        return view('education_institution.index', compact('countries'));
    }

    /**
     * Store a newly created SalaryCurrency in storage.
     *
     * @param  CreateSalaryCurrencyRequest  $request
     *
     * @return JsonResource
     */
    public function store(Request $request)
    {

        $input = $request->all();
        EducationInstitution::create($input);
        //$this->salaryCurrencyRepository->create($input);
        //$this->educationInstitutionRepository->create($input);

        return $this->sendSuccess(__('messages.education_institution.messages.institution_saved_successfully'));
    }

    /**
     * Show the form for editing the specified SalaryCurrency.
     *
     * @param  SalaryCurrency  $salaryCurrency
     *
     * @return JsonResource
     */
    public function edit(EducationInstitution $educationInstitution)
    {
        return $this->sendResponse($educationInstitution, 'Salary Currency successfully retrieved.');
    }

    /**
     * Update the specified SalaryCurrency in storage.
     *
     * @param  SalaryCurrency  $salaryCurrency
     * @param  UpdateSalaryCurrencyRequest  $request
     *
     * @return JsonResource
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $institution = $request->educationInstitutionId;
        $data = [ 'name' => $input['name'], 'country_id' => $input['country_id']];
        EducationInstitution::where('id', $institution)->update($data);

        return $this->sendSuccess(__('messages.education_institution.messages.institution_saved_successfully'));
    }

    /**
     * Remove the specified SalaryCurrency from storage.
     *
     * @param  SalaryCurrency  $salaryCurrency
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(SalaryCurrency $salaryCurrency)
    {
        $jobsalaryCurrencyIds = Job::where('currency_id', $salaryCurrency->id)->pluck('currency_id')->toArray();
        $candidatesalaryCurrencyIds = Candidate::where('salary_currency',
            $salaryCurrency->id)->pluck('salary_currency')->toArray();
        if (in_array($salaryCurrency->id, $jobsalaryCurrencyIds) || in_array($salaryCurrency->id,
                $candidatesalaryCurrencyIds)) {
            return $this->sendError('Salary Currency can\'t be deleted.');
        } else {
            $salaryCurrency->delete();
        }

        return $this->sendSuccess('Salary Currency deleted successfully.');
    }
}
