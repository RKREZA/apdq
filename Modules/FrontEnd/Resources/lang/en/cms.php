<?php

return [
    'cms'  => [
        'index' => [
            'title' => 'CMS',
            'index' => 'Index'
        ],
        'view' => [
            'title' => 'CMS View',
        ],
        'create' => [
            'title' => 'Create CMS',
        ],

        'edit' => [
            'title' => 'Edit CMS',
        ],

        'add_new' => 'Add New CMS',
        'save' => 'Save',
        'cms_all' => 'All CMS',

        'form' => [
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'status' => 'Status',
            'category_id' => 'Category',
            'created_by' => 'Created by',
            'action' => 'Action',
            'edit-button' => 'Edit',
            'delete-button' => 'Delete',
            'view-button' => 'View',
            'select_category' => 'Select category',

            'validation'    => [
                'title' => [
                    'required'  => 'The English title field is required!',
                ],
                'description' => [
                    'required'  => 'The English description field is required!',
                ],
                'private' => [
                    'required'  => 'The private field is required!',
                ],
                'status' => [
                    'required'  => 'The status field is required!',
                ],
                'category_id' => [
                    'required'  => 'The category field is required!',
                ],
            ],
        ],

        'message' => [
            'store' => [
                'success' => 'CMS added successfully!',
                'error'    => 'Something went wrong!',
            ],
            'update' => [
                'success' => 'CMS updated successfully!',
                'error'    => 'Something went wrong!',
            ],
            'destroy' => [
                'success' => 'CMS deleted successfully!',
                'error'    => 'Something went wrong!',
                'warning_last_cms' => 'You can not delete last CMS',
            ],
        ],
    ],

    'category' => [
        'index' => [
            'title' => 'CMS Category',
            'index' => 'Index'
        ],
        'create' => [
            'title' => 'Create CMS Category',
        ],

        'edit' => [
            'title' => 'Edit CMS Category',
        ],

        'add_new' => 'Add New CMS Category',
        'save' => 'Save',

        'form' => [
            'code' => 'Code',
            'name' => 'Name',
            'bn_name' => 'Bangla Name',
            'status' => 'Status',
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
                'warning_last_cmscategory' => 'You can not delete last Category',
            ],
            'status' => [
                'success' => 'Status changed successfully!',
                'error'    => 'Something went wrong!',
            ],
        ],
    ],

];
