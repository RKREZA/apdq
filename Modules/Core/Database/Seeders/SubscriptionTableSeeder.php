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
            'title'                     => 'Forfait un',
            'option_ad_free'            => 'Active',
            'option_live_content'       => 'Inactive',
            'option_premium_content'    => 'Inactive',
            'trial_days'                => '14',
            'duration'                  => '30',
            'duration_type'             => 'Day(s)',
            'price'                     => '10'
        ]);

        Subscription::create([
            'title'                     => 'Forfait deux',
            'option_ad_free'            => 'Active',
            'option_live_content'       => 'Active',
            'option_premium_content'    => 'Active',
            'trial_days'                => '14',
            'duration'                  => '30',
            'duration_type'             => 'Day(s)',
            'price'                     => '50'
        ]);

    }
}
