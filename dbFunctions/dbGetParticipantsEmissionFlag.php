<?php

include('dbFunctions.php');

if (listeParticipantsEmission($_POST["id"]) == '')
	echo $_POST["variable"]." = false;";
else
	echo $_POST["variable"]." = true;";


?>