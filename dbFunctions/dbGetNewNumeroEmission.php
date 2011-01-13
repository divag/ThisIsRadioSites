<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$maxNumber = dbGetMaxNumberEmission($_POST["id_site"]);

echo $_POST["variable"]." = ".($maxNumber + 1).";";

?>