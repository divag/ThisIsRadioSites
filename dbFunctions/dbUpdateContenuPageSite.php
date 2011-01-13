<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbUpdateContenuPageSite($_POST["id"], $_POST["page"], $_POST["zone"]);

?>