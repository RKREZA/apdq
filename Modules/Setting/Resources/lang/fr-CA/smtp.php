<?php

return [

    'index' => [
        'title' => 'Paramètres SMTP',
    ],

    'form'      => [
        'tab_email_setting' => 'Paramètres Email',
        'tab_email_inbox' => 'Boîte de réception',
        'tab_sent_email' => 'Emails envoyés',

        'compose_email' => 'Composer un email',
        'email_setting' => 'Paramètres',
        'email_inbox' => 'Boîte de réception',
        'email' => 'Email',
        'email_from' => 'De',
        'email_to' => 'À',
        'email_cc' => 'CC',
        'email_subject' => 'Sujet',
        'email_body' => 'Corps de l\'email',
        'created_at' => 'Créé à',

        'update_email_setting_button' => 'Mettre à jour les informations Email',
        

        'update_email_setting_button' => 'Mettre à jour les informations de paramètres Email',
        'update_email_inbox_button' => 'Mettre à jour les informations de la boîte de réception Email',
        'update_email_send_button' => 'Envoyer un email',

        'mail_mailer' => 'Mailer',
        'mail_host' => 'Host',
        'mail_port' => 'Port',
        'mail_username' => 'Nom d\'utilisateur',
        'mail_password' => 'Mot de passe',
        'mail_from_address' => 'Adresse expéditeur',
        'mail_encryption' => 'Chiffrement',
        'mail_from_name' => 'Nom expéditeur',

        'validation'    => [
            'email_from' => [
                'required' => 'Le champ Expéditeur est requis !'
            ],
            'email_to' => [
                'required' => 'Le champ Destinataire est requis !'
            ],
            'email_subject' => [
                'required' => 'Le champ Sujet est requis !'
            ],
            'email_body' => [
                'required' => 'Le champ Corps de l\'email est requis !'
            ],
        ],
    ],

    'message' => [
        'update' => [
            'success' => 'Mise à jour réussie',
            'error' => 'Quelque chose s\'est mal passé !',
        ],
        'send' => [
            'success' => 'Envoyé avec succès',
            'error' => 'Quelque chose s\'est mal passé !',
        ],
    ],

];
