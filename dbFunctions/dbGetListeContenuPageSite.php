<?php

include('dbFunctions.php');

$id_site = $_POST["id_site"];
$page = $_POST["page"];
$liste_contenus = dbGetListeContenuPageSite($id_site, $page);

$array_contenus = array();
while($array=mysql_fetch_array($liste_contenus))
{	
	$array_contenus[] = $array;
}	
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_contenus)).");";

?>