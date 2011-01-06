<?php

include('dbFunctions.php');

$liste_participants = dbGetListeParticipantsEmission($_POST["id"]);

$array_participants = array();
while($array=mysql_fetch_array($liste_participants))
{	
	$array['existe'] = 0;
	$array['est_utilisateur'] = 0;
	$array['est_chef_complet'] = 0;

	$utilisateur = dbGetUtilisateur(urlencode(addslashes($array['nom_utilisateur'])));
	if ($utilisateur != 0)
	{
		$array['existe'] = 1;
		$array['est_utilisateur'] = 1;
		if ($utilisateur['mail'] != '' && $utilisateur['password'] != '')
			$array['est_chef_complet'] = 1;
	}

	//$array['nom_utilisateur'] = utf8_encode($array['nom_utilisateur']);					
	$array_participants[] = $array;	
}	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_participants)).");";

?>