<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbDeleteCascadeEmission($_POST["id"]);

?>