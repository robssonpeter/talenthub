<?php


namespace App\Functionalities;


use App\Models\Payment;
use App\Models\Subscription;
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
}
