<?php

namespace App\Controllers;

/**
* 
*/
class Controller
{
	protected $container;

	public function __construct($container)
	{
		$this->container = $container;
	}

	public function __get($property)
	{
		if ($this->container->{$property}) {
			return $this->container->{$property};
		}
	}
	
	//raccourcie permetant de rendre directement la vue
	public function render($response, $file, $variables=[])
	{
		//- $responce est un objet representant la reponse du serveur
		//- $file est le nom du fichier .twig correspondant a la vue
		//- $variables est un tableau de donnees optionnel a passer a la vue
		return $this->view->render($response, $file, $variables);
	}
	
	
	public function toast($message, $type='success')
	{
		if(! isset($_SESSION["toast"]) ){
			$_SESSION["toast"] = [];
		}
		return $_SESSION['toast'][$type] = $message;
	}
	
}