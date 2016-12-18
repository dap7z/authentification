<?php

namespace App\Middleware;

/**
* Middleware qui permet de conserver le ocntenu des champs en cas d'echec de soumission d'un formulaire
*/
class OldInputMiddleware extends Middleware
{
	
	public function __invoke($request,$response,$next)
	{
		//injection de la variable old.* dans la vue twig :
		$this->container->view->getEnvironment()->addGlobal('old',isset($_SESSION['old']) ? $_SESSION['old'] : []);
		//attention $_SESSION['old'] doit être assignee lors du traitement des formulaires
		
		$response = $next($request,$response);
		return $response;
	}
}