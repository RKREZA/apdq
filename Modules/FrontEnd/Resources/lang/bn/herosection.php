<?php

return [
    'herosection'  => [
        'index' => [
            'title' => 'ব্যানার',
            'index' => 'ইনডেক্স'
        ],
        'view' => [
            'title' => 'ব্যানার ভিউ',
        ],
        'create' => [
            'title' => 'ব্যানার তৈরি',
        ],

        'edit' => [
            'title' => 'ব্যানার এডিট',
        ],

        'add_new' => 'নতুন ব্যানার যুক্ত',
        'save' => 'সেভ',

        'form' => [
            'title' => 'টাইটেল',
            'description' => 'বিবরণ',
            'bn_title' => 'টাইটেল',
            'bn_description' => 'বিবরণ',
            'image' => 'ইমেজ',
            'view-button' => 'ভিউ',
            'image_upload' => 'ইমেজ আপলোড',
            'button_text' => 'বাটন টেক্সট',
            'button_url' => 'বাটন ইউআরএল',
            'action' => 'অ্যাকশন',
            'status' => 'স্ট্যাটাস',
            'edit-button' => 'এডিট',
            'delete-button' => 'ডিলিট',
            'select_category' => 'ক্যাটাগরি সিলেক্ট করুন',

            'validation'    => [
                'title' => [
                    'required'  => 'ইংরেজি টাইটেল প্রয়োজন!',
                ],
                'description' => [
                    'required'  => 'ইংরেজি বিবরণ প্রয়োজন!',
                ],
                'image' => [
                    'required'  => 'ইমেজ প্রয়োজন!',
                ],
                'button_text' => [
                    'required'  => 'বাটন টেক্সট প্রয়োজন!',
                ],
                'button_url' => [
                    'required'  => 'বাটন ইউআরএল প্রয়োজন!',
                ],
            ],
        ],

        'message' => [
            'store' => [
                'success' => 'সফল ভাবে যুক্ত করা হয়েছে!',
                'error'    => 'সমস্যা হয়েছে!',
            ],
            'update' => [
                'success' => 'আপডেট করা হয়েছে!',
                'error'    => 'সমস্যা হয়েছে!',
            ],
            'destroy' => [
                'success' => 'ডিলিট করা হয়েছে!',
                'error'    => 'সমস্যা হয়েছে!',
                'warning_last_herosection' => 'শেষ ব্যানার মুলে ফেলা যাবে না!',
            ],
            'status' => [
                'success' => 'স্ট্যাটাস আপডেট করা হয়েছে!',
                'error'    => 'সমস্যা হয়েছে!',
            ],
        ],
    ],

];
