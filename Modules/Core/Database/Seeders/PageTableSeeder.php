<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Cms\Entities\Page;
use Modules\Cms\Entities\PageCategory;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = PageCategory::create([
            'name'          => 'General',
            'code'          => 'general',
        ]);
        Page::create([
            'title'         => 'Termes et conditions',
            'slug'          => 'termes-et-conditions',
            'category_id'   => $category->id,
        ]);
        Page::create([
            'title'         => 'Politique de confidentialité',
            'slug'          => 'politique-de-confidentialite',
            'category_id'   => $category->id,
        ]);

    }
}
