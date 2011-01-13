<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

if (listeParticipantsEmission($_POST["id"]) == '')
	echo $_POST["variable"]." = false;";
else
	echo $_POST["variable"]." = true;";


?>