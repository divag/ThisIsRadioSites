<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$liste_contenus = dbGetListeGoodiesEmission($_POST["id_emission"]);

$array_contenus = array();
while($array=mysql_fetch_array($liste_contenus))
{	
	$array_contenus[] = $array;
}	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_contenus)).");";

?>