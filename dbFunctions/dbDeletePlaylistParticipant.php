<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

dbDeletePlaylistParticipant($_POST["id"], $_POST["nom"]);

?>