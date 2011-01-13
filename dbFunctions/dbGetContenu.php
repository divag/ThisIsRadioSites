<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$contenu = dbGetContenu($_POST["id"]);

if ($contenu == 0)
	echo $_POST["variable"]." = 0;";
else
	echo $_POST["variable"]." = eval(".utf8_encode(json_encode($contenu)).");";

?>