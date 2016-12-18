<?php

namespace App\Middleware;

/**
* Middleware qui permet de passer le tableau $_SESSION[jsdata] à la vue twig et donc au javascript
*/
class JsDataMiddleware extends Middleware
{
	
	public function __invoke($request,$response,$next)
	{
		$jsdata = array();
		if(isset($_SESSION['jsdata']) && is_array($_SESSION['jsdata'])){
			$jsdata = $_SESSION['jsdata'];
		}
		
		$this->container->view->getEnvironment()->addGlobal('jsdata',$jsdata);
		
		$response = $next($request,$response);
		return $response;
	}
}