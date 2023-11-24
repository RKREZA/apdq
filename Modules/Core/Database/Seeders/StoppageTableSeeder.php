<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Stoppage\Entities\Stoppage;

class StoppageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stoppage::create([
            'name'  => 'Binodpur (A)',
            'slug'  => 'binodpur-a',
            'lat'   => '24.367111171412393',
            'lon'   => '88.64251953372953',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Binodpur (B)',
            'slug'  => 'binodpur-b',
            'lat'   => '24.367059862531374',
            'lon'   => '88.64254903802869',
            'city_id'   => '2',
        ]);
        // ..................................1,2

        Stoppage::create([
            'name'  => 'Kajla Gate (A)',
            'slug'  => 'kajla-gate-a',
            'lat'   => '24.363849911487875',
            'lon'   => '88.63175431473253',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Kajla Gate (B)',
            'slug'  => 'kajla-gate-b',
            'lat'   => '24.3638370839389',
            'lon'   => '88.63179924173353',
            'city_id'   => '2',
        ]);
        // ..................................3,4

        Stoppage::create([
            'name'  => 'Talaimari (A)',
            'slug'  => 'talaimari-a',
            'lat'   => '24.361794399199468',
            'lon'   => '88.62734823474884',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Talaimari (B)',
            'slug'  => 'talaimari-b',
            'lat'   => '24.361603815241786',
            'lon'   => '88.62701832304',
            'city_id'   => '2',
        ]);
        // ..................................5,6

        Stoppage::create([
            'name'  => 'Alu Potti (A)',
            'slug'  => 'alu-potti-a',
            'lat'   => '24.362884171684346',
            'lon'   => '88.60561124935151',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Alu Potti (B)',
            'slug'  => 'alu-potti-b',
            'lat'   => '24.362743678338084',
            'lon'   => '88.60559783830644',
            'city_id'   => '2',
        ]);
        // ..................................7,8

        Stoppage::create([
            'name'  => 'Shaheb Bazar (A)',
            'slug'  => 'shaheb-bazar-a',
            'lat'   => '24.36572845978526',
            'lon'   => '88.59878927116395',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Shaheb Bazar (B)',
            'slug'  => 'shaheb-bazar-b',
            'lat'   => '24.365645387345193',
            'lon'   => '88.59858542327882',
            'city_id'   => '2',
        ]);
        // ..................................9,10

        Stoppage::create([
            'name'  => 'Madrasha Mor (A)',
            'slug'  => 'madrasha-mor-a',
            'lat'   => '24.367316885593794',
            'lon'   => '88.58924137977274',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Madrasha Mor (B)',
            'slug'  => 'madrasha-mor-b',
            'lat'   => '24.367187391921785',
            'lon'   => '88.58913006809864',
            'city_id'   => '2',
        ]);
        // ..................................11,12

        Stoppage::create([
            'name'  => 'C & B Mor (A)',
            'slug'  => 'c-b-mor-a',
            'lat'   => '24.368393055945386',
            'lon'   => '88.58106768791559',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'C & B Mor (B)',
            'slug'  => 'c-b-mor-b',
            'lat'   => '24.368329531304795',
            'lon'   => '88.58096576397304',
            'city_id'   => '2',
        ]);
        // ..................................13,14

        Stoppage::create([
            'name'  => 'Court (A)',
            'slug'  => 'court-a',
            'lat'   => '24.37203206142111',
            'lon'   => '88.5643756376032',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Court (B)',
            'slug'  => 'court-b',
            'lat'   => '24.37198197612893',
            'lon'   => '88.56434412164728',
            'city_id'   => '2',
        ]);
        // ..................................15,16

        Stoppage::create([
            'name'  => 'Vodra (A)',
            'slug'  => 'vodra-a',
            'lat'   => '24.374860959204597',
            'lon'   => '88.62210161653287',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Vodra (B)',
            'slug'  => 'vodra-b',
            'lat'   => '24.374785222156607',
            'lon'   => '88.62172074285276',
            'city_id'   => '2',
        ]);
        // ..................................17,18

        Stoppage::create([
            'name'  => 'Rail Gate (A)',
            'slug'  => 'rail-gate-a',
            'lat'   => '24.37448431963616',
            'lon'   => '88.60379639073791',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Rail Gate (B)',
            'slug'  => 'rail-gate-b',
            'lat'   => '24.374397985250823',
            'lon'   => '88.6042407867027',
            'city_id'   => '2',
        ]);
        // ..................................19,20

        Stoppage::create([
            'name'  => 'Am Chottor (A)',
            'slug'  => 'Am-Chottor-a',
            'lat'   => '24.408239477580253',
            'lon'   => '88.60870130029447',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Am Chottor (B)',
            'slug'  => 'Am-Chottor-b',
            'lat'   => '24.4087963628313',
            'lon'   => '88.60863692727811',
            'city_id'   => '2',
        ]);
        // ..................................21,22

        Stoppage::create([
            'name'  => 'Biman Chottor (A)',
            'slug'  => 'Biman-Chottor-a',
            'lat'   => '24.39029571136649',
            'lon'   => '88.60800929036863',
            'city_id'   => '2',
        ]);

        Stoppage::create([
            'name'  => 'Biman Chottor (B)',
            'slug'  => 'Biman-Chottor-b',
            'lat'   => '24.390334796665393',
            'lon'   => '88.60785372224576',
            'city_id'   => '2',
        ]);
        // ..................................23,24
    }
}
