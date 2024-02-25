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
            'subcategory_id' => 'Sub category',
            'select_category' => 'Select Category',
            'select_subcategory' => 'Select Sub category',
            'seo_title' => 'SEO Title',
            'seo_description' => 'SEO Description',
            'seo_keyword' => 'SEO Keyword',
            'created_at' => 'Publish Date',
            'post_information' => 'Post Information',
            'content_type' => 'Content Type'
        ],

    ],

    'category' => [
        'name' => 'Post Category',
        'names' => 'Post Categories',
        'list' => 'Post Category List',

        'form' => [
            'serial' => 'Serial',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'Post already exists with this category'
        ]
    ],

    'subcategory' => [
        'name' => 'Post Sub category',
        'names' => 'Post Sub categories',
        'list' => 'Post Sub category List',

        'form' => [
            'serial' => 'Serial',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
        ],

        'message' => [
            'error_video_exist_with_this_subcategory' => 'Post already exists with this sub category'
        ]
    ],

];
