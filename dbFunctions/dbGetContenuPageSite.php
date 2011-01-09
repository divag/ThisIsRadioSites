<?php

include('dbFunctions.php');

$contenu = dbGetContenuPageSite($_POST["id_site"], $_POST["page"], $_POST["zone"]);

if ($contenu == 0)
	echo $_POST["variable"]." = 0;";
else
	echo $_POST["variable"]." = eval(".utf8_encode(json_encode($contenu)).");";

?>