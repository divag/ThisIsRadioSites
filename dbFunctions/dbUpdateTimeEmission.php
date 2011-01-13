<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbUpdateTimeEmission($_POST["id"], $_POST["time_min"], $_POST["time_sec"]);

?>