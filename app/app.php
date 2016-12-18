<?php
use Respect\Validation\Validator as v;

//Traduction des messages générique renvoyés par Respect\Validation\Validator en francais
//(la fonction php gettext n'est pas fonctionnelle sous windows wamp x64 et l'application doit être portable)
function translate($input){
	return \App\Translation\Translator::translate($input);
}


$app = new \Slim\App( require(__DIR__ . '/settings.php') );

$container = $app->getContainer();



$container['debug'] =  true;
if($container['debug'])
{
	$provider = new Kitchenu\Debugbar\ServiceProvider();
	$provider->register($app);
	//$container->debugbar->addMessage("verification log console log debug bar");
	$container->register(new Projek\Slim\MonologProvider);
	//$container->logger->info("verification log file monolog");
	//$container['settings']['cache']['active'] = false;	//pause pb
}


//CREATIONS DES DIFFERENTS CONTENEURS :
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

$container['csrf'] = function($container) {
	return new \Slim\Csrf\Guard;
};

$container['flash'] = function($container) {
	return new \Slim\Flash\Messages;
};

$container['view'] = function ($container) {
	
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views/', [
		'debug' => $container['debug']['active'],
		'cache' => $container['settings']['cache']['active'] ? $container['cache']['directory'] : false
	]);
	
	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));
	
	if($container->debug){
		$view->addExtension(new Twig_Extension_Debug());
	}
	
	//on definie les variables qui seront passes sur toutes les vues
	$view->getEnvironment()->addGlobal('auth',[
		'check' => $container->auth->check(),
		'checkadmin' => $container->auth->checkadmin(),
		'user' => $container->auth->user()
	]);

	$view->getEnvironment()->addGlobal('flash',$container->flash);

	return $view;
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

$container['UsersController'] = function($container) {
	return new \App\Controllers\Admin\UsersController($container);
};

$container['Validator'] = function ($container) {
	return new \App\Validation\Validator;
};




$app->add(new \App\Middleware\JsDataMiddleware($container));

$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));

$app->add(new \App\Middleware\OldInputMiddleware($container));

$app->add(new \App\Middleware\CsrfViewMiddleware($container)); //injecte csrf
$app->add($container->csrf); //defini token csrf

//ATTENTION: DERNIER MIDDLEWARE RAJOUTE EST CELUI QUI EST EXECUTE EN PREMIER


v::with('App\\Validation\\Rules\\');


require __DIR__ . '/routes.php';