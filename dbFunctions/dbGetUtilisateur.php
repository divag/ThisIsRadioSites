<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$array = dbGetUtilisateur($_POST["nom"]);

$array['est_inutile'] = 0;
if (dbGetParticipant(urlencode(addslashes($array['nom']))) == 0)
	$array['est_inutile'] = 1;

$array['est_chef'] = 0;
if (dbGetChefFlag(urlencode(addslashes($array['nom']))))
	$array['est_chef'] = 1;

//$array['nom'] = utf8_encode($array['nom']);					
//$array['login_forum'] = utf8_encode($array['login_forum']);					
//$array['url_site'] = utf8_encode($array['url_site']);					
//$array['mail'] = utf8_encode($array['mail']);					
//$array['password'] = utf8_encode($array['password']);					
	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array)).");";

?>