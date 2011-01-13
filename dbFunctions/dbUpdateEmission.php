<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbUpdateEmission($_POST["id"], $_POST["id_site"], $_POST["numero"], $_POST["titre"], $_POST["date_sortie"], $_POST["etat"], $_POST["time_min"], $_POST["time_sec"]);

?>