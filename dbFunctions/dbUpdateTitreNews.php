<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbUpdateTitreNews($_POST["id"], $_POST["titre"]);

?>