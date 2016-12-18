<?php 

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;


/**
* Valide les donnees des formulaire
*/
class Validator
{
	protected $errors;
	
	public function validate($request,array $rules)
	{
		foreach ($rules as $field => $rule) {
			try {
				
				$rule->setName(ucfirst(translate($field)))->assert($request->getParam($field));
				//(avec traduction nom champ grace a la fonction translate)
				
			} catch (NestedValidationException $e) {
				
				//#Affectation d'une fonction de traduction des messages d'erreurs de la librairie Respect\Validation
				//#[Solution 1]
				//gettext() est une fonction php, voir: http://tassedecafe.org/fr/internationaliser-site-web-php-gettext-2878
				//$e->setParam('translator', 'gettext');
				//getMessages() renvoie le message traduit si il est renseigné dans le repertoire /lang
				//PROBLEME: GET TEXT NE FONCTIONNE PAS BIEN SUR WAMP x64
				//#[Solution 2]
				//fonction personalisée declarée dans app/translations.php :
				//$e->setParam('translator', 'translations');
				//#[Solution 3]
				//classe personalisée (permet log message non traduit)
				
				//$translator = \App\Translation\Translator::getInstance();
				//$e->setParam('translator', $translator);
				
				//traduction message générique :
				$e->setParam('translator', 'translate');
				$this->errors[$field] = $e->getMessages();
				
			}
			
		}

		$_SESSION['errors'] = $this->errors;
		return $this;
	}

	public function failed()
	{
		return !empty($this->errors);
	}
	
	
	public function translate()
	{
		
	}
	
}