<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbUpdateUtilisateur($_POST["nomWhere"], $_POST["nom"], $_POST["login_forum"], $_POST["url_site"], $_POST["mail"], $_POST["password"]);

?>