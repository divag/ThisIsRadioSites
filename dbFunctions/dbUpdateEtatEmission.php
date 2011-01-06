<?php

include('dbFunctions.php');

dbUpdateEtatEmission($_POST["id"], $_POST["etat"]);

?>