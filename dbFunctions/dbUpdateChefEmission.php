<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbUpdateChefEmission($_POST["id"], $_POST["nom"]);

?>