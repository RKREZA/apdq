<?php

return [
    'paymentgateway'  => [
        'name' => 'Payment Gateway',

        'form' => [
            'name' => 'Name',
            'code' => 'Code',
            'info' => 'Info',
            'mode' => 'Paypal Payment Mode',
            'currency' => 'Currency',

            'sandbox_paypal_client_id' => 'Sandbox Paypal Client ID',
            'sandbox_paypal_secret' => 'Sandbox Paypal Secret',
            'live_paypal_client_id' => 'Live Paypal Client ID',
            'live_paypal_secret' => 'Live Paypal Secret',

            'sandbox_stripe_key' => 'Sandbox Stripe Key',
            'sandbox_stripe_secret' => 'Sandbox Stripe Secret',
            'live_stripe_key' => 'Live Stripe Key',
            'live_stripe_secret' => 'Live Stripe Secret',
        ],

    ],

];
