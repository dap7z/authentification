<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;


class AuthController extends Controller
{
	public function getSignOut($request,$response)
	{
		$this->auth->logout();
		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function getSignIn($request,$response)
	{
		return $this->view->render($response,'auth/signin.twig');
	}

	public function postSignIn($request,$response)
	{
		$auth = $this->auth->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);

		if (!$auth) {
			$this->flash->addMessage('error','Connexion impossible, verifiez vos identifiants');
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		}

		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function getSignUp($request,$response)
	{
		return $this->view->render($response,'auth/signup.twig');
	}

	public function postSignUp($request,$response)
	{

		$validation = $this->validator->validate($request,[
			'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
			'password' => v::noWhitespace()->notEmpty(),
			'passwordconfirm' => v::noWhitespace()->notEmpty(),
		]);

		
		if ($validation->failed()) {
			return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		$user = User::create([
			'email' => $request->getParam('email'),
			'password' => password_hash($request->getParam('password'),PASSWORD_DEFAULT),
		]);
		
		
		///////
		//envoi mail notification creation de compte (todo: remplacer par lien de validation adresse mail)
		$title = 'Editions de France, vos identifiants de connexions';
		$lastcharspass = $request->getParam('password');
		$lastcharspass = substr($lastcharspass,strlen($lastcharspass)-3);
		$mail = 'damien.pointier@gmail.com';
		$postfields = array(
			'sendtomail' => $user->email,
			'sendtoname' => $user->name .' '. $user->surname,
			'subject' => $title,
			'htmlmsg' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
							<html>
							<head>
							  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
							  <title>'. $title .'</title>
							</head>
							<body>
							<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
							  <h1>Editions de France</h1>
							  <p>Bonjour votre compte a été créé, nous vous rappelons vos identifiants : </p>
							  <p><span style="width: 200px; display: inline-block;">Nom d\'utilisateur: </span><b>'. $user->email .'</b> </p>
							  <p><span style="width: 200px; display: inline-block;">Fin de votre mot de passe: </span><b>************'. $lastcharspass .'</b> </p>
							  <br/>
							  <p>À très vite.</p>
							</div>
							</body>
							</html>'
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://editionsdefrance:WyKGDdhDyPvy5pDtWuXamb@api.dapo.mywire.org/gmail");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($ch);
		///////
		
		
		$this->flash->addMessage('info','Vous êtes maintenant connecté');

		$this->auth->attempt($user->email,$request->getParam('password'));
		
		return $response->withRedirect($this->router->pathFor('home'));
	}
}