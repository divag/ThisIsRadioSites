<?php

include('dbFunctions.php');

$liste_morceaux = dbGetPlaylistParticipant($_POST["numero"], $_POST["nom"]);

$array_morceaux = array();
while($array=mysql_fetch_array($liste_morceaux))
{	
	//$array['nom_utilisateur'] = utf8_encode($array['nom_morceau']);					
	//$array['nom_morceau'] = utf8_encode($array['nom_morceau']);					
	//$array['nom_artiste'] = utf8_encode($array['nom_artiste']);					
	$array_morceaux[] = $array;
}	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_morceaux)).");";

?>