<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'                    => 'আপনার দেওয়া তথ্য আমাদের রেকর্ডের সাথে মেলেনা!',
    'password'                  => 'আপনি ভুল পাসওয়ার্ড দিয়েছেন!',
    'throttle'                  => 'অনেক বেশি লগিন রিকুয়েস্ট! কিছু সময় পর আবার চেষ্টা করুন',

    'signin_title'              => 'সাইন ইন',
    'signin_sub_title'          => 'আপনার অ্যাকাউন্টে সাইন ইন করুন!',
    'signin_button'             => 'সাইন ইন',
    'forgot_password_title'     => 'পাসওয়ার্ড ভুলে গেছেন?',
    'reset_password_title'      => 'পাসওয়ার্ড পরিবর্তন করুন',
    'reset_password_button'     => 'পাসওয়ার্ড পরিবর্তন',
    'forgot_password'           => 'পাসওয়ার্ড ভুলে গেছেন?',
    'send_password_reset_link'  => 'পাসওয়ার্ড পরিবর্তনের লিংক পাঠান',
    'back_to_login'             => 'সাইন ইন পেইজে ফেরত যান',
    'back_to_home'              => 'হোম পেইজে ফিরে যান',

    'dashboard'                 => 'ড্যাশবোর্ড',
    'alert'                     => 'অ্যালার্ট',
    'see_all'                   => 'সবগুলো দেখুন',
    'log_out'                   => 'লগ আউট',

    'helpdesk'                  => 'হেল্প ডেস্ক',
    'fax'                       => 'ফ্যাক্স',
    'phone'                     => 'ফোন নম্বর',
    'support_email'             => 'ইমেইল',
    'mobile_one'                => 'ফোন নম্বর-১',
    'mobile_two'                => 'ফোন নম্বর-২',
    'facebook_group'            => 'ফেসবুক গ্রুপ',
    'whatsapp_group'            => 'হোয়াটসঅ্যাপ গ্রুপ',
    'youtube_chanel'            => 'ইউটিউব চ্যানেল',
    'user_manual'               => 'ব্যবহার নির্দেশিকা',
    'address'                   => 'ঠিকানা',

    'send' => 'সেন্ড',
    'close' => 'বন্ধ',
    'back_to_top' => 'উপরে যান',

    'form'                      => [
        'email'                     => 'ইমেইল',
        'password'                  => 'পাসওয়ার্ড',
        'captcha'                   => 'ক্যাপচা',
        'message'                   => 'মেসেজ',
        'new_password'              => 'নতুন পাসওয়ার্ড',
        'confirm_password'          => 'পাসওয়ার্ড নিশ্চিত',
        'remember'                  => 'মনে রাখুন',
        'show_password'             => 'পাসওয়ার্ড দেখানো',
        'validation'                => [
            'email'                     => [
                'required'                  => 'আপনার ইমেইল দিন!',
                'email'                     => 'আপনার সঠিক ইমেইল দিন!',
            ],
            'captcha'            => [
                'required'          => 'ক্যাপচা দিন!',
                'captcha'           => 'সঠিক ক্যাপচা দিন!',
            ],
            'password'           => [
                'required'          => 'আপনার পাসওয়ার্ড দিন!',
            ],
            'message' => [
                'required' => 'আপনার মেসেজ লিখুন!',
            ],
        ],
    ],

    'feedback'                  => [

        'index' => 'ফিডব্যাক',
        'category' => 'ফিডব্যাক ক্যাটেগরি',

        'form'                      => [
            'name'                      => 'নাম',
            'mobile'                    => 'মোবাইল',
            'title'                     => 'টাইটেল',
            'category_id'               => 'ক্যাটাগরি',
            'description'               => 'বিবরণ',

            'validation'                => [
                'name'                      => [
                    'required'                  => 'আপনার নাম লিখুন!',
                ],
                'mobile'                    => [
                    'required'                  => 'আপনার মোবাইল নাম্বার লিখুন!',
                ],
                'title'                     => [
                    'required'                  => 'টাইটেল দিন!',
                ],
                'category_id'               => [
                    'required'                  => 'ক্যাটাগরি নির্বাচন করুন!',
                ],
                'description'               => [
                    'required'                  => 'আপনার মেসেজ লিখুন!',
                ],
            ],
        ],

        'message'                       => [
            'store'                         => [
                'success'                       => 'ফিডব্যাক সফল ভাবে সেন্ড করা হয়েছে!!',
                'error'                         => 'কিছু সমস্যা হয়েছে!',
            ],
        ],
    ],

    'profile'                  => [
        'index' => 'প্রোফাইল',
        'form'                      => [
            'name'                      => 'নাম',
            'mobile'                    => 'মোবাইল',
            'email'                     => 'ইমেইল',
            'photo'                     => 'ফটো',

            'validation'                => [
                'name'                      => [
                    'required'                  => 'আপনার নাম লিখুন!',
                ],
                'mobile'                    => [
                    'required'                  => 'আপনার মোবাইল নাম্বার লিখুন!',
                ],
                'email'                     => [
                    'required'                  => 'আপনার ইমেইল লিখুন!',
                ],
                'photo'                     => [
                    'required'                  => 'আপনার ফটো দিন!',
                ],
            ],
        ],

        'message'                       => [
            'update'                         => [
                'success'                       => 'সফল ভাবে সংরক্ষিত হয়েছে!',
                'error'                         => 'সমস্যা হয়েছে!',
            ],
            'password' => [
                'success'                       => 'পাসওয়ার্ড পরিবর্তন করা হয়েছে!',
                'error'                         => 'পাসওয়ার্ডের মিল নাই!',
                'warning'                       => 'ইউজারনেম পাসওয়ার্ড মিল নাই!',
            ],
            'deactivated' => [
                'error'                         => 'আপনার অ্যাকাউন্ট ডিঅ্যাক্টিভেটেড করা হয়েছে!',
            ]
        ],
    ],

    'message'=> [
        'password_reset'    => 'আপনার পাসওয়ার্ড রিসেট লিঙ্কটি ইমেইল করা হয়েছে!',
        'cheng_pass'        => 'আপনার পাসওয়ার্ড পরিবর্তন করা হয়েছে!',
    ],


];
