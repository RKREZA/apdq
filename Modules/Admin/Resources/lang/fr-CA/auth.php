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

'failed'                    => 'Les informations que vous avez fournies ne correspondent pas à nos enregistrements !',
'password'                  => 'Vous avez fourni le mauvais mot de passe !',
'throttle'                  => 'Trop de demandes de connexion ! Veuillez réessayer plus tard',

'signin_title'              => 'Se connecter',
'signin_sub_title'          => 'Connectez-vous à votre compte !',
'signin_button'             => 'Se connecter',
'forgot_password_title'     => 'Mot de passe oublié ?',
'reset_password_title'      => 'Changer de mot de passe',
'reset_password_button'     => 'Changer de mot de passe',
'forgot_password'           => 'Mot de passe oublié ?',
'send_password_reset_link'  => 'Envoyer le lien pour changer le mot de passe',
'back_to_login'             => 'Retour à la page de connexion',
'back_to_home'              => 'Retour à la page d\'accueil',

'signup_title'              => 'S\'inscrire',
'signup_button'             => 'Créer un compte',
'create_new_account'        => 'Créer un nouveau compte !',

'dashboard'                 => 'Tableau de bord',
'alert'                     => 'Alerte',
'see_all'                   => 'Voir tout',
'log_out'                   => 'Se déconnecter',

'helpdesk'                  => 'Service d\'assistance',
'fax'                       => 'Fax',
'phone'                     => 'Numéro de téléphone',
'support_email'             => 'Email',
'mobile_one'                => 'Numéro de téléphone-1',
'mobile_two'                => 'Numéro de téléphone-2',
'facebook_group'            => 'Groupe Facebook',
'whatsapp_group'            => 'Groupe WhatsApp',
'youtube_chanel'            => 'Chaîne YouTube',
'user_manual'               => 'Manuel de l\'utilisateur',
'address'                   => 'Adresse',

'send'                      => 'Envoyer',
'close'                     => 'Fermer',
'back_to_top'               => 'Remonter',

'form'                      => [
    'name'                      => 'Nom',
    'mobile'                    => 'Mobile',
    'email'                     => 'Email',
    'password'                  => 'Mot de passe',
    'captcha'                   => 'Captcha',
    'message'                   => 'Message',
    'new_password'              => 'Nouveau mot de passe',
    'confirm_password'          => 'Confirmer le mot de passe',
    'remember'                  => 'Se souvenir de moi',
    'i_agree'                   => 'J\'accepte',
    'show_password'             => 'Afficher le mot de passe',
    'validation'                => [
        'name'                     => [
            'required'                  => 'Entrez votre nom !',
        ],
        'mobile'                     => [
            'required'                  => 'Entrez votre numéro de mobile !',
            'unique'                  => 'Déjà existant !',
        ],
        'email'                     => [
            'required'                  => 'Entrez votre email !',
            'email'                     => 'Entrez votre email correctement !',
            'unique'                  => 'Déjà existant !',
        ],
        'captcha'            => [
            'required'          => 'Captcha !',
            'captcha'           => 'Entrez le captcha correctement !',
        ],
        'password'           => [
            'required'          => 'Entrez votre mot de passe !',
        ],
        'message' => [
            'required' => 'Écrivez votre message !',
        ],
        'i_agree' => [
            'required' => 'J\'accepte requis !',
        ],
    ],
],

'feedback'                  => [

    'index' => 'Retour d\'information',
    'category' => 'Catégorie de retour d\'information',

    'form'                      => [
        'name'                      => 'Nom',
        'mobile'                    => 'Mobile',
        'title'                     => 'Titre',
        'category_id'               => 'Catégorie',
        'description'               => 'Description',

        'validation'                => [
            'name'                      => [
                'required'                  => 'Entrez votre nom !',
            ],
            'mobile'                    => [
                'required'                  => 'Entrez votre numéro de mobile !',
            ],
            'title'                     => [
                'required'                  => 'Entrez le titre !',
            ],
            'category_id'               => [
                'required'                  => 'Sélectionnez une catégorie !',
            ],
            'description'               => [
                'required'                  => 'Écrivez votre message !',
            ],
        ],
    ],

    'message'                       => [
        'store'                         => [
            'success'                       => 'Retour d\'information envoyé avec succès !',
            'error'                         => 'Quelque chose s\'est mal passé !',
        ],
    ],
],

'profile'                  => [
    'index' => 'Profil',
    'form'                      => [
        'name'                      => 'Nom',
        'mobile'                    => 'Mobile',
        'email'                     => 'Email',
        'photo'                     => 'Photo',

        'validation'                => [
            'name'                      => [
                'required'                  => 'Entrez votre nom !',
            ],
            'mobile'                    => [
                'required'                  => 'Entrez votre numéro de mobile !',
            ],
            'email'                     => [
                'required'                  => 'Entrez votre email !',
            ],
            'photo'                     => [
                'required'                  => 'Entrez votre photo !',
            ],
        ],
    ],

    'message'                       => [
        'update'                         => [
            'success'                       => 'Enregistré avec succès !',
            'error'                         => 'Il y a un problème !',
        ],
        'password' => [
            'success'                       => 'Mot de passe changé !',
            'error'                         => 'Les mots de passe ne correspondent pas !',
            'warning'                       => 'Le nom d\'utilisateur et le mot de passe ne correspondent pas !',
        ],
        'deactivated' => [
            'error'                         => 'Votre compte a été désactivé !',
        ]
    ],
],

'message'=> [
    'password_reset' => 'Nous avons envoyé par e-mail votre lien de réinitialisation de mot de passe !',
    'cheng_pass' => 'Votre mot de passe a été changé !',
    'signup_success' => 'Compte créé avec succès !',
],

];
