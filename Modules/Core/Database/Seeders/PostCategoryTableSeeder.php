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
            'serial'  => '1',
            'name'  => 'Blogue',
            'code'  => 'blogue',
        ]);
        PostCategory::create([
            'serial'  => '2',
            'name'  => 'Commissions',
            'code'  => 'commissions',
        ]);
        PostCategory::create([
            'serial'  => '3',
            'name'  => 'Entrevues',
            'code'  => 'entrevues',
        ]);
        PostCategory::create([
            'serial'  => '4',
            'name'  => 'Points de presse',
            'code'  => 'points-de-presse',
        ]);
        PostCategory::create([
            'serial'  => '5',
            'name'  => 'Projets de loi',
            'code'  => 'projets-de-loi',
        ]);


    }
}
