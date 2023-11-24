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

    'failed'                    => 'The information you provide does not match our record!',
    'password'                  => 'You gave the wrong password!',
    'throttle'                  => 'Too many login requests! Please try again later',

    'signin_title'              => 'Sign in',
    'signin_sub_title'          => 'Sign in to your account!',
    'signin_button'             => 'Sign in',
    'forgot_password_title'     => 'Forgot your password?',
    'reset_password_title'      => 'Change password',
    'reset_password_button'     => 'Change password',
    'forgot_password'           => 'Forgot your password?',
    'send_password_reset_link'  => 'Send the link to change the password',
    'back_to_login'             => 'Go back to the sign in page',
    'back_to_home'              => 'Go back to the home page',

    'dashboard'                 => 'Dashboard',
    'alert'                     => 'Alert',
    'see_all'                   => 'See all',
    'log_out'                   => 'Log out',

    'helpdesk'                  => 'Help Desk',
    'fax'                       => 'Fax',
    'phone'                     => 'Phone Number',
    'support_email'             => 'Email',
    'mobile_one'                => 'Phone Number-1',
    'mobile_two'                => 'Phone Number-2',
    'facebook_group'            => 'Facebook Group',
    'whatsapp_group'            => 'WhatsApp Group',
    'youtube_chanel'            => 'YouTube Channel',
    'user_manual'               => 'User Manual',
    'address'                   => 'Address',

    'send'                      => 'Send',
    'close'                     => 'Close',
    'back_to_top'               => 'Go upstairs',

    'form'                      => [
        'email'                     => 'Email',
        'password'                  => 'Password',
        'captcha'                   => 'Captcha',
        'message'                   => 'Message',
        'new_password'              => 'New Password',
        'confirm_password'          => 'Confirmed password',
        'remember'                  => 'Remember me',
        'show_password'             => 'Show password',
        'validation'                => [
            'email'                     => [
                'required'                  => 'Input your email!',
                'email'                     => 'Enter your correct email!',
            ],
            'captcha'            => [
                'required'          => 'Captcha!',
                'captcha'           => 'Input the correct captcha!',
            ],
            'password'           => [
                'required'          => 'Input your password!',
            ],
            'message' => [
                'required' => 'Write your message!',
            ],
        ],
    ],

    'feedback'                  => [

        'index' => 'Feedback',
        'category' => 'Category Feedback',

        'form'                      => [
            'name'                      => 'Name',
            'mobile'                    => 'Mobile',
            'title'                     => 'Title',
            'category_id'               => 'Category',
            'description'               => 'Description',

            'validation'                => [
                'name'                      => [
                    'required'                  => 'Enter your name!',
                ],
                'mobile'                    => [
                    'required'                  => 'Enter your mobile number!',
                ],
                'title'                     => [
                    'required'                  => 'Input the title!',
                ],
                'category_id'               => [
                    'required'                  => 'Select Category!',
                ],
                'description'               => [
                    'required'                  => 'Write your message!',
                ],
            ],
        ],

        'message'                       => [
            'store'                         => [
                'success'                       => 'Feedback sent successfully!',
                'error'                         => 'Something went wrong!',
            ],
        ],
    ],

    'profile'                  => [
        'index' => 'Profile',
        'form'                      => [
            'name'                      => 'Name',
            'mobile'                    => 'Mobile',
            'email'                     => 'Email',
            'photo'                     => 'Photo',

            'validation'                => [
                'name'                      => [
                    'required'                  => 'Enter your name!',
                ],
                'mobile'                    => [
                    'required'                  => 'Enter your mobile number!',
                ],
                'email'                     => [
                    'required'                  => 'Enter your email!',
                ],
                'photo'                     => [
                    'required'                  => 'Enter your photo!',
                ],
            ],
        ],

        'message'                       => [
            'update'                         => [
                'success'                       => 'Successfully saved!',
                'error'                         => 'There is a problem!',
            ],
            'password' => [
                'success'                       => 'Password changed!',
                'error'                         => 'Passwords do not match!',
                'warning'                       => 'Username and password do not match!',
            ],
            'deactivated' => [
                'error'                         => 'Your account has been deactivated!',
            ]
        ],
    ],

    'message'=> [
        'password_reset' => 'We have e-mailed your password reset link!',
        'cheng_pass' => 'Your password has been changed!',
    ],


];
