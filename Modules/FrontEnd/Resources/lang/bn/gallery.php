<?php

return [
    'name'    => 'গ্যালারি',
    'names'   => 'গ্যালারির',

    'gallery' => [
        'index' => [
            'title'    => 'গ্যালারি',
            'titles'   => 'গ্যালারির',
            'index'    => 'ইনডেক্স'
        ],
        'view' => [
            'title'     => 'গ্যালারি ভিউ',
        ],
        'create' => [
            'title'     => 'গ্যালারি তৈরি',
        ],

        'edit' => [
            'title'     => 'গ্যালারি এডিট',
        ],

        'add_new'       => 'নতুন গ্যালারি যুক্ত',
        'save'          => 'সেভ',

        'form' => [
            'title'         => 'টাইটেল',
            'serial'        => 'সিরিয়াল',
            'description'   => 'বিবরণ',
            'video_details' => 'ইউটিউব থেকে Embed Code টি এখানে Paste করুন',
            'guide'         => '"Embed Code" পাওয়ার জন্য ইউটিউবের ভিডিওর ওপর Right Click করে "Copy embed code" করুন।',
            'status'        => 'স্ট্যাটাস',
            'category_id'   => 'ক্যাটাগরি',
            'created_by'    => 'তৈরি করেছেন',
            'action'        => 'অ্যাকশন',
            'edit-button'   => 'এডিট',
            'delete-button' => 'ডিলিট',
            'view-button'   => 'ভিউ',
            'current_image' => 'ভিউ ইমেজ',
            'current'       => 'বর্তমান',
            'files'         => 'ছবি',
            'thumbnail'     => 'থাম্বনেইল (ছবি)',
            'only_image'    => 'একাধিক ছবি সংযুক্ত করা যাবে',
            'only_image_or_pdf'    => 'একাধিক ছবি/পিডিএফ সংযুক্ত করা যাবে',
            'video'         => 'ভিডিও',
            'photo'         => 'ফটো',

            'validation'    => [
                'image' => [
                    'required'  => 'ইমেজ প্রয়োজন!',
                ],
            ],
        ],

        'message' => [
            'store' => [
                'success'   => 'গ্যালারি যুক্ত করা হয়েছে!',
                'error'     => 'সমস্যা হয়েছে!',
            ],
            'update' => [
                'success'   => 'গ্যালারি আপডেট করা হয়েছে!',
                'error'     => 'সমস্যা হয়েছে!',
            ],
            'destroy' => [
                'success'   => 'গ্যালারি ডিলিট করা হয়েছে!',
                'error'     => 'সমস্যা হয়েছে!',
                'warning_last_photogallery' => 'শেষ গ্যালারি মুলে ফেলা যাবে না!',
            ],
            'status' => [
                'success'   => 'স্ট্যাটাস আপডেট করা হয়েছে!',
                'error'     => 'সমস্যা হয়েছে!',
            ],
        ],
    ],



    'category' => [
            'name' => 'গ্যালারি ক্যাটাগরি',
            'names' => 'গ্যালারি ক্যাটাগরি',
        'index' => [
            'title' => 'গ্যালারি ক্যাটাগরি',
            'index' => 'ইনডেক্স'
        ],
        'create' => [
            'title' => 'গ্যালারি ক্যাটাগরি তৈরি করুন',
        ],

        'edit' => [
            'title' => 'গ্যালারি ক্যাটাগরি এডিট করুন',
        ],

        'add_new'   => 'নতুন গ্যালারি ক্যাটাগরি যুক্ত',
        'save'      => 'সেভ',

        'form' => [
            'code'          => 'কোড',
            'name'          => 'নাম',
            'bn_name'       => 'বাংলা নাম',
            'status'        => 'স্ট্যাটাস',
            'action'        => 'অ্যাকশন',
            'edit-button'   => 'এডিট',
            'delete-button' => 'ডিলিট',

            'validation'    => [
                'name'      => [
                    'required'  => 'নাম প্রয়োজন!',
                ],
                'code'      => [
                    'required'  => 'কোড প্রয়োজন!',
                    'unique'    => 'এই কোড আগে থেকেই আছে!',
                ],
            ],
        ],

        'message' => [
            'store' => [
                'success'       => 'গ্যালারি ক্যাটেগরি যুক্ত করা হয়েছে!',
                'error'         => 'সমস্যা হয়েছে!',
            ],
            'update' => [
                'success'       => 'গ্যালারি ক্যাটেগরি আপডেট করা হয়েছে!',
                'error'         => 'সমস্যা হয়েছে!',
            ],
            'destroy' => [
                'success'       => 'গ্যালারি ক্যাটেগরি ডিলিট করা হয়েছে!',
                'error'         => 'সমস্যা হয়েছে!',
                'warning_last_cmscategory' => 'শেষ ক্যাটাগরি মুলে ফেলা যাবে না!',
            ],
            'status' => [
                'success'       => 'স্ট্যাটাস আপডেট করা হয়েছে!',
                'error'         => 'সমস্যা হয়েছে!',
            ],
        ],
    ],

];
