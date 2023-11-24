<?php

return [
    'gallery' => [
        'index' => [
            'title' => 'Gallery',
            'titles' => 'Gallery\'s',
            'index' => 'Index'
        ],
        'view' => [
            'title' => 'Photo View',
        ],
        'create' => [
            'title' => 'Create Photo',
        ],

        'edit' => [
            'title' => 'Edit Photo',
        ],

        'add_new' => 'Add New Photo',
        'save' => 'Save',

        'form' => [
            'serial'        => 'Serial',
            'title'         => 'Title',
            'description'   => 'Description',
            'video_details' => 'Paste Youtube Embed Code Here',
            'guide'         => 'To get "Embed Code", go to youtube then right click to any video then click on "Copy embed code"',
            'category_id'   => 'Category Id',
            'created_by'    => 'Created By',
            'status'        => 'Status',
            'action'        => 'Action',
            'edit-button'   => 'Edit',
            'delete-button' => 'Delete',
            'view-button'   => 'View',
            'current_image' => 'View Image',
            'current'       => 'Current',
            'files'         => 'Files',
            'thumbnail'     => 'Thumbnail',
            'only_image'    => 'Only Image',
            'only_image'    => 'Only Image',
            'only_image_or_pdf'    => 'More than one Image/PDF can be added',
            'video'         => 'Video',
            'photo'         => 'Photo',

            'validation'    => [
                'image' => [
                    'required'  => 'The image field is required!',
                ],
            ],
        ],

        'message' => [
            'store' => [
                'success' => 'Photo added successfully!',
                'error'    => 'Something went wrong!',
            ],
            'update' => [
                'success' => 'Photo updated successfully!',
                'error'    => 'Something went wrong!',
            ],
            'destroy' => [
                'success' => 'Photo deleted successfully!',
                'error'    => 'Something went wrong!',
                'warning_last_photogallery' => 'You can not delete last Photo',
            ],
            'status' => [
                'success' => 'Status changed successfully!',
                'error'    => 'Something went wrong!',
            ],
        ],
    ],

    'category' => [
        'index' => [
            'title' => 'Gallery Category',
            'index' => 'Index'
        ],
        'create' => [
            'title' => 'Create Gallery Category',
        ],

        'edit' => [
            'title' => 'Edit Gallery Category',
        ],

        'add_new' => 'Add New Gallery Category',
        'save' => 'Save',

        'form' => [
            'code' => 'Code',
            'name' => 'Name',
            'bn_name' => 'Bangla Name',
            'status' => 'Status',
            'category_id' => 'Category',
            'created_by' => 'Created by',
            'action' => 'Action',
            'edit-button' => 'Edit',
            'delete-button' => 'Delete',

            'validation'    => [
                'name' => [
                    'required'  => 'The name field is required!',
                ],
                'code' => [
                    'required'  => 'The Code field is required!',
                    'unique'  => 'Code already exists!',
                ],
            ],
        ],

        'message' => [
            'store' => [
                'success' => 'Category added successfully!',
                'error'    => 'Something went wrong!',
            ],
            'update' => [
                'success' => 'Category updated successfully!',
                'error'    => 'Something went wrong!',
            ],
            'destroy' => [
                'success' => 'Category deleted successfully!',
                'error'    => 'Something went wrong!',
                'warning_last_Gallerycategory' => 'You can not delete last Category',
            ],
            'status' => [
                'success' => 'Status changed successfully!',
                'error'    => 'Something went wrong!',
            ],
        ],
    ],
];
