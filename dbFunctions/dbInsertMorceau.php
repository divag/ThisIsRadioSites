<?php

include('dbFunctions.php');

dbInsertMorceau($_POST["numero"], $_POST["nom"], $_POST["time_min"], $_POST["time_sec"], $_POST["nom_artiste"], $_POST["nom_morceau"]);

?>