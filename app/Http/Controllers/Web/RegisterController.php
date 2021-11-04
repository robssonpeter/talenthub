<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\WebRegisterRequest;
use App\Repositories\WebRegisterRepository;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class RegisterController extends AppBaseController
{
    /** @var  WebRegisterRepository */
    private $webRegisterRepository;

    public function __construct(WebRegisterRepository $webRegisterRepository)
    {
        $this->webRegisterRepository = $webRegisterRepository;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('web.auth.register');
    }

    /**
     * @param  WebRegisterRequest  $request
     *
     * @throws \Throwable
     *
     * @return JsonResource
     */
    public function register(WebRegisterRequest $request)
    {
        $validator = $request->validate([
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $input = $request->all();
        $this->webRegisterRepository->store($input);
        $userType = ($input['type'] == 1) ? 'Candidate' : 'Employer';
        $message = 'Please follow the verification link sent to \n'.$input['email'].' to verify your account. If you can not see your email, kindly check your spam folder.';
        Flash::success('Successfully registered, Please follow the verification link sent to <strong>'.$input['email'].'</strong>');
        session()->flash('registered', $message);
        return $this->sendSuccess("{$userType} registration done successfully.");
    }
}
