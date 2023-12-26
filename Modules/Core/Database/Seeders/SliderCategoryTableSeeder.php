<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Slider\Entities\SliderCategory;

class SliderCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SliderCategory::create([
            'name'  => 'Manual',
            'code'  => 'manual'
        ]);
        SliderCategory::create([
            'name'  => 'Video',
            'code'  => 'video'
        ]);
        SliderCategory::create([
            'name'  => 'Live',
            'code'  => 'live'
        ]);

    }
}
