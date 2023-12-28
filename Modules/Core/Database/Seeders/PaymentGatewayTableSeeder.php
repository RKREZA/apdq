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
            'info'  => '{"mode":"sandbox","currency":"CAD","sandbox_paypal_client_id":"AWDn0qul8QVtUE20XZi0ItFvk9lkOWkZqhAOxBdnHi6UiouuAs8Bjwe4OUZBL_fzF-FE4V5H49BeiJkm","sandbox_paypal_secret":"EAqLUXAEIhxStbNTFTHt3SASfBVKaUQk15KJmNnbRaVYVGiJ4J9e58i3H_xqWszeDDna2glKKHL-bRf5","live_paypal_client_id":null,"live_paypal_secret":null
            }',
        ]);
        PaymentGateway::create([
            'name'  => 'Stripe',
            'code'  => 'stripe',
            'info'  => '{"mode":"sandbox","currency":"CAD","stripe_secret_key":null,"stripe_publishable_key":null}',
            'status' => 'Inactive'
        ]);
        // PaymentGateway::create([
        //     'name'  => 'Razorpay',
        //     'code'  => 'razorpay',
        //     'info'  => '{"razorpay_key":null,"razorpay_secret":null}',
        // ]);

    }
}


