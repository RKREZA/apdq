<?php

namespace Modules\FrontEnd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Subscription\Entities\Subscription;
use Modules\Transaction\Entities\Transaction;
use Modules\PaymentGateway\Entities\PaymentGateway;
use Modules\FrontEndManager\Entities\FrontendSetting;
use DB;
use Session;
use Stripe;

class StripeController extends Controller
{
    function __construct()
	{

	}

    public function stripe_post(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $subscription = Subscription::findOrFail($request->subscription_id);
            $payment_gateway        = PaymentGateway::where('code','stripe')->first();
            $payment_gateway_info   = json_decode($payment_gateway->info, true);
            if (isset($payment_gateway_info['mode']) && $payment_gateway_info['mode'] === 'sandbox') {
                $stripe_secret = $payment_gateway_info['sandbox_stripe_secret'];
            } else {
                $stripe_secret = $payment_gateway_info['live_stripe_secret'];
            }

            Stripe\Stripe::setApiKey($stripe_secret);
            $response = Stripe\Charge::create ([
                    "amount"        => $subscription->price,
                    "currency"      => $payment_gateway_info['currency'],
                    "source"        => $request->stripeToken,
                    "description"   => $subscription->name,
            ]);

            // dd($response->status);

            if($response->status == 'succeeded'){
                $transaction                    = new Transaction;
                $transaction->transaction_id    = $response['id'];
                $transaction->subscription_id   = $request->subscription_id;
                $transaction->user_id           = auth()->user()->id;
                $transaction->paymentgateway_id = $payment_gateway->id;
                $transaction->status            = 'Paid';
                $transaction->payment_amount    = $response['amount_captured'];
                $transaction->email             = auth()->user()->email;

                $transaction->data              = json_encode([
                    'product_name' => $subscription->title,
                    'quantity'     => 1,
                    'payer_name'   => $response['billing_details']['name'] ?? null,
                    'receipt'      => $response['receipt_url']
                ]);
                $transaction->save();
            }else{
                DB::rollBack();
                $error_msg    = "Paiement annulé";
                return redirect()->route('frontend.subscription')->with('error', $error_msg);
            }

            DB::commit();
            $success_msg = "Vous avez été abonné avec succès";
            return redirect()->route('dashboard')->with('success', $success_msg);
        } catch (Exception $e) {
            DB::rollBack();
            $error_msg    = "Paiement annulé";
            return redirect()->route('frontend.subscription')->with('error', $error_msg);
        }
    }

}
