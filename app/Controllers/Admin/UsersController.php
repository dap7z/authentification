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
		$DONNES_RECUES = $request->getParams();
		
		//on souhaite que les donnees de ce formulaire soient persistees ?
		//$_SESSION['old'] = $DONNES_RECUES;
		
		//un appel par modification / ou un bouton pour valider les modifications ... qui peuvent etre multiples :
		//!! UTILISER LE MODEL USER !!
		//ajout d'un utilisateur
		//modification d'un utilisateur
		//changement du mot de passe d'un utilisateur
		
		
		
		//$request->getParam('idligneect'),
		//$request->getParam('password')
		
		if($this->auth->checkadmin())
		{
			//$_SESSION['debugdump'] = $DONNES_RECUES;
			$myUserId = $_SESSION['user'];
			
			//utilisateur admin, on peut enregistrer $DONNES_RECUES :
			foreach($DONNES_RECUES["modified"] as $maj){
				if($maj["iduser"]==$myUserId && $maj["is_admin"]==0){
					//do nothing
				}else{
					User::where('id', $maj["iduser"])->update([
						'email' => $maj['email'],
						'telnumber' => $maj['telnumber'],
						'name' => $maj['name'],
						'surname' => $maj['surname'],
						'is_admin' => $maj['is_admin'],
					]);
				}
				//VERIF OK
				//(meme si plus de modified quen realite...)
			}
			
			foreach($DONNES_RECUES["deleted"] as $del){
				if($del["iduser"]==$myUserId){
					//do nothing
				}else{
					User::where('id', $del["iduser"])->delete();
				}
			}
			
			foreach($DONNES_RECUES["added"] as $add){
				$genPassword = $this->random_password();
				
				$user = User::create([
					'email' => $add['email'],
					'password' => password_hash($genPassword,PASSWORD_DEFAULT),
					'telnumber' => $add['telnumber'],
					'name' => $add['name'],
					'surname' => $add['surname']
				]);
				
				//attention envoi du mot de passe par mail... et meme code dans AuthController..........
				////////////////
				$title = 'Editions de France, vos identifiants de connexions';
				$postfields = array(
					'sendtomail' => $add['email'],
					'sendtoname' => $add['name'] .' '. $add['surname'],
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
										<p><span style="width: 200px; display: inline-block;">Nom d\'utilisateur: </span><b>'. $add['email'] .'</b> </p>
										<p><span style="width: 200px; display: inline-block;">Votre mot de passe: </span><b> '. $genPassword .'</b> </p>
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
				/////////////////
			}
			
			
			
			
			
			
			
			$this->render($response,'users/list.twig');	//non pris en compte car appel ajax
		}
		else{
			$this->flash->addMessage('error',"Vous n'avez pas l'autorisation d'acceder à cette page");
			$response->withRedirect($this->router->pathFor('auth.signin'));
		}
		

		if (!$this->auth->check()) {
			$this->flash->addMessage('error','Connexion impossible, verifiez vos identifiants');
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		}

		return $response->withRedirect($this->router->pathFor('users.getList'));
	}
	
	
	public function random_password( $length = 8 ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
	
}