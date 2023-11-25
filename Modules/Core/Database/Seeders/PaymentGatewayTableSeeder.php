<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\PaymentGateway\Entities\PaymentGateway;

class PaymentGatewayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentGateway::create([
            'name'  => 'Paypal',
            'code'  => 'paypal',
            'info'  => '{"mode":"sandbox","paypal_client_id":null,"paypal_secret":null}',
        ]);
        // PaymentGateway::create([
        //     'name'  => 'Stripe',
        //     'code'  => 'stripe',
        //     'info'  => '{"stripe_secret_key":null,"stripe_publishable_key":null}',
        // ]);
        // PaymentGateway::create([
        //     'name'  => 'Razorpay',
        //     'code'  => 'razorpay',
        //     'info'  => '{"razorpay_key":null,"razorpay_secret":null}',
        // ]);

    }
}


