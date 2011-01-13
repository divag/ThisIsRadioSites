<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbUpdateNomParticipant($_POST["nom"], $_POST["newvalue"]);

?>