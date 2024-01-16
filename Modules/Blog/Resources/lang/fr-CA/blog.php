<?php

return [
    'blog' => 'Blog',

    'post'  => [
        'name' => 'Article',
        'names' => 'Articles',

        'form' => [
            'title' => 'Titre',
            'description' => 'Description',
            'tag' => 'Tags',
            'category_id' => 'Catégorie',
            'select_category' => 'Sélectionner la catégorie',
            'seo_title' => 'Titre SEO',
            'seo_description' => 'Description SEO',
            'seo_keyword' => 'Mot-clé SEO',
            'created_at' => 'Date de publication',
        ],

    ],

    'category' => [
        'name' => 'Catégorie d\'article',
        'names' => 'Catégories d\'articles',
        'list' => 'Liste des catégories d\'articles',

        'form' => [
            'code' => 'Code',
            'name' => 'Nom',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'Le message existe déjà dans cette catégorie'
        ]
    ],

];
