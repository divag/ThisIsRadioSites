<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

echo $_POST["variable"]." = '".dbGetLibelleEtatEmission($_POST["etat"])."';";

?>