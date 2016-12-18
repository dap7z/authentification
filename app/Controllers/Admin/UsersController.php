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
			//utilisateur admin, on peut enregistrer $DONNES_RECUES :
			
			$_SESSION['dumpdapo'] = $DONNES_RECUES;
			
			
			
			
			$this->render($response,'users/list.twig');
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
	
	
}