<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbInsertParticipant($_POST["id"], $_POST["nom"], $_POST["ordre"], $_POST["est_chef"]);

?>