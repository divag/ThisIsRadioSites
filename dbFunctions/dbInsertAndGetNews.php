<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$news = dbInsertAndGetNews($_POST["id_site"], $_POST["titre"], $_POST["id_utilisateur"]);

if ($news == 0)
	echo $_POST["variable"]." = 0;";
else
	echo $_POST["variable"]." = eval(".utf8_encode(json_encode($news)).");";

?>