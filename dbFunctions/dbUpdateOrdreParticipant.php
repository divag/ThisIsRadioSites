<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');
$listeParticipants = dbGetListeParticipantsEmission($_POST["id"]);

$i = 1;
while($array=mysql_fetch_array($listeParticipants))
{	
	$newOrdre = $i;
	if ($i == $_POST["ordre"])
		$newOrdre = $_POST["newvalue"];
	if ($i == $_POST["newvalue"])
		$newOrdre = $_POST["ordre"];
	
	dbUpdateOrdreParticipant($_POST["id"], $array['nom_utilisateur'], $newOrdre);
	$i++;
}

?>