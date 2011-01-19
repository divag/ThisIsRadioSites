<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$goodies = dbInsertAndGetGoodiesEmission($_POST["id_emission"]);

if ($goodies == 0)
	echo $_POST["variable"]." = 0;";
else
	echo $_POST["variable"]." = eval(".utf8_encode(json_encode($goodies)).");";

?>