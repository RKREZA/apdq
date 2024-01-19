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
            'name'  => 'Entrevues',
            'code'  => 'entrevues',
            'icon'  => '<i class="fi fi-ss-podium-star"></i>',
            'description' => 'Des entretiens instructifs avec des leaders, experts et personnalités influentes.'
        ]);
        VideoCategory::create([
            'name'  => 'Points de presse',
            'code'  => 'points-de-presse',
            'icon'  => '<i class="fi fi-ss-memo-pad"></i>',
            'description' => 'Nouvelles mises à jour et annonces officielles décryptées.'
        ]);
        VideoCategory::create([
            'name'  => 'Période de questions',
            'code'  => 'période-de-questions',
            'icon'  => '<i class="fi fi-ss-shield-interrogation"></i>',
            'description' => 'Perspectives issues des séances de questions-réponses avec des acteurs clés'
        ]);
        VideoCategory::create([
            'name'  => 'Projets de loi',
            'code'  => 'projets-de-loi',
            'icon'  => '<i class="fi fi-ss-gavel"></i>',
            'description' => 'Exploration des initiatives législatives proposées et leurs implications.'
        ]);

    }
}
