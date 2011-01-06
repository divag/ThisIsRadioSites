<?php

include('dbFunctions.php');

dbUpdateTimeEmission($_POST["id"], $_POST["time_min"], $_POST["time_sec"]);

?>