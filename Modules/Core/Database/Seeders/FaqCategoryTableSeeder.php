<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Faq\Entities\FaqCategory;

class FaqCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FaqCategory::create([
            "name" => "Subscription",
            "code" => "subscription",
            "status" => "Active",
        ]);
        FaqCategory::create([
            "name" => "Payment",
            "code" => "payment",
            "status" => "Active",
        ]);
    }
}
