<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbUpdateEtatEmission($_POST["id"], $_POST["etat"]);

?>