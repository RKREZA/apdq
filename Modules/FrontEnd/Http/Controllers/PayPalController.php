<?php

namespace Modules\FrontEnd\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Modules\Subscription\Entities\Subscription;
use Modules\Transaction\Entities\Transaction;
use Modules\PaymentGateway\Entities\PaymentGateway;
use DB;

class PayPalController extends Controller
{
    private $provider;
    function __construct()
	{
        $this->provider = new PayPalClient;
	}

    public function paypal(Request $request)
    {
        $subscription   = Subscription::find(request()->subscription_id);
        $paymentgateway = PaymentGateway::where('code', 'paypal')->first();

        if (!$subscription) {
            abort(404);
        }

        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent"                => "CAPTURE",
                "application_context"   => [
                    "return_url" => route('frontend.paypal.success'),
                    "cancel_url" => route('frontend.paypal.cancel')
                ],
                "purchase_units"        => [
                    [
                        "amount" => [
                            "currency_code" => config('paypal.currency'),
                            "value" => $subscription->price
                        ]
                    ]
                ]
            ]);

            // dd($response);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        // Save necessary information in sessions or database before redirecting
                        session()->put([
                            'product_name'      => $subscription->title,
                            'quantity'          => 1,
                            'subscription_id'   => request()->subscription_id,
                            'user_id'           => auth()->user()->id,
                            'paymentgateway_id' => $paymentgateway->id,
                        ]);

                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('frontend.paypal.cancel')->with('error', 'Quelque chose s\'est mal passé ! Veuillez contacter l\'administrateur pour résoudre le problème.');
            }
        } catch (\Exception $e) {
            // Log the error or handle it in a way that suits your application
            return redirect()->route('frontend.paypal.cancel')->with('error', 'Une erreur s\'est produite lors du processus de paiement PayPal.');
        }
    }

    public function success(Request $request)
    {
        DB::beginTransaction();
        try {
            $provider       = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken    = $provider->getAccessToken();
            $response       = $provider->capturePaymentOrder($request->token);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {

                $payment                    = new Transaction;
                $payment->transaction_id    = $response['id'];
                $payment->subscription_id   = session()->get('subscription_id');
                $payment->user_id           = session()->get('user_id');
                $payment->paymentgateway_id = session()->get('paymentgateway_id');
                $payment->status            = 'Paid';
                $payment->payment_amount    = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
                $payment->email             = $response['payer']['email_address'];

                $payment->data              = json_encode([
                    'product_name' => session()->get('product_name'),
                    'quantity'     => session()->get('quantity'),
                    'payer_name'   => $response['payer']['name']['given_name']
                ]);
                $payment->save();

                unset($_SESSION['product_name']);
                unset($_SESSION['quantity']);
                unset($_SESSION['subscription_id']);
                unset($_SESSION['user_id']);
                unset($_SESSION['paymentgateway_id']);

                $success_msg = "Vous avez été abonné avec succès";
                DB::commit(); // Move the commit inside the try block
                return redirect()->route('dashboard')->with('success', $success_msg);
            } else {
                return redirect()->route('frontend.paypal.cancel');
            }

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('frontend.paypal.cancel');
        }
    }
    public function cancel()
    {
        $error_msg    = "Paiement annulé";
        return redirect()->route('frontend.subscription')->with('error',$error_msg);
    }
}
