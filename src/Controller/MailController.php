<?php namespace App\Controller;

final class MailController extends AbstractController
{
	
    public function sendMail($request, $response, $params)
    {
        //$this->debugger->addMessage($this->mailer->sendMail('this is a fake email', ['foo@bar.com'], 'fake delivery en developer mode.'));
        define('SMTP_API', 'https://editionsdefrance:WyKGDdhDyPvy5pDtWuXamb@api.dapo.mywire.org/gmail'); //PHPMailer sur serveur ubuntu
		
		$title = 'Editions de France, vos identifiants de connexions';
		$user = 'DAPO';
		$pass = 'QGEOJsqdjlqss';
		$mail = 'damien.pointier@gmail.com';

		/* pour l'instant pas de creation de mail par l'utilisateurs, uniquement via l'interface admin
		$urlvalidmail = '';	//url de validation
		<p>Merci de valider votre adresse mail en cliquant sur le lien ci dessous :</p>
		<br/><a href='$urlvalidmail'>$urlvalidmail</a>
		*/

		$postfields = array(
			'sendtomail' => 'damien.pointier@gmail.com',
			'sendtoname' => 'DAPO',
			'subject' => $title,
			'htmlmsg' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
							<html>
							<head>
							  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
							  <title>'. $title .'</title>
							</head>
							<body>
							<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
							  <h1>Editions de France</h1>
							  <p>Bonjour votre compte a été créé, voici vos identifiants : </p>
							  <p><span style="width: 100px; display: inline-block;">Nom d\'utilisateur: </span><b>'. $user .'</b> </p>
							  <p><span style="width: 100px; display: inline-block;">Mot de passe: </span><b>'. $pass .'</b> </p>
							  <br/>
							  <p>À très vite et n\'oubliez pas de personaliser votre mot de passe.</p>
							</div>
							</body>
							</html>'
		);


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, SMTP_API);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($ch);
		
		return $this->view->render($response, 'master.twig', [
            'name' => 'and watch the sended email.'
			'result' => '...'
        ]);
    }
	
}
