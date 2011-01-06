<?php

include('dbFunctions.php');

$emission = dbGetEmissionByNumero($_POST["id_site"], $_POST["numero"]);

if ($emission == 0)
	echo $_POST["variable"]." = 0;";
else
{
	//$emission['titre'] = utf8_encode($emission['titre']);
	$emission['time_min'] = toTime($emission['time_min']);
	$emission['time_sec'] = toTime($emission['time_sec']);
	
	if ($emission['date_sortie'] == "0000-00-00 00:00:00")
		$emission['date_sortie'] = "??/??/????";
	else
		$emission['date_sortie'] = date('d/m/Y', strtotime($emission['date_sortie']));
	
	echo $_POST["variable"]." = eval(".utf8_encode(json_encode($emission)).");";
}	

?>