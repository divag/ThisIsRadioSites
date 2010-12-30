<?php

include('dbFunctions.php');

dbUpdateTimeEmission($_POST["numero"], $_POST["time_min"], $_POST["time_sec"]);

?>