<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

if (dbGetMorceauxEmissionFlag($_POST["id"]))
	echo $_POST["variable"]." = true;";
else
	echo $_POST["variable"]." = false;";


?>