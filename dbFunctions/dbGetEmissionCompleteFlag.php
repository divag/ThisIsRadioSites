<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$emissionComplete = dbGetEmissionCompleteFlag($_POST["id"]);

if ($emissionComplete)
	echo $_POST["variable"]." = true;";
else
	echo $_POST["variable"]." = false;";

?>