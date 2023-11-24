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
            "title"             => "আশ্রয়ণ-২ প্রকল্প",
            "description"       => "আশ্রয়ণ-২ প্রকল্প প্রধানমন্ত্রীর কার্যালয়",
            "logo_light"        => "",
            "logo_dark"         => "",
            "favicon"           => "",
            "meta_image"        => "",
            "meta_title"        => "আশ্রয়ণ-২ প্রকল্প",
            "meta_description"  => "আশ্রয়ণ-২ প্রকল্প প্রধানমন্ত্রীর কার্যালয়",
            "meta_keywords"     => "আশ্রয়ণ-২ প্রকল্প",
            "social_title"      => "আশ্রয়ণ-২ প্রকল্প",
            "social_description"=> "আশ্রয়ণ-২ প্রকল্প প্রধানমন্ত্রীর কার্যালয়",
            "preloader_status"  => "Active",
            "copyright"         => "© ২০২৩ আশ্রয়ণ-২ প্রকল্প | প্রধানমন্ত্রীর কার্যালয়",
            "hit"               => "0"
        ]);
    }
}


