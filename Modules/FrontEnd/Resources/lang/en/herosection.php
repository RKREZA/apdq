<?php

return [
    'herosection'  => [
        'index' => [
            'title' => 'Banner',
            'index' => 'Index'
        ],
        'view' => [
            'title' => 'Banner View',
        ],
        'create' => [
            'title' => 'Create Banner',
        ],

        'edit' => [
            'title' => 'Edit Banner',
        ],

        'add_new' => 'Add New Banner',
        'save' => 'Save',

        'form' => [
            'title' => 'English Title',
            'description' => 'English Description',
            'bn_title' => 'Bangla Title',
            'bn_description' => 'Bangla Description',
            'image' => 'Image',
            'view-button' => 'View',
            'image_upload' => 'Image Upload',
            'button_text' => 'Button Text',
            'button_url' => 'Button URL',
            'action' => 'Action',
            'status' => 'Status',
            'edit-button' => 'Edit',
            'delete-button' => 'Delete',
            'select_category' => 'Select category',

            'validation'    => [
                'title' => [
                    'required'  => 'The English title field is required!',
                ],
                'description' => [
                    'required'  => 'The English description field is required!',
                ],
                'image' => [
                    'required'  => 'The Image field is required!',
                ],
                'button_text' => [
                    'required'  => 'The Button Text field is required!',
                ],
                'button_url' => [
                    'required'  => 'The Button URL field is required!',
                ],
            ],
        ],

        'message' => [
            'store' => [
                'success' => 'Banner added successfully!',
                'error'    => 'Something went wrong!',
            ],
            'update' => [
                'success' => 'Banner updated successfully!',
                'error'    => 'Something went wrong!',
            ],
            'destroy' => [
                'success' => 'Banner deleted successfully!',
                'error'    => 'Something went wrong!',
                'warning_last_herosection' => 'You can not delete last Banner',
            ],
            'status' => [
                'success' => 'Status changed successfully!',
                'error'    => 'Something went wrong!',
            ],
        ],
    ],

];
