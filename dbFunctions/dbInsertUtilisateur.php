<?php

include('../dbFunctions/dbFunctions.php');

dbInsertUtilisateur($_POST["nom"], $_POST["login_forum"], $_POST["url_site"], $_POST["mail"], $_POST["password"]);

?>