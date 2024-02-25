<?php

return [
    'newsletter'  => [
        'name' => 'Bulletin d\'information',

        'form' => [
            'email' => 'Email',
            'category_id' => 'Catégorie',
            'select_category' => 'Sélectionner la catégorie',
        ],
    ],

    'category' => [
        'name' => 'Catégorie d\'bulletin',
        'names' => 'Catégories d\'bulletins',
        'list' => 'Liste des catégories d\'bulletins',

        'form' => [
            'serial' => 'En série',
            'code' => 'Code',
            'name' => 'Nom',
            'description' => 'Description',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'Le email existe déjà dans cette catégorie'
        ]
    ],
];
