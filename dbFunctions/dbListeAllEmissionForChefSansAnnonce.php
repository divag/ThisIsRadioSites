<?php

include('dbFunctions.php');

$liste_emissions = dbListeAllEmissionForChefSansAnnonce($_POST["id_site"], $_POST["admin"]);

$array_emissions = array();
while($array=mysql_fetch_array($liste_emissions))
{
	$array['titre'] = $array['titre'];
	$array['time_min'] = toTime($array['time_min']);
	$array['time_sec'] = toTime($array['time_sec']);
	
	if ($array['date_sortie'] == "0000-00-00 00:00:00")
		$array['date_sortie'] = "??/??/????";
	else
		$array['date_sortie'] = date('d/m/Y', strtotime($array['date_sortie']));
		
	$array_emissions[] = $array;
}	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_emissions)).");";

?>