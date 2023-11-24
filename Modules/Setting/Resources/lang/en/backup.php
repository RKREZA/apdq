<?php

return [

    'index' => [
        'title' => 'Backup',
    ],
    'form' => [
        'name' => 'Name',
        'size' => 'Size',
        'date' => 'Date',
        'age' => 'Age',
        'action' => 'Action',
        'create' => 'Take Backup Now',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'download' => 'Download',
        'monitor' => 'Monitor',
        'clean' => 'Clean',
    ],
    
    'message' => [ 
        'backup' => [
            'success' => 'Successfully created backup!',
            'error'   => 'Something went wrong!',
        ],

        'clean' => [
            'success' => 'Successfully cleaned backup!',
            'error'   => 'Something went wrong!',
        ],

        'monitor' => [
            'success' => 'Successfully monitored backup!',
            'error'   => 'Something went wrong!',
        ],

        'delete' => [
            'success' => 'Successfully deleted backup!',
            'error' => 'Something went wrong!',
        ],

        'error' => [
            'success' => 'Backup file doesn\'t exist!',
            'error' => 'Something went wrong!',
        ],

        'abort' => 'Backup file doesn\'t exist.', 
    ],
];
