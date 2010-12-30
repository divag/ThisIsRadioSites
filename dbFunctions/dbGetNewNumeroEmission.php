<?php

include('dbFunctions.php');

$maxNumber = dbGetMaxNumberEmission();

echo $_POST["variable"]." = ".($maxNumber + 1).";";

?>