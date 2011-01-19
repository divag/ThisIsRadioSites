<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbDeleteGoodiesEmission($_POST["id_emission"], $_POST["id_contenu"]);

?>