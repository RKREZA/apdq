<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Blog\Entities\PostSubcategory;

class PostSubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostSubcategory::create([
            'serial'  => '1',
            'name'  => 'Others',
            'code'  => 'others',
            'description' => 'Others'
        ]);
    }
}
