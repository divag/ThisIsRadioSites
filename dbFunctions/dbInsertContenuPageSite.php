<?php

include('dbFunctions.php');

dbInsertContenuPageSite($_POST["id_site"], $_POST["page"], $_POST["zone"]);
//dbInsertContenuPageSite($_POST["id_site"], $_POST["page"], $_POST["zone"], $_POST["id_type_contenu"], $_POST["url"], $_POST["contenu_fr"], $_POST["contenu_en"], $_POST["contenu_txt_fr"], $_POST["contenu_txt_en"]);

?>