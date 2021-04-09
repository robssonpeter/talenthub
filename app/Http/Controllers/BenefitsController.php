<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBenefitRequest;
use App\Http\Requests\UpdateBenefitRequest;
use App\Models\Candidate;
use App\Models\Benefit;
use App\Queries\BenefitsDataTable;
use App\Repositories\BenefitRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class BenefitsController extends AppBaseController
{
    /** @var  BenefitRepository */
    private $benefitsRepository;

    public function __construct(BenefitRepository $benefitsRepo)
    {
        $this->benefitRepository = $benefitsRepo;
    }

    /**
     * Display a listing of the Benefit.
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
            return Datatables::of((new BenefitsDataTable())->get())->make(true);
        }

        return view('benefits.index');
    }

    /**
     * Store a newly created Benefit in storage.
     *
     * @param  CreateBenefitRequest  $request
     *
     * @return JsonResource
     */
    public function store(CreateBenefitRequest $request)
    {
        $input = $request->all();

//        return $this->sendResponse($input, json_encode($input));
        Benefit::create($input);
        //$this->benefitsRepository->create(['name'=> 'health insurance', 'description' => 'hellow there']);

        return $this->sendSuccess('Benefit saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Benefit  $benefits
     *
     * @return JsonResponse
     */
    public function show(Benefit $benefits)
    {
        return $this->sendResponse($benefits, 'Benefits Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified Benefit.
     *
     * @param  Benefit  $benefits
     *
     * @return JsonResource
     */
    public function edit($benefits)
    {
        $benefits = Benefit::find($benefits);
        return $this->sendResponse($benefits, 'Benefits Retrieved Successfully.');
    }

    /**
     * Update the specified Benefit in storage.
     *
     * @param  UpdateBenefitRequest  $request
     * @param  Benefit  $benefits
     *
     * @return JsonResource
     */
    public function update($benefit)
    {
        $input = \request()->all();
        $benefits = Benefit::where('id', $benefit)->first();
        $benefits->update($input);

        return $this->sendSuccess('Benefit updated successfully.');
    }

    /**
     * Remove the specified Benefit from storage.
     *
     * @param  Benefit  $benefits
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(Benefit $benefit)
    {
        $benefit->delete();

        return $this->sendSuccess('Benefit deleted successfully.');
    }
}
