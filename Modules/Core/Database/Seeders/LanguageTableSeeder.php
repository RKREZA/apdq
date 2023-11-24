<?php

namespace Modules\Core\Database\Seeders;

use Modules\Language\Entities\Language;

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'code' => 'bn',
            'name' => 'বাংলা',
            'status' => 'Active',
            'default' => 'Inactive',
        ]);

        Language::create([
            'code' => 'en',
            'name' => 'English',
            'status' => 'Active',
            'default' => 'Active',
        ]);
    }
}
