<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;
use Modules\Setting\Entities\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            "title" => "APDQ",
            "description" => "",
            "logo_dark" => null,
            "logo_light" => null,
            "favicon" => "/assets/backend/img/favicon.webp",
            "meta_image" => null,
            "meta_title" => null,
            "meta_description" => null,
            "meta_keywords" => null,
            "social_title" => null,
            "social_description" => null,
            "preloader_status" => "Inactive",
            "back_to_top_status" => "Active",
            "copyright" => null
        ]);
    }
}
