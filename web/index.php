<?php
	define('APP', 'authentification');
	//CHARGEMENT DE LA CONFIGURATION
	foreach(glob('../config/*.php') as $conf){
		include_once $conf;
	}
	

	
	
	//TEST MAIL
	date_default_timezone_set('Etc/UTC');
	//require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
	require '../vendor/autoload.php';
	
	require '../app/controller/mail/gmail_xoauth.php';	//A REMPLACER PAR UNE CLASSE
	

	
?>