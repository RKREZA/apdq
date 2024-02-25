<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Video\Entities\Video;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [1, 2, 3, 4]; // Replace with your actual category IDs

        foreach ($categories as $category_id) {
            for ($i = 1; $i <= 14; $i++) {
                Video::create([
                    'title'             => "Video Title {$i} for Category {$category_id}",
                    'description'       => "Video Description {$i} for Category {$category_id}",
                    'thumbnail_url'     => 'https://i.ytimg.com/vi/A1fghDCV7MM/hqdefault.jpg', // Replace with your actual thumbnail URL
                    'embed_html'        => '<iframe width="480" height="270" src="//www.youtube.com/embed/A1fghDCV7MM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                    'external_id'       => 'A1fghDCV7MM', // Replace with your actual external ID
                    'tag'               => "Video Tag {$i} for Category {$category_id}",
                    'category_id'       => $category_id,
                    'subcategory_id'    => 1,
                    'seo_title'         => "SEO Title {$i} for Category {$category_id}",
                    'seo_description'   => "SEO Description {$i} for Category {$category_id}",
                    'seo_keyword'       => "SEO Keyword {$i} for Category {$category_id}",
                    'like'              => rand(100, 500),
                    'love'              => rand(200, 600),
                    'haha'              => rand(0, 10),
                    'wow'               => rand(0, 30),
                    'sad'               => rand(0, 5),
                    'angry'             => rand(0, 5),
                    'dislike'           => rand(0, 5),
                    'featured'          => "Active",
                ]);
            }
        }

    }
}
