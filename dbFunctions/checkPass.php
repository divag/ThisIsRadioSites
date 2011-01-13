<?php

include('../dbFunctions/dbFunctions.php');

if (dbCheckPass($_POST["login"], $_POST["pass"]))
	echo $_POST["variable"]." = true;";
else
	echo $_POST["variable"]." = false;";
	
?>