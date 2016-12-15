<?php
use Respect\Validation\Validator as v;

$container = $app->getContainer();

/*
	//initialise la traduction des messages avec gettext() / _()
	// => DESACTIVE CAR EXTENTION PHP GETTEXT NE FONCTIONNE PAS BIEN AVEC WAMP SERVER x64

	putenv("LC_ALL=". $container['settings']['lang']);
	if(setlocale(LC_ALL, $container['settings']['lang']) === FALSE){
		echo "The local ". $container['settings']['lang'] ." is not recognized by the OS. \n";
		echo "getlocal(LC_ALL): '". setlocale(LC_ALL, 0) ."' \n";
	}
	$tradName = "messages";
	$tradDirPath = __DIR__ . "/../lang";
	$tradFileTest = $tradDirPath."/fr_FR/LC_MESSAGES/".$tradName.".po";
	if(!file_exists($tradFileTest)){
		echo "Trad file does not exist: \n".$tradFileTest;
	}
	bindtextdomain("messages", __DIR__ . "\..\lang");
*/

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};

$container['auth'] = function($container) {
	return new \App\Auth\Auth;
};

$container['flash'] = function($container) {
	return new \Slim\Flash\Messages;
};

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views/', [
		'cache' => false,
	]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	$view->getEnvironment()->addGlobal('auth',[
		'check' => $container->auth->check(),
		'user' => $container->auth->user()
	]);

	$view->getEnvironment()->addGlobal('flash',$container->flash);

	return $view;
};

$container['validator'] = function ($container) {
	return new App\Validation\validator;
};

$container['HomeController'] = function($container) {
	return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function($container) {
	return new \App\Controllers\Auth\AuthController($container);
};

$container['PasswordController'] = function($container) {
	return new \App\Controllers\Auth\PasswordController($container);
};

$container['csrf'] = function($container) {
	return new \Slim\Csrf\Guard;
};



$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

v::with('App\\Validation\\Rules\\');

require __DIR__ . '/../app/routes.php';