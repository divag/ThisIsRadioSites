<?php

include('dbFunctions.php');

$emissionComplete = dbGetEmissionCompleteFlag($_POST["id"]);

if ($emissionComplete)
	echo $_POST["variable"]." = true;";
else
	echo $_POST["variable"]." = false;";

?>