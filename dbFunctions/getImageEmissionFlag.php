<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

if (getImageEmissionFlag($_POST["numero"]))
	echo $_POST["variable"]." = true;";
else
	echo $_POST["variable"]." = false;";

?>