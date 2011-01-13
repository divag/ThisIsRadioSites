<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbUpdateTeaserVideoEmission($_POST["id"], $_POST["teaser_video"]);

?>