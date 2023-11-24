<?php

return [

    'index' => [
        'title' => 'SMTP Settings',
    ],

    'form'      => [
        'tab_email_setting' => 'Email Setting',
        'tab_email_inbox' => 'Inbox',
        'tab_sent_email' => 'Sent Email',

        'compose_email' => 'Compose Email',
        'email_setting' => 'Setting',
        'email_inbox' => 'Inbox',
        'email' => 'Email',
        'email_from' => 'From',
        'email_to' => 'To',
        'email_cc' => 'CC',
        'email_subject' => 'Subject',
        'email_body' => 'Email Body',
        'created_at' => 'Created at',

        'update_email_setting_button' => 'Update Email Info',
        

        'update_email_setting_button' => 'Update Email Setting Info',
        'update_email_inbox_button' => 'Update Email Inbox Info',
        'update_email_send_button' => 'Email Send',

        'mail_mailer' => 'Mailer',
        'mail_host' => 'Host',
        'mail_port' => 'Port',
        'mail_username' => 'Username',
        'mail_password' => 'Password',
        'mail_from_address' => 'From Address',
        'mail_encryption' => 'Encryption',
        'mail_from_name' => 'From Name',

        'validation'    => [
            'email_from' => [
                'required' => 'Email from field is required!'
            ],
            'email_to' => [
                'required' => 'Email to field is required!'
            ],
            'email_subject' => [
                'required' => 'Email subject field is required!'
            ],
            'email_body' => [
                'required' => 'Email body field is required!'
            ],
        ],
    ],

    'message' => [
        'update' => [
            'success' => 'Update successfully',
            'error' => 'Something went wrong!',
        ],
        'send' => [
            'success' => 'Send successfully',
            'error' => 'Something went wrong!',
        ],
    ],

];
