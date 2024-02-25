<?php

return [
    'video'  => [
        'name' => 'Vidéo',
        'names' => 'Vidéos',

        'form' => [
            'title' => 'Titre',
            'description' => 'Description',
            'embed_html' => 'Code d\'intégration HTML',
            'thumbnail_url' => 'Vignette',
            'external_id' => 'ID externe',
            'tag' => 'Balises',
            'category_id' => 'Catégorie',
            'subcategory_id' => 'Sous Category',
            'playlist_id' => 'Playlist',
            'select_category' => 'Sélectionner la catégorie',
            'select_subcategory' => 'Sélectionner la sous catégorie',
            'select_playlist' => 'Sélectionner la playlist',
            'youtube_link' => 'Lien YouTube',
            'seo_title' => 'Titre SEO',
            'seo_description' => 'Description SEO',
            'seo_keyword' => 'Mots-clés SEO',
            'reaction' => 'Réactions',
            'video_type' => 'Type de vidéo',
            'select_video_type' => 'Sélectionner le type de vidéo',
            'created_at' => 'Date de publication',
            'video_information' => 'Informations vidéo',
            'content_type' => 'Type de contenu vidéo'
        ],

    ],

    'category' => [
        'name' => 'Catégorie de vidéo',
        'list' => 'Liste des catégories de vidéo',

        'form' => [
            'icon' => 'Icône',
            'icon_from' => '(Font Awesome or Flat Icon)',
            'description' => 'Description',
            'code' => 'Code',
            'name' => 'Nom',
            'serial' => 'En série',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'La vidéo existe déjà avec cette catégorie'
        ]
    ],

    'subcategory' => [
        'name' => 'Sous catégorie de vidéo',
        'list' => 'Liste des sous catégories de vidéo',

        'form' => [
            'icon' => 'Icône',
            'icon_from' => '(Font Awesome or Flat Icon)',
            'description' => 'Description',
            'code' => 'Code',
            'name' => 'Nom',
            'serial' => 'En série',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'La vidéo existe déjà avec cette sous catégorie'
        ]
    ],

    'playlist' => [
        'name' => 'Playlist vidéo',
        'list' => 'Liste de playlists vidéo',

        'form' => [
            'name' => 'Nom',
        ],

        'message' => [
            'error_video_exist_with_this_playlist' => 'La vidéo existe déjà avec cette playlist'
        ]
    ],

];
