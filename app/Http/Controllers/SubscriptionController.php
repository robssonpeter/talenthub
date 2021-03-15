<?php


namespace App\Http\Controllers;


use App\Functionalities\FeedData;
use App\Models\Company;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\SalaryCurrency;
use App\Models\Subscription;
use App\Models\User;
use App\Repositories\PlanRepository;
use App\Repositories\SubscriptionRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\ArrayToXml\ArrayToXml;
use Stripe\Checkout\Session;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class SubscriptionController extends AppBaseController
{
    private $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @throws Exception
     * @return Factory|View
     *
     */
    public function index()
    {
        /** @var PlanRepository $planRepo */
        $planRepo = app(PlanRepository::class);
        $plans = $planRepo->getPlans();

        return view('pricing.index')->with($plans);
    }


    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function purchaseSubscription(Request $request)
    {
        $planId = $request->get('plan_id');
        if (empty($planId)) {
            throw new Exception('plan_id required', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var Plan $plan */
        $plan = Plan::findOrFail($planId);

        /** @var User $user */
        $user = Auth::user();
        $company = Company::whereUserId(Auth::user()->id)->first();
        $currency = SalaryCurrency::find($plan->currency_id);

        $userEmail = isset($user->email) ? $user->email : null;
        $items = [
            ['plan' => $plan->id]
        ];
        $data = [
            'user_id' => Auth::user()->id,
            'type' => 'subscription',
            'items' => json_encode($items),
            'currency' => $currency->currency_icon,
            'amount' => $plan->amount,

        ];
        $payment = Payment::create($data);

        $xmlRequest = ArrayToXml::convert([
            'CompanyToken' => env('DPO_COMPANY_TOKEN'),
            'Request' => 'createToken',
            'Transaction' => [
                'PaymentAmount' => $plan->amount,
                'PaymentCurrency' => $currency->currency_icon,
                'TransactionChargeType' => 2,
                'RedirectURL' => url('employer/payment-success')."?session_id=".$payment->id,
                'BackURL' => url('employer/manage-subscriptions'),
                'DeclinedURL' => url('failed-payment'),
                'customerEmail' => Auth::user()->email,
                'customerFirstName' => Auth::user()->first_name,
                'customerLastName' => isset(Auth::user()->first_name[0])?Auth::user()->first_name[0]:'',
                'customerAddress' => $company->address_line_1,
                'customerCity' => $company->location,
                'customerCountry' => 'TZ',
                'customerPhone' => Auth::user()->phone,
            ],
            'Services' => [
                'Service' => [
                    'ServiceType' => 5525,
                    'ServiceDescription' => 'Subscription',
                    'ServiceDate' => '2013/12/20 19:00'
                ]
            ]
        ], 'API3G');


        $receivedXML = FeedData::xmlRequest($xmlRequest, env('DPO_TOKEN_CREATE_URL'), 'POST');

        $result = FeedData::parseXML($receivedXML);


        /*setStripeApiKey();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email'       => $userEmail,
            'subscription_data'    => [
                'items' => [
                    ['plan' => $plan->stripe_plan_id],
                ],
            ],
            'success_url'          => url('employer/payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => url('employer/failed-payment?error=payment_cancelled'),
        ]);
        $result = [
            'sessionId' => $session['id'],
        ];*/
        $transToken = (string) $result->TransToken;
        $referenceNumber = (string) $result->TransRef;

        /*Update the token into the database*/
        Payment::where('id', $payment->id)->update(['token' => $transToken, 'ref_no' => $referenceNumber]);

        $result = [
            'sessionId' => $payment->id,
            'token' => $transToken,
            'payment_url' => str_replace('{token}', $transToken, env('DPO_PAYMENT_URL'))
        ];

        return $this->sendResponse($result, 'Subscription resumed successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return RedirectResponse|Redirector
     */
    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');
        $transactionToken = $request->get('TransactionToken');
        $verificationDetails = [
            'CompanyToken' => env('DPO_COMPANY_TOKEN'),
            'Request' => 'verifyToken',
            'TransactionToken' => $request->get('TransactionToken'),
        ];
        $xml = ArrayToXml::convert($verificationDetails, 'API3G');
        $xmlRequest = FeedData::xmlRequest($xml, env('DPO_TOKEN_VERIFICATION_URL'), 'POST');
        $result = FeedData::parseXML($xmlRequest);

        switch ((string) $result->Result){
            case ('000'): // paid
                $paid = 1;
                break;
            case ('900'): //not paid yet
                $paid = null;
                break;
            case (901): // declined
                $paid = 0;
                break;
            default:
                $paid=null;
        }
        $payment = Payment::where('token', $request->get('TransactionToken'))->update(['paid' => $paid]);


        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }else if(empty($transactionToken)){
            throw new UnprocessableEntityHttpException('Transaction Token is required');
        }


        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscriptionRepo->purchaseSubscription($sessionId);

        if($paid){
            return redirect(route('manage-subscription.index'))->with('success', 'Payment Successfully Processed');
        }else{
            return redirect(route('manage-subscription.index'));
        }

    }

    /**
     * @return Factory|View
     */
    public function handleFailedPayment()
    {
        return view('transactions.failed_payments');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function cancelSubscription(Request $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = Auth::user();

        setStripeApiKey();
        /** @var Subscription $subscription */
        $subscription = $user->subscriptions()->active()->first();

        if (! $subscription) {
            return $this->sendError('Yor are not author of subscription. so you are not allowed to cancel this subscription.');
        }

        $subscription->cancellation_reason = $input['cancellation_reason'];
        $subscription->save();

        $subscription->cancel();

        return $this->sendSuccess('Subscription cancelled successfully.');
    }

    /**
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function purchaseTrialSubscription()
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);

        $result = $subscriptionRepo->createStripeCustomer($user);

        return $this->sendResponse($result, 'Subscription resumed successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return bool
     */
    public function updateSubscription(Request $request)
    {
        $stripeWebHookSecret = config('services.stripe.webhook_secret_key');
        $data = $request->all();

        $payload = @file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sigHeader, $stripeWebHookSecret
            );
            $input = $request->all();
            $this->subscriptionRepository->updateSubscription($input);

            return true;
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }
    }
}
