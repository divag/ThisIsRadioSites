<?php

include('dbFunctions.php');

if (dbGetMorceauxEmissionFlag($_POST["numero"]))
	echo $_POST["variable"]." = true;";
else
	echo $_POST["variable"]." = false;";


?>