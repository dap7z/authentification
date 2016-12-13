<?php
	define('APP', 'authentification');
	//CHARGEMENT DE LA CONFIGURATION
	foreach(glob('../config/*.php') as $conf){
		include_once $conf;
	}
	//PARAMETRES URL
	$etape = "";
	if(isset($_REQUEST["etape"]) $etape = $_REQUEST["etape"];
	if(!in_array($etape,array("verifSMTP")) $etape = "";
	
	switch($etape)
	{
		case "":
			//1) VERIFICATION CONNECTION BDD
			$bdd = null;
			try {
				$bdd = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
			} catch (PDOException $e) {
				print "<br/> Erreur : " . $e->getMessage();
				print "<br/> Verifiez les parametres de connection dans config/BDD.php";
				die();
			}
		
			//2) INSTALLATION BDD
			$check = $bdd->exec('SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '.BDD_BASE);
			if($check->fetchColumn() == 0){
				//la base n'existe pas encore, on install le fichier sql :
				$sql = file_get_contents('../config/installBDD.sql');
				$sqlparts = explode(';', $sql);
				try {
					foreach ($sqlparts as $sqlreq) {
					  $bdd->exec($sqlreq);
					}
				} catch (PDOException $e) {
					print "<br/> Erreur : " . $e->getMessage();
					print "<br/> Verifiez le fichier config/installBDD.sql";
					die();
				}
				print "<br/> Création base terminé.";
			}
			else{
				print "<br/> La base ". BDD_BASE ." existe déjà.";
			}
			
		break;
		
		case "verifSMTP":
			//3) VERIFICATION OUVERTURE PORT SMTP
			$ch = curl_init();
			$urlTestPort = 'http://open.zorinaq.com:'.SMTP_PORT;
			//$urlTestPort = 'http://open.zorinaq.com:443';
			curl_setopt($ch, CURLOPT_URL, $urlTestPort);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$resultat = curl_exec ($ch);
			curl_close($ch);
			echo "<br/> $resultat";
		break;
	}
	
	$bdd = null;
?>