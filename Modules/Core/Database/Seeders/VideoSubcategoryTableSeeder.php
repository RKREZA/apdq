<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Video\Entities\VideoSubcategory;

class VideoSubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoSubcategory::create([
            'serial'  => '1',
            'name'  => 'Others',
            'code'  => 'others',
            'description' => 'Others'
        ]);
    }
}
