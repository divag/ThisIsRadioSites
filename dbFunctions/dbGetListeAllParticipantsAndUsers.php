<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$liste_participants = dbGetListeAllParticipantsAndUsers();

$array_participants = array();
while($array=mysql_fetch_array($liste_participants))
{	
	//$array['nom'] = utf8_encode($array['nom']);					
	$array_participants[] = $array;
}	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_participants)).");";

?>