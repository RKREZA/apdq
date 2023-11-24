<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Blog\Entities\PostCategory;

class PostCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostCategory::create([
            'name'  => 'Blogue',
            'code'  => 'Blogue',
        ]);
        PostCategory::create([
            'name'  => 'Commissions',
            'code'  => 'Commissions',
        ]);
        PostCategory::create([
            'name'  => 'Entrevues',
            'code'  => 'Entrevues',
        ]);
        PostCategory::create([
            'name'  => 'Points de presse',
            'code'  => 'Points de presse',
        ]);
        PostCategory::create([
            'name'  => 'Projets de loi',
            'code'  => 'Projets de loi',
        ]);

        
    }
}
