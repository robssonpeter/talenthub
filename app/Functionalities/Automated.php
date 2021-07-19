<?php


namespace App\Functionalities;


use App\Models\Alert;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\User;
use App\Repositories\SubscriptionRepository;
use \Laravel\Cashier\Subscription;
use App\Models\SubscriptionCharge;
use App\Models\Transaction;
use Carbon\Carbon;
use Spatie\ArrayToXml\ArrayToXml;

class Automated
{
    public static function SubscriptionRenewal(){
        // Check available active subscription
        $currentDate = Carbon::now()->format('Y-m-d');
        $now = Carbon::now()->toDateTimeString();

        $subscriptions = Subscription::whereNull('ends_at')
                            ->where('current_period_end', '>=', $now)
                            ->orderBy('id', 'DESC')

                            /*->groupBy('user_id')*/
                            ->get();

         $iterated = [];
         foreach ($subscriptions as $subscription){
             if(in_array($subscription->user_id, $iterated)){
                continue;
             }
             $transaction = Transaction::where('user_id', $subscription->user_id)
                                ->where('owner_type', 'App\Models\Subscription')
                                ->orderBy('id', 'DESC')
                                ->first();
             $payment = Payment::find($transaction->invoice_id);
             // Charge the token
             $chargeDetails = Self::ChargeToken($payment->token);
         }
        return $subscriptions;
    }

    public function createPaymentToken($plan_id, $user_id, $alert = false){
        $plan = Plan::find($plan_id);
        $payment = [
            'user_id' => $user_id,
            'type' => 'subscription',
            'currency' => $plan->currency->currency_icon,
            'items' => json_encode([['plan' => $plan_id]]),
            'amount' => $plan->amount,
        ];
        $payment = Payment::create($payment);
        if($alert){
            // create a notification for the user
            $alert_data = [
                'user_id' => $user_id,
                'title' => null,
                'message' => 'Please take action to renew your subscription',
                'dismissible' => true,
                'type' => 'danger',
                'link' => '',
                'link_text' => 'Make Payment',
            ];
            Alert::create($alert_data);
        }
    }

    public static function ChargeToken($token){
        $details = [
            'CompanyToken' => env('DPO_COMPANY_TOKEN'),
            'Request' => 'chargeTokenAuth',
            'TransactionToken' => $token
        ];
        $xml = ArrayToXml::convert($details, 'API3G');
        $xmlRequest = FeedData::xmlRequest($xml, env('DPO_TOKEN_VERIFICATION_URL'), 'POST');
        $result = FeedData::parseXML($xmlRequest);

        if((string) $result['Result'] == "000"){
            $payment = Payment::where('token', $token)->first();
            $data = [
                'payment_id' => $payment->id,
                'charged' => 1
            ];
            $charged = SubscriptionCharge::create($data);
        }
        return $result;
    }

    public static function checkEndingSubscription($now = null){
        //$now = Carbon::now()->toDateTimeString();
        $now = is_null($now)?Carbon::now()->format('Y-m-d'):$now;
        $subscriptions = self::subscriptionsEndingToday($now);
        foreach($subscriptions as $subscription){
            // if the subscription is cancelled and no other active subscription fall back to trial
            if($subscription->cancelled() && $subscription->active()){
                $trialActivated = self::activateTrialSubscription($subscription->user_id);
            }else if($subscription->active()){
                // else if subscription is not cancelled and is currently the active one renew the subscription

                // create an alert that the subscription has expired for the user to take necessary action to renew the subscription
                $alertData = [
                    'user_id' => $subscription->user_id,
                    'message' => 'Your subscription has expired!',
                    'dismissible' => true,
                    'type' => 'danger',
                    'link' => Alert::encodeLink('subscription.renew', ['subscription_id' => $subscription->id]),
                    'link_text' => 'Renew'
                ];

                $alerted = Alert::create($alertData);

                // activate trial subscription
                if($alerted){
                    $trialActivated = self::activateTrialSubscription($subscription->user_id);
                }
            }
        }
    }

    public static function subscriptionsEndingToday($now = null){
        $now = is_null($now)?Carbon::now()->format('Y-m-d'):$now;
        //$now = '2021-06-09';
        $endingSubscriptions = Subscription::where('current_period_end', 'LIKE', '%'.$now.'%')->get();
        return $endingSubscriptions;
    }

    public static function activateTrialSubscription($user_id){
        $user = User::find($user_id);

        $subscriptionRepo = app(SubscriptionRepository::class);

        $result = $subscriptionRepo->createStripeCustomer($user);

        return $result;
    }
}
