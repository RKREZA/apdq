<?php

return [

    'name'      => 'Utilisateur',
    'names'     => 'Utilisateurs',
    'user'      => 'Gestion des utilisateurs',


    'form'  => [
        'name'                  => 'Nom',
        'designation'           => 'Désignation',
        'email'                 => 'Email',
        'mobile'                => 'Mobile',
        'password'              => 'Mot de passe',
        'password_confirmation' => 'Confirmer le mot de passe',
        'role'                  => 'Rôle',
        'select_role'           => 'Sélectionner le rôle',
    ],

    'message' => [
        'destroy' => [
            'warning_current_user' => 'Utilisateur actuellement connecté',
        ]
    ]

];
