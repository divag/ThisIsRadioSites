<?php

function sendMail($p_mail, $p_login, $p_password)
{
	include('../sitevars.php');

     // Plusieurs destinataires
     //$to  = 'aidan@example.com' . ', '; // notez la virgule
     $to = $p_mail;

     // Sujet
     $subject = '[This Is Radioclash] : Accès "CHEF" !';

     //-----------------------------------------------
     //DECLARE LES VARIABLES
     //-----------------------------------------------

     $email_expediteur=$mailAdmin;
     $email_reply=$mailAdmin;
     $destinataire=$to;

	//-----------------------------------------------
	//GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET HTML
	//-----------------------------------------------

	$limite = "_".md5 (uniqid (rand())); 
	
	//-----------------------------------------------
	//HEADERS DU MAIL
	//-----------------------------------------------

	$headers = "MIME-Version: 1.0\n"; 

	$headers .= "X-Sender: <www.thisisradioclash.org>\r\n"; 
	//$headers .= "X-Sender: jeroboam.pastis-hosting.net\r\n"; 
	$headers .= "X-Mailer: PHP\r\n"; 
	$headers .= "X-auth-smtp-user: $email_reply \r\n"; 
	$headers .= "X-abuse-contact: abuse@thisisradioclash.org ";

	$headers .= "Reply-to: ContactRadioclash <".$email_reply.">\n"; 
	$headers .= "From: $email_reply <$email_reply>\n"; 

	$headers .= "Content-Type: multipart/alternative; boundary=\"=$limite\"\n"; 
	$headers .="Content-Transfer-Encoding: 7bit \n"; 

	////////////////////////////
	// CONTENU DU MESSAGE :
	////////////////////////////
	
	$messageHTML="Yo !<br /><br />
	 En tant que chef d'une &eacute;quipe de RadioClash, vous avez le droit &agrave; un acc&egrave;s \"CHEF\" qui vous permet d'uploader directement sur le site vos fichier d'émission :
	 <ul>
		<li>La pochette en JPG (taille : 346X346)</li>
		<li>La pochette en GIF anim&eacute; s'il y en a une</li>
		<li>Un MP3 de teaser de l'&eacute;mission</li>
		<li>LE MP3 DE L'EMISSION (150Mo maxi - pour 100Mo, il faut patienter environ 15 minutes pendant l'upload)</li>
	</ul>
	<p><u>Pour cela, se connecter ici (<font style=\"color:red;\">Attention : Merci de ne pas partager cette adresse sur l'INTERNET !!</font>) :</u></p>
	<ul>
		<li><a href=\"http://www.thisisradioclash.org/admin/\" target=\"blank\"><b>http://www.thisisradioclash.org/admin/</b></a></li>
	</ul>
    <p><u>Voici vos identifiants de connexion &agrave; This Is Radioclash, acc&egrave;s \"CHEF\" :</u></p>
     <ul>
       <li>Login : \"".utf8_encode($p_login)."\"</li>
       <li>Mot de passe : \"".utf8_encode($p_password)."\"</li>
     </ul>
    </td></tr>
    </table>";
	
	$messageTEXT  = "Yo !\r\n\r\nEn tant que chef d'une équipe de RadioClash, vous avez le droit à un accès \"CHEF\" qui vous permet d'uploader directement sur le site vos fichier d'émission :\r\n\r\n";
	$messageTEXT .= " - La pochette en JPG (taille : 346X346)\r\n";
	$messageTEXT .= " - La pochette en GIF animé s'il y en a une\r\n";
	$messageTEXT .= " - Un MP3 de teaser de l'émission\r\n";
	$messageTEXT .= " - LE MP3 DE L'EMISSION (150Mo maxi - pour 100Mo, il faut patienter environ 15 minutes pendant l'upload)\r\n\r\n";
	$messageTEXT .= "Pour cela, se connecter ici (Attention : Merci de ne pas partager cette adresse sur l'INTERNET !!) :\r\n\r\n";
	$messageTEXT .= " - http://www.thisisradioclash.org/admin/ (copier-coller le lien dans votre navigateur)\r\n\r\n";
    $messageTEXT .= "Voici vos identifiants de connexion à This Is Radioclash, accès \"CHEF\" :\r\n\r\n";
    $messageTEXT .= " - Login : \"".utf8_encode($p_login)."\"\r\n";
    $messageTEXT .= " - Mot de passe : \"".utf8_encode($p_password)."\"\r\n";
	$messageTEXT .= "\r\n";

	
	$sujet = $subject; 
	
	//Le message en texte simple pour les navigateurs qui 
	//n'acceptent pas le HTML 
	$texte_simple = "This message is in MIME format.\n"; 
	$texte_simple .= "--=$limite\n"; 
	$texte_simple .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\n"; 
	$texte_simple .= "Content-Transfer-Encoding: 7bit\n\n"; 
	$texte_simple .= $messageTEXT."\n\n"; 
	$texte_simple .= "\n\n"; 


	//le message en html original 
	$texte_html = "--=$limite\n"; 
	$texte_html .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n"; 
	$texte_html .= "Content-Transfer-Encoding: 7bit\n\n"; 
	$texte_html .= $messageHTML."\n\n"; 
	$texte_html .= "--=".$limite."--\n"; 

	$message = $texte_simple.$texte_html;
	 /*

     $frontiere = '-----=' . md5(uniqid(mt_rand()));

    //-----------------------------------------------
     //HEADERS DU MAIL
     //-----------------------------------------------

     $headers = 'From: "This Is Radioclash" <'.$email_expediteur.'>'."\n";
     $headers .= 'Return-Path: <'.$email_reply.'>'."\n";
     $headers .= 'MIME-Version: 1.0'."\n";
     $headers .= 'Content-Type:  text/html; charset=windows-1250';
     $sujet = $subject;    
    
$message="
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
  <head>
  <meta http-equiv=\"content-type\" content=\"text/html; charset=utf8\">  
  <title></title>
  <style type=\"text/css\">
  body {
    background-color: #edf2f8;
  }
  
 </style>
 </head>
   <body>
    <table>
    <tr><td>
	 Yo !<br /><br />
	 En tant que chef d'une &eacute;quipe de RadioClash, vous avez le droit &agrave; un acc&egrave;s \"CHEF\" qui vous permet d'uploader directement sur le site vos fichier d'émission :
	 <ul>
		<li>La pochette en JPG (taille : 346X346)</li>
		<li>La pochette en GIF anim&eacute; s'il y en a une</li>
		<li>Un MP3 de teaser de l'&eacute;mission</li>
		<li>LE MP3 DE L'EMISSION (150Mo maxi - pour 100Mo, il faut patienter environ 15 minutes pendant l'upload)</li>
	</ul>
	<p><u>Pour cela, se connecter ici (<font style=\"color:red;\">Attention : Merci de ne pas partager cette adresse sur l'INTERNET !!</font>) :</u></p>
	<ul>
		<li><a href=\"http://www.thisisradioclash.org/admin/\" target=\"blank\"><b>http://www.thisisradioclash.org/admin/</b></a></li>
	</ul>
    <p><u>Voici vos identifiants de connexion &agrave; This Is Radioclash, acc&egrave;s \"CHEF\" :</u></p>
     <ul>
       <li>Login : \"".utf8_encode($p_login)."\"</li>
       <li>Mot de passe : \"".utf8_encode($p_password)."\"</li>
     </ul>
    </td></tr>
    </table>
   </body>
 </html>
";	   
*/

/*
   
    $boundary = "_".md5 (uniqid (rand()));
    $headers = "MIME-Version: 1.0\n";
   
    //$headers .= "X-Sender: <www.thisisradioclash.org>\n";
    $headers .= "X-Sender: <jeroboam.pastis-hosting.net>\n";
    $headers .= "X-Mailer: PHP\n";
    $headers .= "X-auth-smtp-user: anonymous@jeroboam.pastis-hosting.net \n";
    $headers .= "X-abuse-contact: abuse@jeroboam.pastis-hosting.net \n";
   
    $headers .= "Reply-to: Contact <contact@thisisradioclash.org>\n";
    $headers .= "From: Contact <anonymous@jeroboam.pastis-hosting.net>\n"; 
   
    $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"";
   
    $message = "--" . $boundary . "\n";
    $message.= "This is a multi-part message in MIME format.\n\n";
   
    $message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
    $message .= "Content-Transfer-Encoding: quoted-printable\n\n";
    $message .= $messageTEXT;
    $message .= "\n\n";
    $message .= "--" . $boundary . "\n";
    $message .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
    $message .= "Content-Transfer-Encoding: quoted-printable\n\n";
    $message .= str_replace("=","=3D",$messageHTML);
    $message .= "\n\n";

*/

mail($destinataire,$sujet,$message,$headers);

}

?>