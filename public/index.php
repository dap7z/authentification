<?php
//OUVERTURE SESSION NAVIGATEUR
session_start();

//CHARGEMENT CLASSES AVEC L'AUTO LOADER GENERER PAR COMPOSER
require __DIR__ . '/../vendor/autoload.php';

//CREATION OBJET SLIM FRAMEWORK ET PARAMETRAGES
$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
		'db' => [
			'driver' => 'mysql',
			'host' => 'localhost',
			'database' => 'authentication',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix' => ''
		],
		'lang' => 'fr_FR',
	]
]);

//INITIALISATION DE L'APPLICATION
require __DIR__ . '/../bootstrap/app.php';

//LANCEMENT DE L'APPLICATION
$app->run();