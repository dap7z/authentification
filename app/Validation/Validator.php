<?php 

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

/**
* 
*/
class Validator
{
	protected $errors;
	
	public function validate($request,array $rules)
	{
		foreach ($rules as $field => $rule) {
			try {
				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			} catch (NestedValidationException $e) {
				//On affecte une fonction de traduction des messages d'erreurs de la librairie Respect\Validation
				//gettext() est une fonction php, voir: http://tassedecafe.org/fr/internationaliser-site-web-php-gettext-2878
				$e->setParam('translator', 'gettext');
				//getMessages() renvoie le message traduit si il est renseigné dans le repertoire /lang
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
	
}