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
		return $this->render($response,'auth/signin.twig');
	}

	public function postSignIn($request, $response)
	{
		$_SESSION['old'] = $request->getParams(); //on souhaite que les donnees de ce formulaire soient persistees
		
		$auth = $this->auth->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);

		if($auth) 
		{
			//l'utilisateur viens de se connecter, pas besoin que le champ mail soit rempli a nouveau
			$_SESSION['old'] = array();
			if($this->auth->checkadmin()){
				//redirection vers la page de gestion des utilisateur
				return $response->withRedirect($this->router->pathFor('users.getList'));
			}
		}
		else
		{
			//echec de la connexion, on re-affiche l'adresse mail utilisée dans le champs
			$this->flash->addMessage('error','Connexion impossible, verifiez vos identifiants.');
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		}

		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function getSignUp($request,$response)
	{
		return $this->render($response,'auth/signup.twig');
	}

	public function postSignUp($request,$response)
	{
		$_SESSION['old'] = $request->getParams(); //on souhaite que les donnees de ce formulaire soient persistees
		
		$validation = $this->Validator->validate($request,[
			'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
			'password' => v::noWhitespace()->notEmpty(),
			'password_confirm' => v::noWhitespace()->notEmpty(),
			//'password_confirm' => v::equals($_POST['password']), //renvoi mdp mal saisi en clair...
		]);
		$password_confirm_failed = ($_POST["password"] != $_POST["password_confirm"]);
		if (!$validation->failed() && $password_confirm_failed) {
			$this->flash->addMessage('error',"Les mots de passes n'étaient pas identiques, veuillez réessayer.");
		}
		
		if ($validation->failed() || $password_confirm_failed) {
			if(! $password_confirm_failed){
				$this->flash->addMessage('error',"Vérifiez les informations saisies.");
			}
			return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		
		//creation de l'utilisateur en base de donnees :
		$user = User::create([
			'email' => $request->getParam('email'),
			'password' => password_hash($request->getParam('password'),PASSWORD_DEFAULT),
			'telnumber' => str_replace(' ','',$request->getParam('telnumber')),
			'name' => $request->getParam('name'),
			'surname' => $request->getParam('surname')
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
		
		
		$this->flash->addMessage('info','Vous êtes maintenant connecté.');

		$this->auth->attempt($user->email,$request->getParam('password'));
		
		return $response->withRedirect($this->router->pathFor('home'));
	}
}