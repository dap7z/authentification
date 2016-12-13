<?php
//Create a new PHPMailer instance
$mail = new PHPMailerOAuth;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

$mail->SMTPDebug = SMTP_DEBUG;
$mail->Timeout = SMTP_TIMEOUT;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = SMTP_HOST;

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = SMTP_PORT;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = SMTP_SECURE;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Set AuthType
$mail->AuthType = 'XOAUTH2';

//User Email to use for SMTP authentication - Use the same Email used in Google Developer Console
$mail->oauthUserEmail = OAUTH_USER_EMAIL;

//Obtained From Google Developer Console
$mail->oauthClientId = OAUTH_CLIENT_ID;

//Obtained From Google Developer Console
$mail->oauthClientSecret = OAUTH_CLIENT_SECRET;

//Obtained By running get_oauth_token.php after setting up APP in Google Developer Console.
//Set Redirect URI in Developer Console as https://<yourdomain>/<folder>/get_oauth_token.php
$mail->oauthRefreshToken = OAUTH_REFRESH_TOKEN;

//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as
$mail->setFrom(OAUTH_USER_EMAIL, 'Mail Automatique');

//Set who the message is to be sent to
$mail->addAddress('damien.pointier@gmail.com', '');	//second param nom d'utilisateur

//Set the subject line
$mail->Subject = 'PHPMailer GMail test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents(__DIR__ .'/contentsutf8.html'), __DIR__);
//contents.html contentsutf8.html

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
$mail->addAttachment(__DIR__ . '/images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
