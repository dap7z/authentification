<?php
//OUVERTURE SESSION NAVIGATEUR
session_start();

//CHARGEMENT CLASSES AVEC L'AUTO LOADER GENERER PAR COMPOSER
require __DIR__ . '/../vendor/autoload.php';

//INITIALISATION DE L'APPLICATION
require __DIR__ . '/../app/app.php';

//LANCEMENT DE L'APPLICATION
$app->run();