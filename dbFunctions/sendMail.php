<?php
include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

/*
 * Function generateEmailFile : permet de créer un fichier csv utilisé pour l'envoi de mail
 * Format fichier csv : FROM|||TO|||TITLE|||MESSAGE TEXT|||MESSAGE HTML
 * @params $id : identifiant de l'utilisateur concerné (son mot de passe ou les mails qu'il envoie)
 * @params $from : expediteur
 * @params $to : destinataire
 * @params $title : titre du message à envoyer
 * @params $msg : message à envoyer
 * @returns : path relatif du fichier ou null 
 */
 function generateEmailFile($id,$from,$to,$title,$msgTxt,$msgHtml)
 {
 	// les séparateur sont "|||" mais on check tout de même dans les chaines
 	while(strpos($msgTxt,"|||"))
 		str_replace("|||","|",$msgTxt);
 	while(strpos($msgHtml,"|||"))
 		str_replace("|||","|",$msgTxt);
 	
 	// on vérifie que le dossier de l'utilisateur a été créé
 	if(!file_exists("../".PATH_MAIL.$id))
 	{
 		if(!mkdir("../".PATH_MAIL.$id))
 		{
 			echo "ERREUR LORS DE LA CREATION DU DOSSIER";
 			return false;
 		}
 	}
 	$file=  "../".PATH_MAIL.$id."/".time().".csv";
 	$fp=fopen($file,"w+");
 	$str=$from."|||".$to."|||".$title."|||".$msgTxt."|||".$msgHtml;
 	fwrite($fp,$str);
 	fclose($fp);
 	return $file;
 }

 /*
  * Function sendEmailFile permet d'envoyer par mail un fichier "email" généré au préalable 
  * @param : $fileEmail : path relatif vers le fichier contenant les infos pour le mail
  */
 function sendEmailFile($file_email)
 {
 	$url_file=str_replace("../",RADIOCLASH_HOME,$file_email);
 	return file_get_contents(URL_SEND_MAIL.'?fileurl='.$url_file);
 }
 
 
 
 /*
  * Function sendPassword permet d'envoyer le mail d'oubli de mot de passe
  * @params : $email = email de l'utilisateur
  */
 function sendPassword($email)
 {
 	$utilisateur = dbGetUtilisateurByMail($email);
	if(!empty($utilisateur['id']))
	{
		$mail_text  = "Yo !\r\n\r\nEn tant que chef d'une équipe de RadioClash, vous avez le droit à un accès \"CHEF\" qui vous permet d'uploader directement sur le site vos fichiers d'émission :\r\n\r\n";
        $mail_text .= " - La pochette en JPG (taille : 346X346)\r\n";
        $mail_text .= " - La pochette en GIF animé s'il y en a une\r\n";
        $mail_text .= " - Un MP3 de teaser de l'émission\r\n";
        $mail_text .= " - LE MP3 DE L'EMISSION (150Mo maxi - pour 100Mo, il faut patienter environ 15 minutes pendant l'upload)\r\n\r\n";
        $mail_text .= "Pour cela, se connecter ici (Attention : Merci de ne pas partager cette adresse sur l'INTERNET !!) :\r\n\r\n";
        $mail_text .= " - http://www.thisisradioclash.org/admin/ (copier-coller le lien dans votre navigateur)\r\n\r\n";
        $mail_text .= "Voici vos identifiants de connexion à This Is Radioclash, accès \"CHEF\" :\r\n\r\n";
        $mail_text .= " - Login : \"".$utilisateur['nom']."\"\r\n";
        $mail_text .= " - Mot de passe : \"".$utilisateur['password']."\"\r\n";
        $mail_text .= "\r\n";
		
         $mail_html="<div><img src=\"".RADIOCLASH_HOME."css/bandeau.gif\" alt=\"THIS IS RADIOCLASH !\" /><br /><br />
         
         Yo !<br /><br />
 		En tant que chef d'une &eacute;quipe de RadioClash, vous avez le droit &agrave; un acc&egrave;s \"CHEF\" qui vous permet d'uploader directement sur le site vos fichier d'&eacute;mission :
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
		   <li>Login : \"".$utilisateur['nom']."\"</li>
		   <li>Mot de passe : \"".$utilisateur['password']."\"</li>
		 </ul>
		</div>";
		return generateEmailFile($utilisateur['id'],MAIL_ADMIN,$utilisateur['mail'],utf8_decode("[This Is Radioclash] Accès Chef"),utf8_decode($mail_text),utf8_decode($mail_html));
	}	
	else
		return false;
 }
 
 
 
/*
 * Function isMail permet de checker que l'adresse email est pseudo valide
 * @params: email, la chaine à tester
 * @return: true / false
 */
 function isMail($email)
 {
 	return preg_match('/^[a-z0-9]+[._a-z0-9-]*@[a-z0-9]+[._a-z0-9-]*\.[a-z0-9]+$/ui', $email);
 } 
?>