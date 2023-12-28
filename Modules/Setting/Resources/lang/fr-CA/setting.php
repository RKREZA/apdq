<?php

return [

    'media_manager' => [
        'name' => 'Gestionnaire multimédia',
    ],
    'backup' => [
        'name' => 'Sauvegarde',
    ],
    'activity_log' => [
        'name' => 'Journal d\'activité',
    ],
    'error_log' => [
        'name' => 'Journal des erreurs',
    ],

    'index' => [
        'title' => 'Paramètres',
    ],

    'adminsetting'                      => [
        'index'                     => 'Paramètres',

        'form'      => [
            'tab_logo_favicon' => 'Logo & Favicon',
            'tab_info' => 'Info du site',
            'tab_meta' => 'SEO',
            'tab_preloader' => 'Préchargeur',
            'tab_back_to_top' => 'Haut de page',
            'tab_copyright' => 'Droits d\'auteur',
            'tab_email_setting' => 'Paramètres de messagerie',
            'tab_sms_setting' => 'Paramètres SMS',
            'tab_pusher_setting' => 'Paramètres Pusher',

            'change_image' => 'Changer d\'image',
            'logo_light' => 'Logo',
            'logo_dark' => 'Logo foncé',
            'favicon' => 'Favicon',
            'title' => 'Titre du site',
            'description' => 'Description du site',
            'meta_image' => 'Image méta',
            'meta_title' => 'Titre méta',
            'meta_description' => 'Méta description',
            'meta_keywords' => 'Mots-clés méta',
            'social_title' => 'Titre social',
            'social_description' => 'Description sociale',
            'preloader_status' => 'Statut du préchargeur',
            'back_to_top_status' => 'Statut de retour en haut',
            'copyright' => 'Droits d\'auteur',

            'email_setting' => 'Paramètres',
            'email_template' => 'Modèle',
            'email_from' => 'De',
            'email_to' => 'À',
            'email_subject' => 'Sujet',
            'email_body' => 'Composer un email',

            'sms_setting' => 'Paramètres',
            'sms_template' => 'Modèle',
            'sms_from' => 'De',
            'sms_to' => 'À',
            'sms_body' => 'Message',

            'update_logo_button' => 'Mettre à jour le logo et la favicon',
            'update_info_button' => 'Mettre à jour les informations du site',
            'update_meta_button' => 'Mettre à jour les informations méta',
            'update_preloader_button' => 'Mettre à jour les informations de préchargeur',
            'update_back_to_top_button' => 'Mettre à jour les informations de retour en haut',
            'update_copyright_button' => 'Mettre à jour les informations de droits d\'auteur',
            'update_email_setting_button' => 'Mettre à jour les informations de messagerie',
            'update_sms_setting_button' => 'Mettre à jour les informations SMS',
            'update_pusher_setting_button' => 'Mettre à jour les informations Pusher',

            'update_email_setting_button' => 'Mettre à jour les informations de paramètres de messagerie',
            'update_email_template_button' => 'Mettre à jour les informations de modèle de messagerie',
            'update_sms_setting_button' => 'Mettre à jour les informations de paramètres SMS',
            'update_sms_template_button' => 'Mettre à jour les informations de modèle SMS',

            'update_other_google_credentials_button' => 'Mettre à jour les identifiants Google',
            'update_google_login_button' => 'Mettre à jour la connexion Google',
            'update_facebook_login_button' => 'Mettre à jour la connexion Facebook',
            'update_gdpr_button' => 'Mettre à jour GDPR',


            'mail_mailer' => 'Messager',
            'mail_host' => 'Hôte',
            'mail_port' => 'Port',
            'mail_username' => 'Nom d\'utilisateur',
            'mail_password' => 'Mot de passe',
            'mail_from_address' => 'Adresse de l\'expéditeur',
            'mail_encryption' => 'Chiffrement',
            'mail_from_name' => 'Nom de l\'expéditeur',

            'sms_username' => 'Nom d\'utilisateur SMS',
            'sms_password' => 'Mot de passe SMS',
            'sms_api_key' => 'Clé API SMS',

            'pusher_app_id' => 'ID de l\'application Pusher',
            'pusher_app_key' => 'Clé de l\'application Pusher',
            'pusher_app_secret' => 'Secret de l\'application Pusher',

            'other_google_credentials' => 'Other Google Credentials',
            'google_login' => 'Connexion Google',
            'google_client_id' => 'Identifiant client Google',
            'google_client_secret' => 'Secret client Google',
            'google_redirect' => 'URL de redirection Google',

            'google_recaptcha_v3_site_key' => 'Clé du site Google Recaptcha V3',
            'google_recaptcha_v3_secret_key' => 'Clé secrète Google Recaptcha V3',
            'google_adsense_publisher_id' => 'ID de l\'éditeur Adsense Google',
            'google_youtube_api_key' => 'Clé API YouTube Google',

            'facebook_login' => 'Connexion Facebook',
            'facebook_app_id' => 'ID de l\'application Facebook',
            'facebook_client_secret' => 'Secret client Facebook',
            'facebook_redirect' => 'URL de redirection Facebook',

            'gdpr' => 'GDPR',
            'gdpr_cookie_title' => 'Titre du cookie GDPR',
            'gdpr_cookie_text' => 'Texte du cookie GDPR',
            'gdpr_cookie_url' => 'URL du cookie GDPR',

            'validation'    => [
                'title' => [
                    'required' => 'Le titre est requis !'
                ],
                'description' => [
                    'required' => 'La description est requise !'
                ],
                'meta_title' => [
                    'required' => 'Le titre méta est requis !'
                ],
                'meta_description' => [
                    'required' => 'La description méta est requise !'
                ],
                'meta_keywords' => [
                    'required' => 'Les mots-clés méta sont requis !'
                ],
                'social_title' => [
                    'required' => 'Le titre social est requis !'
                ],
                'social_description' => [
                    'required' => 'La description sociale est requise !'
                ],
            ],
        ],

        'message' => [
            'update' => [
                'success' => 'Mise à jour réussie',
                'error' => 'Quelque chose s\'est mal passé !',
            ],
        ],
    ],

];
