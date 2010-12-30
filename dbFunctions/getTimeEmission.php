<?php

include('dbFunctions.php');

$timeEmission = @getTimeEmission($_POST["numero"]);

if ($timeEmission == 0 && $timeEmission.length == 1)
	echo $_POST["variable"]." = false;";
else
{
	echo $_POST["variable"]." = '".$timeEmission."';";
	echo $_POST["variable"]."_min = '".substr($timeEmission, 0, 2)."';";
	echo $_POST["variable"]."_sec = '".substr($timeEmission, 3, 2)."';";
}
?>