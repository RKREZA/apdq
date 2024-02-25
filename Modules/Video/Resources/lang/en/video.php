<?php

return [
    'video'  => [
        'name' => 'Video',
        'names' => 'Videos',

        'form' => [
            'title' => 'Title',
            'description' => 'Description',
            'embed_html' => 'HTML Embed Code',
            'thumbnail_url' => 'Thumbnail',
            'external_id' => 'External ID',
            'tag' => 'Tags',
            'category_id' => 'Category',
            'subcategory_id' => 'Sub Category',
            'playlist_id' => 'Playlist',
            'select_category' => 'Select Category',
            'select_subcategory' => 'Select Sub Category',
            'select_playlist' => 'Select Playlist',
            'youtube_link' => 'YouTube Link',
            'seo_title' => 'SEO Title',
            'seo_description' => 'SEO Description',
            'seo_keyword' => 'SEO Keywords',
            'reaction' => 'Reactions',
            'video_type' => 'Video Type',
            'select_video_type' => 'Select Video Type',
            'created_at' => 'Publish Date',
            'video_information' => 'Video Information',
            'content_type' => 'Video Content Type'
        ],

    ],

    'category' => [
        'name' => 'Video Category',
        'list' => 'List of Video Categories',

        'form' => [
            'icon' => 'Icon',
            'icon_from' => '(Font Awesome or Flat Icon)',
            'description' => 'Description',
            'code' => 'Code',
            'name' => 'Name',
            'serial' => 'Serial',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'Video already exists with this category'
        ]
    ],

    'subcategory' => [
        'name' => 'Video Sub Category',
        'list' => 'List of Video Sub Categories',

        'form' => [
            'icon' => 'Icon',
            'icon_from' => '(Font Awesome or Flat Icon)',
            'description' => 'Description',
            'code' => 'Code',
            'name' => 'Name',
            'serial' => 'Serial',
        ],

        'message' => [
            'error_video_exist_with_this_category' => 'Video already exists with this sub category'
        ]
    ],

    'playlist' => [
        'name' => 'Video Playlist',
        'list' => 'List of Video Playlists',

        'form' => [
            'name' => 'Name',
        ],

        'message' => [
            'error_video_exist_with_this_playlist' => 'Video already exists with this playlist'
        ]
    ],

];
