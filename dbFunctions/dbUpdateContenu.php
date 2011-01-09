<?php

include('dbFunctions.php');

dbUpdateContenu($_POST["id"], $_POST["id_type_contenu"], $_POST["url"], $_POST["contenu_fr"], $_POST["contenu_en"], $_POST["contenu_txt_fr"], $_POST["contenu_txt_en"]);

?>