<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;


class UsersController extends Controller
{
	public function getList($request,$response)
	{
		if($this->auth->checkadmin())
		{
			$tab_user = User::all()->sortBy("name,surname")->toJson();
			
			$this->render($response, 'users/list.twig', ['usersData' => $tab_user]);
		}
		else{
			$this->flash->addMessage('error',"Vous n'avez pas l'autorisation d'acceder à cette page");
			$response->withRedirect($this->router->pathFor('auth.signin'));
		}
	}
	
	
	public function postList($request, $response)
	{
		$postData = $request->getParams();
		$postData = json_decode($postData["formjson"], true);
		
		
		//$_SESSION['old'] = $postData;
		//on souhaite que les donnees de ce formulaire soient persistees ?
		//=> non on effectuera les modifications demandé par l'admin mais on lui affichera des avertissements
		//(on lui interdit quand meme de suppr son compte ou de se passer membre)
		
		
		if($this->auth->checkadmin())
		{
			//utilisateur admin, on peut enregistrer $postData
			$errorsAndWarnings = array();
			$myUserId = $_SESSION['user'];
			
			
			foreach($postData["modified"] as $maj){
				//verifications :
				if($maj["iduser"]==$myUserId && $maj["is_admin"]!="oui"){
					//probleme detecte
					$maj["is_admin"] = "oui";	//on ne tient pas compte du fait qu'il est selectionne 'non'
					$errorsAndWarnings []= "autodestitution interdite";
				}
				
				try {
					v::noWhitespace()->notEmpty()->email()->emailAvailable()->check($maj['email']);
				} catch (\InvalidArgumentException $e) {
					$errorsAndWarnings []= "email '". $maj['email'] ."' non valide";	//declenche aussi pour "already taken"
				}
				/* probleme exception non capturee (car execute a suivre?):
				try {
					v::noWhitespace()->noWhitespace()->length(0, 10)->check($maj['telnumber']);
				} catch (\InvalidArgumentException $e) {
					$errorsAndWarnings []= "numtel '". $maj['telnumber'] ."' non valide ";
				}*/
				//..et a mettre si on permet la saisie du mot de passe d'un nouvel utilisateur directement dans le talbeau :
				//password v::noWhitespace()->notEmpty() $errorsAndWarnings []= "le mot de passe de '". $maj['email'] ." est insufisant";
				
				//maj bdd :
				if($maj["iduser"]=="new")
				{
					$genPassword = $this->random_password();
					$user = User::create([
						'email' => $maj['email'],
						'password' => password_hash($genPassword,PASSWORD_DEFAULT),
						'telnumber' => $maj['telnumber'],
						'name' => $maj['name'],
						'surname' => $maj['surname']
					]);
					$optn = $maj;
					$optn['title'] = 'Editions de France, vos identifiants de connexions';
					$optn['password'] = $genPassword;
					$this->sendMailNewUser($optn);		//mdp dans mail... todo: lien validation mail
				}
				else
				{
					User::where('id', $maj["iduser"])->update([
						'email' => $maj['email'],
						'telnumber' => $maj['telnumber'],
						'name' => $maj['name'],
						'surname' => $maj['surname'],
						'is_admin' => $maj['is_admin'],
					]);
				}
			}
			
			foreach($postData["deleted"] as $del){
				if($del["iduser"]==$myUserId){
					//probleme detecte
					$errorsAndWarnings []= "autodestruction interdite";
				}else{
					//maj bdd
					User::where('id', $del["iduser"])->delete();
				}
			}
			
			if(!empty($errorsAndWarnings)){
				$errorsAndWarnings = implode(", ", $errorsAndWarnings);
				$errorsAndWarnings = "Attention veuillez vérifier les points suivants : ".$errorsAndWarnings;
				$this->flash->addMessage('error',$errorsAndWarnings);	//Attention 'warning' non reconnu
				// <br/> html non interpreté par defaut dans les messages flash
			}
			$this->render($response,'users/list.twig');
			
		}
		else{
			$this->flash->addMessage('error',"Vous n'avez pas l'autorisation d'acceder à cette page");
			$response->withRedirect($this->router->pathFor('auth.signin'));
		}
		

		if(!$this->auth->check()) {
			$this->flash->addMessage('error','Connexion impossible, verifiez vos identifiants');
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		}

		return $response->withRedirect($this->router->pathFor('users.getList'));
	}
	
	
	
	public function random_password($length = 8){
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password = substr(str_shuffle($chars), 0, $length);
		return $password;
	}
	
	
	public function sendMailNewUser($optn){
		//attention envoi du mot de passe par mail... et pratiquement meme code dans AuthController...
		$title = 'Editions de France, vos identifiants de connexions';
		$postfields = array(
			'sendtomail' => $optn['email'],
			'sendtoname' => $optn['name'] .' '. $optn['surname'],
			'subject' => $optn['title'],
			'htmlmsg' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
							<html>
							<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
								<title>'. $optn['title'] .'</title>
							</head>
							<body>
							<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
								<h1>Editions de France</h1>
								<p>Bonjour votre compte a été créé, nous vous rappelons vos identifiants : </p>
								<p><span style="width: 200px; display: inline-block;">Nom d\'utilisateur: </span><b>'. $optn['email'] .'</b> </p>
								<p><span style="width: 200px; display: inline-block;">Votre mot de passe: </span><b> '. $optn['password'] .'</b> </p>
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
	}
	
}