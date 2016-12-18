<?php

namespace App\Middleware;

/**
* 
*/
class AccessAuthMiddleware extends Middleware
{
	
	public function __invoke($request,$response,$next)
	{
		if(!$this->container->auth->check()) {
			$this->container->flash->addMessage('error','Vous devez être connecté pour effectuer cette action');
			return $response->withRedirect($this->container->router->pathFor('auth.signin'));
		}

		$response = $next($request,$response);
		return $response;
		
	}
}