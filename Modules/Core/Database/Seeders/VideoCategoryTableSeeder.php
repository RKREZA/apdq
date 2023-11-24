<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Video\Entities\VideoCategory;

class VideoCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoCategory::create([
            'name'  => 'Blogue',
            'code'  => 'Blogue',
        ]);
        VideoCategory::create([
            'name'  => 'Commissions',
            'code'  => 'Commissions',
        ]);
        VideoCategory::create([
            'name'  => 'Entrevues',
            'code'  => 'Entrevues',
        ]);
        VideoCategory::create([
            'name'  => 'Points de presse',
            'code'  => 'Points de presse',
        ]);
        VideoCategory::create([
            'name'  => 'Projets de loi',
            'code'  => 'Projets de loi',
        ]);

        
    }
}
