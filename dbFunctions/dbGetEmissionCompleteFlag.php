<?php

include('dbFunctions.php');

$emissionComplete = dbGetEmissionCompleteFlag($_POST["numero"]);

if ($emissionComplete)
	echo $_POST["variable"]." = true;";
else
	echo $_POST["variable"]." = false;";

?>