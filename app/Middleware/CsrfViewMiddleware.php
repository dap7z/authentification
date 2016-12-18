<?php

namespace App\Middleware;

/**
* Ce Middleware permet l'affichage de jetons csrf dans les pages du site
* Cela permet de s'assurer que cest bien l'utilisateur qui a déclenché l'action, exemple de problèmes evites: 
* 	- admin connecte au site click sur un lien caché sur un autre site ou sur un mail: http://notresite.fr/process.php?action=changepassword&iduser=44
* 	- flood sur formulaire de contact (même si cela reste possible avec un premier appel pour recuperer le jeton)
*/
class CsrfViewMiddleware extends Middleware
{
	
	public function __invoke($request,$response,$next)
	{
		$this->container->view->getEnvironment()->addGlobal('csrf',[
			'field' => '
				<input type="hidden" name="'. $this->container->csrf->getTokenNameKey() .'"
				 value="'. $this->container->csrf->getTokenName() .'">
				<input type="hidden" name="'. $this->container->csrf->getTokenValueKey() .'"
				 value="'. $this->container->csrf->getTokenValue() .'">
			',
		]);
		
		//DEVRAIT ETRE ICI CAR DERNIER MIDDLE WAR DECLARER 1ER EXECUTE :
		//$_SESSION['old'] = $request->getParams();
		//... MAIS NE FONCTIONNE PAS
		//donc on le fait au nniveau du traitement des formulaire dans les controller (ex: postSignIn et postSignUp de Auth controller)
		

		$response = $next($request,$response);
		return $response;
	}
}