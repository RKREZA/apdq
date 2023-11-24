<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Feedback\Entities\FeedbackCategory;

class FeedbackCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeedbackCategory::create([
            "name" => "Suggestion",
            "code" => "suggestion",
            "status" => "Active",
        ]);
        FeedbackCategory::create([
            "name" => "Issues",
            "code" => "issues",
            "status" => "Active",
        ]);
    }
}
