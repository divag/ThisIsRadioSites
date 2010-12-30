<?php
include('../sitevars.php');

// Plusieurs destinataires
//$to  = 'aidan@example.com' . ', '; // notez la virgule
$to = $mailAdmin;
$to = $mailAdminAlertes;

// Sujet

if (utf8_decode($_POST["objet"]) == 'playlist')
	$subject = '[This Is Radioclash '.utf8_encode(utf8_decode($_POST["numero"])).'] Le chef vous envoie un message !';
else
	$subject = '[This Is Radioclash '.utf8_encode(utf8_decode($_POST["numero"])).'] '.utf8_decode($_POST["objet"]).' : '.utf8_decode($_POST["action"]).' !';

//-----------------------------------------------
//DECLARE LES VARIABLES
//-----------------------------------------------

$email_expediteur=$mailAdmin;
$email_reply=$mailAdmin;
$destinataire=$to;

//-----------------------------------------------
//GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET HTML
//-----------------------------------------------

$frontiere = '-----=' . md5(uniqid(mt_rand()));

//-----------------------------------------------
//HEADERS DU MAIL
//-----------------------------------------------

$headers = 'From: "This Is Radioclash" <'.$email_expediteur.'>'."\n";
$headers .= 'Return-Path: <'.$email_reply.'>'."\n";
$headers .= 'MIME-Version: 1.0'."\n";
$headers .= 'Content-Type:  text/html; charset=utf8';
$sujet = $subject;    

if (utf8_decode($_POST["objet"]) == 'playlist')
{
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

mail($destinataire,$sujet,$message,$headers);

?>