<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$array_pages_site = getListePagesSite();
echo $_POST["variable"]." = eval(".utf8_encode(json_encode($array_pages_site)).");";

?>