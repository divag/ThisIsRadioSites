<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

if (getImageEmissionGifFlag($_POST["numero"]))
	echo $_POST["variable"]." = true;";
else
	echo $_POST["variable"]." = false;";

?>