<?php
include('../dbFunctions/sendMail.php');
include('../sitevars.php');

$utilisateur = dbGetUtilisateur($_POST["nom"]);
if ($utilisateur != 0 && $utilisateur['mail'] != "")
{
	$file_email=sendPassword($utilisateur['mail']);
	if(!empty($file_email))
		$result=sendEmailFile($file_email);
}

?>