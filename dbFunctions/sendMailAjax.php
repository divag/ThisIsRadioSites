<?php
include('../sitevars.php');
//include('../dbFunctions/sendMail.php');
include('../dbFunctions/dbFunctions.php');

$utilisateur = dbGetUtilisateur($_POST["nom"]);
if ($utilisateur != 0 && $utilisateur['mail'] != "")
{
	//$result = file_get_contents($urlSendMail.'?from='.$mailAdmin.'&to='.$utilisateur['mail'].'&login='.addslashes(urlencode(utilisateur['nom'])).'&pass='.addslashes(urlencode($utilisateur['password'])));
	//$result = file_get_contents($urlSendMail.'?from='.$mailAdmin.'&to='.$utilisateur['mail'].'&login='.addslashes(urlencode(utf8_encode($utilisateur['nom']))).'&pass='.addslashes(urlencode(utf8_encode($utilisateur['password']))));
	$result = file_get_contents($urlSendMail.'?from='.$mailAdmin.'&to='.$utilisateur['mail'].'&login='.addslashes(urlencode($utilisateur['nom'])).'&pass='.addslashes(urlencode($utilisateur['password'])));
	//sendMail($utilisateur['mail'], $utilisateur['nom'], $utilisateur['password']);
}

?>