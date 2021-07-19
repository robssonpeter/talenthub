<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCertificateCategoryRequest;
use App\Http\Requests\CreateIndustryRequest;
use App\Http\Requests\UpdateCertificateCategoryRequest;
use App\Http\Requests\UpdateIndustryRequest;
use App\Models\Candidate;
use App\Models\CertificateCategory;
use App\Models\Company;
use App\Models\Industry;
use App\Queries\CertificateCategoryDataTable;
use App\Repositories\CertificateCategoryRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class CertificateCategoriesController extends AppBaseController
{
    /** @var  IndustryRepository */
    private $certificateCategoryRepository;

    public function __construct(CertificateCategoryRepository $certificateCategoryRepo)
    {
        $this->certificateCategoryRepository = $certificateCategoryRepo;
    }

    /**
     * Display a listing of the Industry.
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
            return Datatables::of((new CertificateCategoryDataTable())->get())->make(true);
        }

        return view('certificate_categories.index');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  CreateCertificateCategoryRequest  $request
     *
     * @return JsonResource
     */
    public function store(CreateCertificateCategoryRequest $request)
    {
        $input = $request->all();
        $this->certificateCategoryRepository->create($input);

        return $this->sendSuccess('Category saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CertificateCategory  $category
     *
     * @return JsonResponse
     */
    public function edit(CertificateCategory $category)
    {
        return $this->sendResponse($category, 'Categories Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified Industry.
     *
     * @param  CertificateCategory  $category
     *
     * @return JsonResource
     */
    public function show(CertificateCategory $category)
    {
        return $this->sendResponse($category, 'Category Retrieved Successfully.');
    }

    /**
     * Update the specified Industry in storage.
     *
     * @param  UpdateCertificateCategoryRequest  $request
     * @param  CertificateCategory  $category
     *
     * @return JsonResource
     */
    public function update(UpdateCertificateCategoryRequest $request, CertificateCategory $category)
    {
        $input = $request->all();
        $this->certificateCategoryRepository->update($input, $category->id);

        return $this->sendSuccess('Category updated successfully.');
    }

    /**
     * Remove the specified Industry from storage.
     *
     * @param  CertificateCategory  $category
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(CertificateCategory $category)
    {
        $Models = [
            Candidate::class,
            Company::class,
        ];
        /*$result = canDelete($Models, 'certificate_category_id', $category->id);
        if ($result) {
            return $this->sendError('Category can\'t be deleted.');
        }*/
        $category->delete();

        return $this->sendSuccess('Category deleted successfully.');
    }
}
