<?php
return [
	'debug' => false,
	'determineRouteBeforeAppMiddleware' => true,
	'settings' => [
		'db' => [
			'driver' => 'mysql',
			'host' => 'localhost',
			'database' => 'authentication',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix' => '',
		],
		'cache' => [
			'active' => false,
			'directory' => __DIR__ . '/../cache',
		],
		'logger' => [
			'active' => false,
			'directory' => __DIR__ . '/../logs',
			'filename' => 'app.log',
			'timezone' => 'Europe/Paris',
			'level' => 'DEBUG',
			'handlers' => [],
		],
		'lang' => 'fr_FR',
		'displayErrorDetails' => true,
	]
];