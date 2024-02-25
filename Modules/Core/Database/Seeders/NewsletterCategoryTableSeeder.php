<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Newsletter\Entities\NewsletterCategory;

class NewsletterCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsletterCategory::create([
            'serial'  => '1',
            'name'  => 'General',
            'code'  => 'general',
        ]);
        NewsletterCategory::create([
            'serial'  => '2',
            'name'  => 'Live',
            'code'  => 'live',
        ]);

    }
}
