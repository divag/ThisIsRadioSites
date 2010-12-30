<?php

include('dbFunctions.php');
$listeParticipants = dbGetListeParticipantsEmission($_POST["numero"]);

$i = 1;
while($array=mysql_fetch_array($listeParticipants))
{	
	$newOrdre = $i;
	if ($i == $_POST["ordre"])
		$newOrdre = $_POST["newvalue"];
	if ($i == $_POST["newvalue"])
		$newOrdre = $_POST["ordre"];
	
	dbUpdateOrdreParticipant($_POST["numero"], $array['nom_utilisateur'], $newOrdre);
	$i++;
}

?>