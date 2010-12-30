<?php

include('dbFunctions.php');

dbInsertParticipant($_POST["numero"], $_POST["nom"], $_POST["ordre"], $_POST["est_chef"]);

?>