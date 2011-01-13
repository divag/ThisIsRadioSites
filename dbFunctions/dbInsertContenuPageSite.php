<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbInsertContenuPageSite($_POST["id_site"], $_POST["page"], $_POST["zone"]);

?>