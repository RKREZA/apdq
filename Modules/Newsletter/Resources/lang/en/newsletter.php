<?php

return [

    'newsletter'  => [
        'name' => 'Newsletter',
        'names' => 'Newsletters',

        'form' => [
            'email' => 'Email',
            'category_id' => 'Category',
            'select_category' => 'Select Category',
        ],
    ],

    'category' => [
        'name' => 'Newsletter Category',
        'names' => 'Newsletter Categories',
        'list' => 'Newsletter Category List',

        'form' => [
            'serial' => 'Serial',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'Email already exists with this category'
        ]
    ],
];
