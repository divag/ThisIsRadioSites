<?php

include('dbFunctions.php');

echo $_POST["variable"]." = '".dbGetLibelleEtatEmission($_POST["etat"])."';";

?>