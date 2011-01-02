<?php
include('../sitevars.php');
include('../dbFunctions/sendMail.php');

// Sujet
if (utf8_decode($_POST["objet"]) == 'playlist')
	$subject = '[This Is Radioclash '.utf8_encode(utf8_decode($_POST["numero"])).'] Le chef vous envoie un message !';
else
	$subject = '[This Is Radioclash '.utf8_encode(utf8_decode($_POST["numero"])).'] '.utf8_encode(utf8_decode($_POST["objet"])).' : '.utf8_encode(utf8_decode($_POST["action"])).' !';

//-----------------------------------------------
//DECLARE LES VARIABLES
//-----------------------------------------------

$destinataire=$mailAdmin;
$sujet = $subject;    

if (utf8_decode($_POST["objet"]) == 'playlist')
{
	$messageTexte  = "Hep Patron !!!\r\n\r\n";
	$messageTexte .= stripslashes(utf8_decode($_POST["login"])).", et bein il/elle a envoyé un message concernant l'émission n°".utf8_decode($_POST["numero"]).",  que voilà :\r\n\r\n";
	$messageTexte .= stripslashes(urldecode($_POST["action"]))."\r\n\r\n";
	$messageTexte=utf8_encode($messateTexte);
	
	$message=utf8_encode('
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html>
	  <head>
	  <meta http-equiv="content-type" content=\"text/html; charset=utf8\">	  
	 </head>
	   <body>
		Hep Patron !!!<br /><br />
		'.stripslashes(utf8_decode($_POST["login"])).', et bein il/elle a envoyé un message concernant l\'émission n°'.utf8_decode($_POST["numero"]).',  que voil&agrave; :<br /><br />
		<br />
		').stripslashes(urldecode($_POST["action"])).'
		<br />
	   </body>
	 </html>
	';	   
}
else
{
	$messageTexte  = "Hep Patron !!!\r\n\r\n";
	$messageTexte .= stripslashes(utf8_decode($_POST["login"])).", et bein il/elle a ".utf8_decode($_POST["action"])." un fichier pour l'émission n°".utf8_decode($_POST["numero"])."\r\n\r\n";
	$messageTexte .= stripslashes(urldecode($_POST["objet"]))."\r\n\r\n";
	$messageTexte=utf8_encode($messateTexte);
	
	$message=utf8_encode('
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html>
	  <head>
	  <meta http-equiv="content-type" content="text/html; charset=utf8">  
	  <title></title>
	  <style type="text/css">
	  body {
		background-color: #edf2f8;
	  }
	  
	 </style>
	 </head>
	   <body>
		Hep Patron !!!<br /><br />
		'.stripslashes(utf8_decode($_POST["login"])).', et bein il/elle a '.utf8_decode($_POST["action"]).' un fichier pour l\'émission n°'.utf8_decode($_POST["numero"]).'...<br /><br />
		C\'est ça :
		<ul>
			<li>'.utf8_decode($_POST["objet"]).'</li>
		</ul>
	   </body>
	 </html>
	');	   
}

$file_email=generateEmailFile("AlertesAdministrateur",MAIL_ADMIN,$destinataire,utf8_decode($sujet),utf8_decode($messageTexte),utf8_decode($message));
if(!empty($file_email))
	$result=sendEmailFile($file_email);

?>