<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$liste_type_contenu = dbListeAllTypeContenu();

$array_type_contenu = array();
while($array=mysql_fetch_array($liste_type_contenu))
{	
	$array_type_contenu[] = $array;
}	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_type_contenu)).");";

?>