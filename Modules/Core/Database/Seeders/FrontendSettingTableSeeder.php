<?php

namespace Modules\Core\Database\Seeders;

use Modules\FrontEndManager\Entities\FrontendSetting;

use Illuminate\Database\Seeder;

class FrontendSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontendSetting::create([
            "title"             => "APDQ",
            "description"       => "",
            "logo_light"        => "",
            "logo_dark"         => "",
            "favicon"           => "",
            "meta_image"        => "",
            "meta_title"        => "",
            "meta_description"  => "",
            "meta_keywords"     => "",
            "social_title"      => "",
            "social_description"=> "",
            "preloader_status"  => "Active",
            "copyright"         => "© 2023",
            "hit"               => "0"
        ]);
    }
}


