<?php

return [
    'paymentgateway'  => [
        'name' => 'Passerelle de paiement',

        'form' => [
            'name' => 'Nom',
            'code' => 'Code',
            'info' => 'Info',
            'mode' => 'Mode de paiement Paypal',
            'currency' => 'Devise',
            'sandbox_paypal_client_id' => 'Identifiant client PayPal Sandbox',
            'sandbox_paypal_secret' => 'Secret client PayPal Sandbox',
            'live_paypal_client_id' => 'Identifiant client PayPal en direct',
            'live_paypal_secret' => 'Secret client PayPal en direct',
        ],

    ],

];
