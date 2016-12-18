<?php 

namespace App\Translation;

/**
* Traduit les messages en francais (Notament les erreurs de validation des formulaires) et log les chaines de carracteres qui n'ont pas de traduction definnie
*/

class Translator
{
	protected $tab_assoc;
	protected $logger;
	protected static $instance;
  
	//singleton (constructeur prive)
	protected function __construct() {
		$this->t = [];
		$this->logger = null;
		//todo: aller chercher les trads dans bdd
		
		//traduction des messages d'erreurs générés par Respect/Validation :
		$this->add("These {{failed}} rules must pass for {{name}}", "Ces {{failed}} régles doivent êtres respectées pour {{name}}");
		
		$this->add("These {{failed}} rules must pass for {{name}}", "Ces {{failed}} régles doivent êtres respectées pour {{name}}");
		$this->add("These rules must pass for {{name}}", "Les régles doivent êtres respectées pour {{name}}");
		
		$this->add("{{name}} must be an integer number", "{{name}} doit être un nombre entier");
		$this->add("{{name}} must not be empty", "{{name}} doit être renseigné");
		$this->add("{{name}} is already taken", "{{name}} est déjà enregistré");
		
		$this->add("{{name}} must be valid email", "{{name}} doit être une adresse valide");
		
		//traduction nom input vers libellé :
		$this->add("email", "email");
		$this->add("password", "mot de passe");
		$this->add("password_old", "mot de passe");
		$this->add("password_confirm", "confirmation");
		$this->add("name", "nom");
		$this->add("surname", "prénom");
		$this->add("surname", "prénom");
	}
	protected function add($texte, $traduction){
		$this->tab_assoc[$texte] = $traduction;
	}
	
	//singleton (clonage interdit)
	protected function __clone() { }
	
	//singleton (auto-instanciation)
	public static function getInstance()
	{
		if (!isset(self::$instance)){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	
	public static function initTranslator($logger = null)
	{
		$me = self::getInstance();
		if($logger!=null){
			$me->do_setLogger($logger);
		}
		return $me;
	}
	protected function do_setLogger($logger)
	{
		//doit etre prive car accede directement a $this->logger
		$this->logger = $logger;
		//$this->logger->info('Translator connected to logger');
	}
	
	
	public static function translate($input, $prefix="")
	{
		$me = self::getInstance();
		$translation = $me->do_translate($input);
		return $prefix . $translation;
	}
	protected function do_translate($input)
	{
		//doit etre prive car accede directement a $this->t
		if(isset($this->tab_assoc[$input]))
		{
			$output = $this->tab_assoc[$input];
		}
		else
		{
			$output = $input;
			if($this->logger != null){
				$this->logger->info("'".$input."' non traduit");
			}
		}
		return $output;
	}
	
	
}