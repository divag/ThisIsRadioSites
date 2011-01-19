<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');
$listeGoodies = dbGetListeGoodiesEmission($_POST["id_emission"]);

$i = 1;
while($array=mysql_fetch_array($listeGoodies))
{	
	$newOrdre = $i;
	if ($i == $_POST["ordre"])
		$newOrdre = $_POST["newvalue"];
	if ($i == $_POST["newvalue"])
		$newOrdre = $_POST["ordre"];
	
	dbUpdateOrdreGoodiesEmission($_POST["id_emission"], $array['id_contenu'], $newOrdre);
	$i++;
}

?>