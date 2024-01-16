<?php

return [
    'blog' => 'Blog',

    'post'  => [
        'name' => 'Post',
        'names' => 'Posts',

        'form' => [
            'title' => 'Title',
            'description' => 'Description',
            'tag' => 'Tags',
            'category_id' => 'Category',
            'select_category' => 'Select Category',
            'seo_title' => 'SEO Title',
            'seo_description' => 'SEO Description',
            'seo_keyword' => 'SEO Keyword',
            'created_at' => 'Publish Date',
        ],

    ],

    'category' => [
        'name' => 'Post Category',
        'names' => 'Post Categories',
        'list' => 'Post Category List',

        'form' => [
            'code' => 'Code',
            'name' => 'Name',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'Post already exists with this category'
        ]
    ],

];
