<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\CompanyVerification;
use App\Models\EmailTemplate;
use App\Models\FeaturedRecord;
use App\Models\FrontSetting;
use App\Models\ReportedToCompany;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VerificationAttempt;
use App\Queries\CompanyDataTable;
use App\Queries\FollowerDataTable;
use App\Queries\ReportedCompanyDataTable;
use App\Queries\StaffDataTable;
use App\Repositories\CompanyRepository;
use App\Repositories\StaffRepository;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends AppBaseController
{
    /** @var  CompanyRepository */
    private $staffRepository;

    public function __construct(StaffRepository $staffRepo)
    {
        $this->staffRepository = $staffRepo;
    }

    /**
     * Display a listing of the Company.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new StaffDataTable())->get($request->only([
                'is_featured', 'is_status',
            ])))->make(true);
        }

        $featured = Company::IS_FEATURED;
        $statusArr = Company::STATUS;

        return view('staff.index', compact('featured', 'statusArr'));
    }

    /**
     * Show the form for creating a new Company.
     *
     * @return Factory|View
     */
    public function create()
    {
        $exeptions = [
            'Admin',
            'Employer',
            'Candidate'
        ];
        $roles = Role::whereNotIn('name', $exeptions)->pluck('name', 'id');
        $data = $this->staffRepository->prepareData();
        $data['roles'] = $roles;
        return view('staff.create')->with('data', $data);
    }

    /**
     * Store a newly created Company in storage.
     *
     * @param  Request  $request
     *
     * @throws \Throwable
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        //dd($input);

        $staff = $this->staffRepository->store($input);

        // mark the email as verified
        $staff_user = User::where('email', $input['email'])->first();
        $staff_user->markEmailAsVerified();
        // Get the role to assign
        $role = Role::find($input['role']);
        // Give the user a role
        $staff_user->assignRole($role->name);

        Flash::success('Staff saved successfully.');

        return redirect(route('staff.index'));
    }

    /**
     * Display the specified Company.
     *
     * @param  Company  $staff
     *
     * @return Factory|View
     */
    public function show(Staff $staff)
    {
        return view('staff.show')->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified Company.
     *
     * @param  Company  $staff
     *
     * @return Factory|View
     */
    public function edit(Staff $staff)
    {
        $user = $staff->user;
        $user->phone = preparePhoneNumber($user->phone, $user->region_code);
        $data = $this->staffRepository->prepareData();
        $states = $cities = null;
        if (isset($user->country_id)) {
            $states = getStates($user->country_id);
        }
        if (isset($user->state_id)) {
            $cities = getCities($user->state_id);
        }

        return view('companies.edit', compact('data', 'company', 'cities', 'states', 'user'));
    }

    /**
     * @param  Company  $staff
     * @param  UpdateCompanyRequest  $request
     *
     * @throws Throwable
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Company $staff, UpdateCompanyRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;


        $staff = $this->companyRepository->update($input, $staff);

        Flash::success('Company updated successfully.');

        return redirect(route('company.index'));
    }

    /**
     * Remove the specified Company from storage.
     *
     * @param  Company  $staff
     *
     * @throws Exception
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy($staff)
    {
        //return $staff;
        $this->staffRepository->delete($staff);
        //$staff->user->media()->delete();
        //$staff->user->delete();

        return $this->sendSuccess('Staff deleted successfully.');
    }


    /**
     * @param  Company  $staff
     *
     * @return mixed
     */
    public function changeIsActive(Company $staff)
    {
        $isActive = $staff->user->is_active;
        $staff->user->update(['is_active' => ! $isActive]);

        return $this->sendSuccess('Status changed successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getStates(Request $request)
    {
        $postal = $request->get('postal');

        $states = getStates($postal);

        return $this->sendResponse($states, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $state = $request->get('state');
        $cities = getCities($state);

        return $this->sendResponse($cities, 'Retrieved successfully');
    }

    /**
     * Show the form for editing the specified Company.
     *
     * @param  Company  $staff
     *
     * @return Factory|View
     */
    public function editCompany(Company $staff)
    {
        $user = $staff->user;
        $user->phone = preparePhoneNumber($user->phone, $user->region_code);
        if ($user->id != getLoggedInUserId()) {
            throw new ModelNotFoundException;
        }
        $data = $this->companyRepository->prepareData();
        $states = $cities = null;
        if (isset($user->country_id)) {
            $states = getStates($user->country_id);
        }
        if (isset($user->state_id)) {
            $cities = getCities($user->state_id);
        }
        $isFeaturedEnable = FrontSetting::where('key', 'featured_companies_enable')->first()->value;
        $maxFeaturedJob = FrontSetting::where('key', 'featured_companies_quota')->first()->value;
        $totalFeaturedJob = Company::Has('activeFeatured')->count();
        $isFeaturedAvilabal = ($totalFeaturedJob >= $maxFeaturedJob) ? false : true;

        return view('employer.companies.edit',
            compact('data', 'company', 'cities', 'states', 'user', 'isFeaturedEnable', 'isFeaturedAvilabal'));
    }

    /**
     * Update the specified Company in storage.
     *
     * @param  Company  $staff
     * @param  UpdateCompanyRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function updateCompany(Company $staff, UpdateCompanyRequest $request)
    {
        $input = $request->all();

        $staff = $this->companyRepository->update($input, $staff);

        Flash::success('Employer updated successfully.');

        return redirect(route('company.edit.form', Auth::user()->owner_id));
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function showReportedCompanies(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new ReportedCompanyDataTable())->get())->make(true);
        }

        return view('employer.companies.reported_companies');
    }

    /**
     * @param  ReportedToCompany  $reportedToCompany
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function deleteReportedCompany(ReportedToCompany $reportedToCompany)
    {
        $reportedToCompany->delete();

        return $this->sendSuccess('Reported Jobs deleted successfully.');
    }

    /**
     * Display a listing of the Job.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function getFollowers(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new FollowerDataTable())->get())->make(true);
        }

        return view('employer.followers.index');
    }

    /**
     * @param  ReportedToCompany  $reportedToCompany
     *
     * @return mixed
     */
    public function showReportedCompanyNote(ReportedToCompany $reportedToCompany)
    {
        return $this->sendResponse($reportedToCompany, 'Retrieved successfully.');
    }

    /**
     * @param  $staffId
     *
     * @return mixed
     **/
    public function markAsFeatured($staffId)
    {
        $userId = getLoggedInUserId();
        $addDays = FrontSetting::where('key', 'featured_companies_days')->first()->value;
        $price = FrontSetting::where('key', 'featured_companies_price')->first()->value;
        $maxFeaturedJob = FrontSetting::where('key', 'featured_companies_quota')->first()->value;
        $totalFeaturedJob = Company::Has('activeFeatured')->count();
        $isFeaturedAvailable = ($totalFeaturedJob >= $maxFeaturedJob) ? false : true;

        if ($isFeaturedAvailable) {
            $featuredRecord = [
                'owner_id'   => $staffId,
                'owner_type' => Company::class,
                'user_id'    => $userId,
                'start_time' => Carbon::now(),
                'end_time'   => Carbon::now()->addDays($addDays),
            ];
            FeaturedRecord::create($featuredRecord);
            $transaction = [
                'owner_id'   => $staffId,
                'owner_type' => Company::class,
                'user_id'    => $userId,
                'amount'     => $price,
            ];
            Transaction::create($transaction);

            return $this->sendSuccess('Company mark as featured successfully.');
        }

        return $this->sendError('Featured Quota is Not available');

    }

    /**
     * @param  $staffId
     *
     * @return mixed
     **/
    public function markAsUnFeatured($staffId)
    {
        /** @var FeaturedRecord $unFeatured */
        $unFeatured = FeaturedRecord::where('owner_id', $staffId)->where('owner_type', Company::class)->first();
        $unFeatured->delete();

        return $this->sendSuccess('Company mark as Unfeatured successfully.');
    }


    public function verificationAttempt(){
        $user_id = Auth::user()->id;
        $staff = Company::where('user_id', $user_id)->with('verification')->with('verification_attempt')->first();
        $docs = Setting::where('key', 'verification_documents')->first();
        $documents = [];
        if($docs){
            $documents = json_decode($docs->value);
        }
        !$staff?abort(401):'';
        return view('employer.verification.index', compact('company', 'documents'));
    }

    public function verificationSave(Request $request){
        $rules = [
            'role_at_company' => 'required',
            'file' => 'required'
        ];
        $docs = Setting::where('key', 'verification_documents')->first();
        $documents = json_decode($docs->value);
        $validator = $request->validate($rules);
        $docsToSave =[];

        $x = 0;
        foreach($documents as $document){
            $row = [
                'name' => $document->name,
                'file' => $request->file[$x]
            ];
            array_push($docsToSave, $row);
            $x++;
        }

        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->with('company')->first();
        $data = [
            'role' => $request->role_at_company,
            /*'document' => $request->file,*/
            'document' => json_encode($docsToSave),
            'company_id' => $user->company->id,
        ];
        $saved = VerificationAttempt::updateOrCreate(['company_id' => $user->company->id], $data);
        if($saved){
            return true;
        }
        return false;
    }

    public function uploadVerificationAttachment(){
        request()->validate([
            'attachment' => "file|mimes:pdf,doc,docx|max:120000"
        ]);
        $file = request()->file('attachment');
        $destinationFolder = public_path('verification_files');

        if(!File::isDirectory($destinationFolder)){
            File::makeDirectory($destinationFolder, 0776, true, true);
        }
        $uniqid = uniqid();
        $last_pos = strrpos($file->getClientOriginalName(), '.');
        $extension = substr($file->getClientOriginalName(), $last_pos);
        $fileName = str_replace($extension, '', $file->getClientOriginalName())."-".$uniqid.'-'.Auth()->user()->id.$extension;
        $file->move($destinationFolder, $fileName);
        return [
            "original"=>$file->getClientOriginalName(),
            "saved" =>"verification_files/".$fileName
        ];
    }

    public function verify(Request $request){
        if ($request->ajax()) {
            /*return Datatables::of((new CompanyDataTable())->get($request->only([
                'is_featured', 'is_status',
            ])))->make(true);*/
            return Datatables::of((new CompanyDataTable())->get([
                'is_featured', 'is_status', 'attempted'
            ]))->make(true);

        }
        /*dd(Datatables::of((new CompanyDataTable())->get([
            'is_featured', 'is_status', 'attempted'
        ]))->make(true));*/
        $datatable = new CompanyDataTable();
        //dd($datatable->get(['is_status'));
        /*dd(Datatables::of((new CompanyDataTable())->get([
            'is_featured', 'is_status', 'attempted'
        ]))->make(true));*/

        $featured = Company::IS_FEATURED;
        $statusArr = Company::STATUS;

        return view('companies.to-verify', compact('featured', 'statusArr'));
    }

    public function verifySave($id){
        $attempt = VerificationAttempt::where('company_id', $id)->first();
        $data = [
            'document' => $attempt->document,
            'verified_by' => Auth::user()->id,
        ];
        $verified = CompanyVerification::updateOrCreate(['company_id' => $id], $data);
        return $verified;
    }

    public function verifyRevoke($id){
        $revoked = CompanyVerification::find($id)->delete();
        return $this->sendSuccess('Verification successfully revoked');
    }

    public function saveVerificationDocuments(){
        if(request()->retrieve){
            $data = Setting::where('key', 'verification_documents')->first();
            if($data){
                return $this->sendResponse($data->value, 'retrieved successfully');
            }else{
                return $this->sendResponse([], 'no data');
            }
        }else{
            $documents = request()->documents;
            $save = Setting::updateOrCreate(['key'=>'verification_documents'], ['value'=>$documents]);
            return $this->sendSuccess('Required documents successfully saved');
        }
    }


    public function emailTemplates(){
        return \view('employer.email_templates.index-temp');
    }

    public function getEmailTemplates(){
        $staff = Company::whereUserId(Auth::user()->id)->first();
        $emails = EmailTemplate::where('company_id', $staff->id)->orWhereNull('company_id')->get();
        return $this->sendResponse($emails,'Data retrieved successfully');
    }

    public function showEmailTemplate($template_id){
        $template = EmailTemplate::find($template_id);
        return $this->sendResponse($template, 'Template retrieved successfully');
    }

    public function templatePlaceholder($type){
        $columns = EmailTemplate::TYPES_TABLES[$type]['columns'];
        return $this->sendResponse($columns, 'Placeholders retrieved successfully');
    }

    public function saveEmailTemplate(){
        $staff = Company::whereUserId(\Auth::user()->id)->first();
        $data = \request()->all();
        $data['company_id'] = $staff->id;
        if(isset($data['template_id'])){ // updating existing template
            $template_id = $data['template_id'];
            $updates = [
                'name' => $data['name'],
                'content' => $data['content'],
                'type' => $data['type']
            ];
            $save = EmailTemplate::find($template_id)->update($updates);
        }else{
            $save = EmailTemplate::create($data);
        }

        if($save){
            return $this->sendResponse($save, 'Template saved successfully');
        }else{
            return $this->sendResponse(null, 'Template could not be saved');
        }
    }

    public function availableTemplates($type){
        $staff = Company::whereUserId(Auth::user()->id)->first();
        $templates = EmailTemplate::whereRaw('(company_id = "'.$staff->id.'" OR company_id IS NULL) AND type = "'.$type.'"')->get();
        return $this->sendResponse($templates, 'Templates fetch successfully');
    }

    public function deleteEmailTemplate($template_id){
        $template = EmailTemplate::find($template_id);
        $staff = Company::whereUserId(Auth::user()->id)->first();
        if($staff->id == $template->company_id){
            $template->delete();
            return $this->sendResponse($template_id, 'Template deleted successfully.');
        }
        return $this->sendError('You can not delete this template');
    }
}
