<?php

include('dbFunctions.php');

$maxNumber = dbGetMaxNumberEmission($_POST["id_site"]);

echo $_POST["variable"]." = ".($maxNumber + 1).";";

?>