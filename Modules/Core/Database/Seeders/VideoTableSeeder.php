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
        Video::create([
            'title'             => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
            'description'       => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
            'thumbnail_url'     => 'https://i.ytimg.com/vi/A1fghDCV7MM/hqdefault.jpg',
            'embed_html'        => '<iframe width="480" height="270" src="//www.youtube.com/embed/A1fghDCV7MM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            'external_id'       => 'A1fghDCV7MM',
            'tag'               => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
            'category_id'       => '3',
            'seo_title'         => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
            'seo_description'   => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
            'seo_keyword'       => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
            'like'              => '243',
            'love'              => '445',
            'haha'              => '1',
            'wow'               => '22',
            'sad'               => '0',
            'angry'             => '0',
            'dislike'           => '0'
        ]);

        Video::create([
            'title'             => "Pourquoi l'épicerie coûte aussi cher!",
            'description'       => "Pourquoi l'épicerie coûte aussi cher!",
            'thumbnail_url'     => 'https://i.ytimg.com/vi/M04bKQP3bhw/hqdefault.jpg',
            'embed_html'        => '<iframe width="480" height="270" src="//www.youtube.com/embed/M04bKQP3bhw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            'external_id'       => 'M04bKQP3bhw',
            'tag'               => "Pourquoi l'épicerie coûte aussi cher!",
            'category_id'       => '3',
            'seo_title'         => "Pourquoi l'épicerie coûte aussi cher!",
            'seo_description'   => "Pourquoi l'épicerie coûte aussi cher!",
            'seo_keyword'       => "Pourquoi l'épicerie coûte aussi cher!",
            'like'              => '243',
            'love'              => '445',
            'haha'              => '1',
            'wow'               => '22',
            'sad'               => '0',
            'angry'             => '0',
            'dislike'           => '0'
        ]);

        Video::create([
            'title'             => "CeNC - Commission d’enquête nationale citoyenne - Pr. Didier Raoult témoigne.",
            'description'       => "CeNC - Commission d’enquête nationale citoyenne - Pr. Didier Raoult témoigne.",
            'thumbnail_url'     => 'https://i.ytimg.com/vi/Adz8KpS4N90/hqdefault.jpg',
            'embed_html'        => '<iframe width="480" height="270" src="//www.youtube.com/embed/Adz8KpS4N90" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            'external_id'       => 'Adz8KpS4N90',
            'tag'               => "CeNC - Commission d’enquête nationale citoyenne - Pr. Didier Raoult témoigne.",
            'category_id'       => '3',
            'seo_title'         => "CeNC - Commission d’enquête nationale citoyenne - Pr. Didier Raoult témoigne.",
            'seo_description'   => "CeNC - Commission d’enquête nationale citoyenne - Pr. Didier Raoult témoigne.",
            'seo_keyword'       => "CeNC - Commission d’enquête nationale citoyenne - Pr. Didier Raoult témoigne.",
            'like'              => '243',
            'love'              => '445',
            'haha'              => '1',
            'wow'               => '22',
            'sad'               => '0',
            'angry'             => '0',
            'dislike'           => '0'
        ]);

        Video::create([
            'title'             => "Pourquoi 40% des électeurs ont voté pour la CAQ",
            'description'       => "Pourquoi 40% des électeurs ont voté pour la CAQ",
            'thumbnail_url'     => 'https://i.ytimg.com/vi/8oi86I8AZ9w/hqdefault.jpg',
            'embed_html'        => '<iframe width="480" height="270" src="//www.youtube.com/embed/8oi86I8AZ9w" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            'external_id'       => '',
            'tag'               => "Pourquoi 40% des électeurs ont voté pour la CAQ",
            'category_id'       => '3',
            'seo_title'         => "Pourquoi 40% des électeurs ont voté pour la CAQ",
            'seo_description'   => "Pourquoi 40% des électeurs ont voté pour la CAQ",
            'seo_keyword'       => "Pourquoi 40% des électeurs ont voté pour la CAQ",
            'like'              => '243',
            'love'              => '445',
            'haha'              => '1',
            'wow'               => '22',
            'sad'               => '0',
            'angry'             => '0',
            'dislike'           => '0'
        ]);

    }
}
