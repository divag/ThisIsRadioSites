<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$liste_morceaux = dbGetPlaylistParticipant($_POST["id"], $_POST["nom"]);

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