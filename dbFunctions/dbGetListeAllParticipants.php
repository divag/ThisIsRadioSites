<?php

include('dbFunctions.php');

$liste_participants = dbGetListeAllParticipants();

$array_participants = array();
while($array=mysql_fetch_array($liste_participants))
{	
	//$array['nom_utilisateur'] = utf8_encode($array['nom_utilisateur']);					
	$array_participants[] = $array;
}	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_participants)).");";

?>