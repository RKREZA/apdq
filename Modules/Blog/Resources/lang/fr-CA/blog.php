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
            'subcategory_id' => 'Sous catégorie',
            'select_category' => 'Sélectionner la catégorie',
            'select_subcategory' => 'Sélectionner la sous catégorie',
            'seo_title' => 'Titre SEO',
            'seo_description' => 'Description SEO',
            'seo_keyword' => 'Mot-clé SEO',
            'created_at' => 'Date de publication',
            'post_information' => 'Informations sur la article',
            'content_type' => 'Type de contenu'
        ],

    ],

    'category' => [
        'name' => 'Catégorie d\'article',
        'names' => 'Catégories d\'articles',
        'list' => 'Liste des catégories d\'articles',

        'form' => [
            'serial' => 'En série',
            'code' => 'Code',
            'name' => 'Nom',
            'description' => 'Description',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'Le message existe déjà dans cette catégorie'
        ]
    ],

    'subcategory' => [
        'name' => 'Sous catégorie d\'article',
        'names' => 'Sous catégories d\'articles',
        'list' => 'Liste des sous catégories d\'articles',

        'form' => [
            'serial' => 'En série',
            'code' => 'Code',
            'name' => 'Nom',
            'description' => 'Description',
        ],

        'message' => [
            'error_video_exist_with_this_subcategory' => 'Le message existe déjà dans cette sous catégorie'
        ]
    ],

];
