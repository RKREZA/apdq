<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Blog\Entities\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title'             => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
            'description'       => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'tag'               => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
            'category_id'       => '3',
            'subcategory_id'    => '1',
            'seo_title'         => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
            'seo_description'   => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'seo_keyword'       => "La ministre des Transports, Geneviève Guilbault s'excuse de ne pas porté sa ceinture de sécurité.",
        ]);

        Post::create([
            'title'             => "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",
            'description'       => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'tag'               => "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",
            'category_id'       => '3',
            'subcategory_id'    => '1',
            'seo_title'         => "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",
            'seo_description'   => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'seo_keyword'       => "It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",
        ]);

        Post::create([
            'title'             => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'description'       => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'tag'               => "Lorem Ipsum is simply dummy text of the printing and typesetting industry",
            'category_id'       => '3',
            'subcategory_id'    => '1',
            'seo_title'         => "Lorem Ipsum is simply dummy text of the printing and typesetting industry",
            'seo_description'   => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'seo_keyword'       => "Lorem Ipsum is simply dummy text of the printing and typesetting industry",
        ]);


        Post::create([
            'title'             => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'description'       => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'tag'               => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'category_id'       => '3',
            'subcategory_id'    => '1',
            'seo_title'         => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'seo_description'   => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'seo_keyword'       => "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
        ]);

    }
}
