<?php
use App\Middleware\AccessGuestMiddleware;
use App\Middleware\AccessAuthMiddleware;
use App\Middleware\AccessAdminMiddleware;


$app->get('/','HomeController:index')->setName('home');


//Invites :
$app->group('',function () {
	$this->get('/auth/signup','AuthController:getSignUp')->setName('auth.signup');
	$this->post('/auth/signup','AuthController:postSignUp');

	$this->get('/auth/signin','AuthController:getSignIn')->setName('auth.signin');
	$this->post('/auth/signin','AuthController:postSignIn');
	
	//[SI DEBUGBAR ACTIVEE] problème d'acces à /auth/signup /auth/signout avec utilisateur connecte: 
	//ReflectionException Class AuthController does not exist in slim-debugbar\src\DataCollector\SlimRouteCollector.php
	//[SINON] Pas de soucis, on est redirigé vers home.
	
	//Depuis slim v3 les groupes sont devenus des closures et on ne peux plus passer de namespace en parametre de la fonction
	
})->add(new AccessGuestMiddleware($container));


//Utilisateurs authentifies :
$app->group('',function () {
	$this->get('/auth/signout','AuthController:getSignOut')->setName('auth.signout');

	$this->get('/auth/password/change','PasswordController:getChangePassword')->setName('auth.password.change');
	$this->post('/auth/password/change','PasswordController:postChangePassword');
	
})->add(new AccessAuthMiddleware($container));


//Administrateurs :
$app->group('',function () {
	$this->get('/users/list','UsersController:getList')->setName('users.getList');
	$this->post('/users/list','UsersController:postList')->setName('users.postList');

})->add(new AccessAdminMiddleware($container));


// Devellopeurs :
//todo: AccessDevMiddleware => full access + active debug


//ATTENTION: le nom des routes doivent toujours commencer par /


