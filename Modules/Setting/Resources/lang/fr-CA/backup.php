<?php

return [

    'index' => [
        'title' => 'Sauvegarde',
    ],
    'form' => [
        'name' => 'Nom',
        'size' => 'Taille',
        'date' => 'Date',
        'age' => 'Âge',
        'action' => 'Action',
        'create' => 'Effectuer une sauvegarde maintenant',
        'edit' => 'Éditer',
        'delete' => 'Supprimer',
        'download' => 'Télécharger',
        'monitor' => 'Surveiller',
        'clean' => 'Nettoyer',
    ],
    
    'message' => [ 
        'backup' => [
            'success' => 'Sauvegarde créée avec succès!',
            'error'   => 'Quelque chose s\'est mal passé!',
        ],

        'clean' => [
            'success' => 'Sauvegarde nettoyée avec succès!',
            'error'   => 'Quelque chose s\'est mal passé!',
        ],

        'monitor' => [
            'success' => 'Sauvegarde surveillée avec succès!',
            'error'   => 'Quelque chose s\'est mal passé!',
        ],

        'delete' => [
            'success' => 'Sauvegarde supprimée avec succès!',
            'error' => 'Quelque chose s\'est mal passé!',
        ],

        'error' => [
            'success' => 'Le fichier de sauvegarde n\'existe pas!',
            'error' => 'Quelque chose s\'est mal passé!',
        ],

        'abort' => 'Le fichier de sauvegarde n\'existe pas.', 
    ],
];
