<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbInsertMorceau($_POST["id"], $_POST["nom"], $_POST["time_min"], $_POST["time_sec"], $_POST["nom_artiste"], $_POST["nom_morceau"]);

?>