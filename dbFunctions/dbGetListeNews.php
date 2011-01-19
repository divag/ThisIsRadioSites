<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$liste_contenus = dbGetListeNews($_POST["id_site"]);

$array_contenus = array();
while($array=mysql_fetch_array($liste_contenus))
{	
	if ($array['date'] != "0000-00-00 00:00:00")
		$array['date'] = date('d/m/Y H:i:s', strtotime($array['date']));
	$array_contenus[] = $array;
}	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_contenus)).");";

?>