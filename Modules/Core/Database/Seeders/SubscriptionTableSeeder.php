<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Subscription\Entities\Subscription;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::create([
            'title'         => 'Forfait un',
            'description'   => 'Sans publicité (avec 14 jours d\'essai)',
            'duration'      => '30',
            'duration_type' => 'Day(s)',
            'price'         => '10'
        ]);

        Subscription::create([
            'title'         => 'Forfait deux',
            'description'   => 'Sans publicité <br> Flux en direct',
            'duration'      => '30',
            'duration_type' => 'Day(s)',
            'price'         => '50'
        ]);

    }
}
