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
            'code'  => 'blogue',
        ]);
        PostCategory::create([
            'name'  => 'Commissions',
            'code'  => 'commissions',
        ]);
        PostCategory::create([
            'name'  => 'Entrevues',
            'code'  => 'entrevues',
        ]);
        PostCategory::create([
            'name'  => 'Points de presse',
            'code'  => 'points-de-presse',
        ]);
        PostCategory::create([
            'name'  => 'Projets de loi',
            'code'  => 'projets-de-loi',
        ]);


    }
}
