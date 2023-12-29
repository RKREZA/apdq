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
            'info'  => '{"mode":"sandbox","currency":"CAD","sandbox_paypal_client_id":"AWDn0qul8QVtUE20XZi0ItFvk9lkOWkZqhAOxBdnHi6UiouuAs8Bjwe4OUZBL_fzF-FE4V5H49BeiJkm","sandbox_paypal_secret":"EAqLUXAEIhxStbNTFTHt3SASfBVKaUQk15KJmNnbRaVYVGiJ4J9e58i3H_xqWszeDDna2glKKHL-bRf5","live_paypal_client_id":null,"live_paypal_secret":null}',
        ]);
        PaymentGateway::create([
            'name'  => 'Stripe',
            'code'  => 'stripe',
            'info'  => '{"mode":"sandbox","currency":"CAD","sandbox_stripe_key":"pk_test_51OSS9PBA8Vx87Buly4XFWlf5fY2netWyh2JPr0AZFncYm4HSjAUHjcDzJUGuTI41CMTgyPEAL2LxXzAR1tNVVxwJ00W0l4X6mG","sandbox_stripe_secret":"sk_test_51OSS9PBA8Vx87BullfpU0x9fhP2336kGjejdv6jYA6bnsCVP7gt2hVOAFsNGOGfbNZSoIGa3Qr1exVAh1FWLIXkV00egVgkmW1","live_stripe_key":null,"live_stripe_secret":null}',
        ]);
    }
}


