<?php

namespace App\Middleware;

/**
* 
*/
class AccessAdminMiddleware extends Middleware
{
	
	public function __invoke($request,$response,$next)
	{
		if(!$this->container->auth->checkadmin()) {
			$this->container->flash->addMessage('error','Vous devez être administateur pour effectuer cette action');
			return $response->withRedirect($this->container->router->pathFor('auth.signin'));
		}

		$response = $next($request,$response);
		return $response;
		
	}
}