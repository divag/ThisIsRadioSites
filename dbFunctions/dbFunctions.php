<?php

include('templateFunctions.php');

/*
CONTENU :
=========
*/

//Récupération d un contenu :
function dbGetContenu($id_contenu){

    include('var.php');

    $query = "SELECT id, id_type_contenu, url, contenu_fr, contenu_en, contenu_txt_fr, contenu_txt_en FROM CONTENU WHERE id = ".$id_contenu.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Enregistrement d'un contenu :
function dbInsertContenu($id_type_contenu, $url, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en){

    include('var.php');

    $query = "INSERT INTO CONTENU (id_type_contenu, url, contenu_fr, contenu_en, contenu_txt_fr, contenu_txt_en) VALUES (".$id_type_contenu.", '".urldecode($url)."', '".urldecode($contenu_fr)."', '".urldecode($contenu_en)."', '".urldecode($contenu_txt_fr)."', '".urldecode($contenu_txt_en)."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	$new_id = mysql_insert_id();
    mysql_close($link);
	
	return $new_id;
}

function dbInsertContenuTexte($contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en){
	return dbInsertContenu(1, '', $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en);
}

function dbInsertContenuLien($url){
	return dbInsertContenu(2, $url, '', '', '', '');
}

function dbInsertContenuImage($url_relative){
	return dbInsertContenu(3, $url_relative, '', '', '', '');
}

function dbInsertContenuMp3($url_relative){
	return dbInsertContenu(4, $url_relative, '', '', '', '');
}

function dbInsertContenuFlash($url_relative){
	return dbInsertContenu(5, $url_relative, '', '', '', '');
}

function dbInsertContenuLienYoutube($url){
	return dbInsertContenu(6, $url, '', '', '', '');
}

//Enregistrement d'un contenu :
function dbUpdateContenu($id, $id_type_contenu, $url, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en){

    include('var.php');

    $query = "UPDATE CONTENU set id_type_contenu = ".$id_type_contenu.", url = '".urldecode($url)."', contenu_fr = '".urldecode($contenu_fr)."', contenu_en = '".urldecode($contenu_en)."', contenu_txt_fr = '".urldecode($contenu_txt_fr)."', contenu_txt_en = '".urldecode($contenu_txt_en)."' WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbUpdateContenuTexte($id, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en){
	return dbUpdateContenu($id, 1, '', $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en);
}

function dbUpdateContenuLien($id, $url){
	return dbUpdateContenu($id, 2, $url, '', '', '', '');
}

function dbUpdateContenuImage($id, $url_relative){
	return dbUpdateContenu($id, 3, $url_relative, '', '', '', '');
}

function dbUpdateContenuMp3($id, $url_relative){
	return dbUpdateContenu($id, 4, $url_relative, '', '', '', '');
}

function dbUpdateContenuFlash($id, $url_relative){
	return dbUpdateContenu($id, 5, $url_relative, '', '', '', '');
}

function dbUpdateContenuLienYoutube($id, $url){
	return dbUpdateContenu($id, 6, $url, '', '', '', '');
}

//Suppression d'un contenu :
function dbDeleteContenu($id){

    include('var.php');

    $query = "DELETE FROM CONTENU WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

/*
TYPE_CONTENU :
==============
*/

function dbListeAllTypeContenu(){

    include('var.php');

    $query = "SELECT id, libelle FROM TYPE_CONTENU ORDER BY id ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

function dbGetLibelleTypeContenu($id_type_contenu){

    include('var.php');

	$query = "SELECT libelle FROM TYPE_CONTENU WHERE id = ".$id_type_contenu.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
		return $row['libelle'];
	else
		return '?!?';
}

/*
PAGES (fichiers .php à la racine du site, sans "siteparts.php" et "sitevars.php") :
===================================================================================
*/

function getListePagesSite()
{
	$array_pages = array();
	$dir = opendir("../");
	while ($File = readdir($dir))
	{
		if($File != "." && $File != ".." && strpos($File,".php")
		&& $File != "sitevars.php" 
		&& $File != "siteparts.php")
		{
			$array_pages[] = str_replace(".php", "", $File);
		}
	}
	closedir($dir);
	//sort($array_pages);
	sort($array_pages);
	return $array_pages;
}

/*
CONTENU_PAGE_SITE :
===================
*/

//Récupération d'un contenu d'une page d'un site :
function dbGetContenuPageSiteById($id){

    include('var.php');

    $query = "SELECT CONTENU_PAGE_SITE.id, CONTENU_PAGE_SITE.id_site, CONTENU_PAGE_SITE.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, CONTENU_PAGE_SITE.page, CONTENU_PAGE_SITE.zone FROM CONTENU_PAGE_SITE, CONTENU WHERE CONTENU_PAGE_SITE.id_contenu = CONTENU.id AND CONTENU_PAGE_SITE.id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Récupération d'un contenu d'une page d'un site :
function dbGetContenuPageSite($id_site, $page, $zone){

    include('var.php');

    $query = "SELECT CONTENU_PAGE_SITE.id, CONTENU_PAGE_SITE.id_site, CONTENU_PAGE_SITE.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, CONTENU_PAGE_SITE.page, CONTENU_PAGE_SITE.zone FROM CONTENU_PAGE_SITE, CONTENU WHERE CONTENU_PAGE_SITE.id_contenu = CONTENU.id AND CONTENU_PAGE_SITE.id_site = ".$id_site." AND CONTENU_PAGE_SITE.page = '".urldecode($page)."' AND CONTENU_PAGE_SITE.zone = '".urldecode($zone)."' ORDER BY CONTENU_PAGE_SITE.zone ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Récupération de la liste des contenu d'un page d'une emission :
function dbGetListeContenuPageSite($id_site, $page){

    include('var.php');

    $query = "SELECT CONTENU_PAGE_SITE.id, CONTENU_PAGE_SITE.id_site, CONTENU_PAGE_SITE.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, CONTENU_PAGE_SITE.page, CONTENU_PAGE_SITE.zone, TYPE_CONTENU.libelle FROM CONTENU_PAGE_SITE, CONTENU, TYPE_CONTENU WHERE CONTENU_PAGE_SITE.id_contenu = CONTENU.id AND CONTENU_PAGE_SITE.id_site = ".$id_site." AND CONTENU_PAGE_SITE.page = '".urldecode($page)."' AND CONTENU.id_type_contenu = TYPE_CONTENU.id ORDER BY CONTENU_PAGE_SITE.zone ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Enregistrement d'un contenu d'un page pour une émission :
function dbInsertContenuPageSite($id_site, $page, $zone){
//function dbInsertContenuPageSite($id_site, $page, $zone, $id_type_contenu, $url, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en){

    include('var.php');

	//Enregistrement du contenu : 
    $id_contenu = dbInsertContenu(0, '', '', '', '', '');

	//Enregistrement de la newsletter :
    $query = "INSERT INTO CONTENU_PAGE_SITE (id_site, id_contenu, page, zone) VALUES (".$id_site.", ".$id_contenu.", '".urldecode($page)."', '".urldecode($zone)."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Enregistrement d'un contenu d'un page pour une émission :
function dbUpdateContenuPageSite($id, $page, $zone){

    include('var.php');

    $query = "UPDATE CONTENU_PAGE_SITE set page = '".urldecode($page)."', zone = '".urldecode($zone)."' WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeleteContenuPageSite($id)
{
    include('var.php');
	$contenuPageSite = dbGetContenuPageSiteById($id);
	dbDeleteContenu($contenuPageSite['id_contenu']);

	$query = "DELETE FROM CONTENU_PAGE_SITE WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

/*
GOODIES_EMISSION :
==================
*/

//Récupération de la liste des goodies d'une emission :
function dbGetListeGoodiesEmission($id_emission){

    include('var.php');

    $query = "SELECT GOODIES_EMISSION.id_emission, GOODIES_EMISSION.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, GOODIES_EMISSION.ordre, TYPE_CONTENU.libelle FROM GOODIES_EMISSION, CONTENU, TYPE_CONTENU WHERE GOODIES_EMISSION.id_contenu = CONTENU.id AND GOODIES_EMISSION.id_emission = ".$id_emission." AND CONTENU.id_type_contenu = TYPE_CONTENU.id ORDER BY GOODIES_EMISSION.ordre ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Récupération de la liste des goodies d'une emission :
function dbGetGoodiesEmission($id_emission, $id_contenu){

    include('var.php');

    $query = "SELECT GOODIES_EMISSION.id_emission, GOODIES_EMISSION.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, GOODIES_EMISSION.ordre, TYPE_CONTENU.libelle FROM GOODIES_EMISSION, CONTENU, TYPE_CONTENU WHERE GOODIES_EMISSION.id_contenu = CONTENU.id AND GOODIES_EMISSION.id_emission = ".$id_emission." AND GOODIES_EMISSION.id_contenu = ".$id_contenu." AND CONTENU.id_type_contenu = TYPE_CONTENU.id;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Enregistrement d'un goodies pour une émission :
function dbInsertGoodiesEmission($id_emission, $id_type_contenu, $url, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en){

    include('var.php');

	//Enregistrement du contenu : 
    $id_contenu = dbInsertContenu($id_type_contenu, $url, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en);

	//Enregistrement de la newsletter :
    $query = "INSERT INTO GOODIES_EMISSION (id_emission, id_contenu, ordre) VALUES (".$id_emission.", ".$id_contenu.", 0);";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbInsertAndGetGoodiesEmission($id_emission)
{
    include('var.php');

	//Enregistrement du contenu : 
    $id_contenu = dbInsertContenu(6, '', '', '', '', '');

	//Enregistrement de la newsletter :
    $query = "INSERT INTO GOODIES_EMISSION (id_emission, id_contenu, ordre) VALUES (".$id_emission.", ".$id_contenu.", 0);";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);	

	return dbGetGoodiesEmission($id_emission, $id_contenu);
}

function dbUpdateOrdreGoodiesEmission($id_emission, $id_contenu, $ordre)
{

    include('var.php');

	$query = "UPDATE GOODIES_EMISSION SET ordre = ".$ordre." WHERE id_emission = ".$id_emission." AND  id_contenu = ".$id_contenu.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

function dbDeleteGoodiesEmission($id_emission, $id_contenu)
{
    include('var.php');
	
	dbDeleteContenu($id_contenu);

	$query = "DELETE FROM GOODIES_EMISSION WHERE id_emission = ".$id_emission." AND id_contenu = ".$id_contenu.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

/*
NEWS :
======
*/

//Récupération d'une news :
function dbGetNews($id){

    include('var.php');

    $query = "SELECT NEWS.id, NEWS.id_site, NEWS.titre, NEWS.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, NEWS.id_utilisateur, NEWS.date FROM NEWS, CONTENU WHERE NEWS.id_contenu = CONTENU.id AND NEWS.id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Récupération de la dernière news d'un site :
function dbGetLastNews($id_site){

    include('var.php');

    $query = "SELECT NEWS.id, NEWS.id_site, NEWS.titre, NEWS.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, NEWS.id_utilisateur, NEWS.date FROM NEWS, CONTENU WHERE NEWS.id_contenu = CONTENU.id AND NEWS.id_site = ".$id_site." ORDER BY date DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Récupération de la liste des news d'un site :
function dbGetListeNews($id_site){

    include('var.php');

    $query  = "(SELECT \"A\" AS ordreUnion, NEWS.id, NEWS.id_site, NEWS.titre, NEWS.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, NEWS.id_utilisateur, NEWS.date FROM NEWS, CONTENU WHERE NEWS.date = '0000-00-00 00:00:00' AND NEWS.id_contenu = CONTENU.id AND NEWS.id_site = ".$id_site.") ";
    $query .= "UNION ";
    $query .= "(SELECT \"B\" AS ordreUnion, NEWS.id, NEWS.id_site, NEWS.titre, NEWS.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, NEWS.id_utilisateur, NEWS.date FROM NEWS, CONTENU WHERE NEWS.date != '0000-00-00 00:00:00' AND NEWS.id_contenu = CONTENU.id AND NEWS.id_site = ".$id_site.") ";
    $query .= "ORDER BY ordreUnion, date DESC , id DESC;";
    //$query = "SELECT NEWS.id, NEWS.id_site, NEWS.titre, NEWS.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, NEWS.id_utilisateur, NEWS.date FROM NEWS, CONTENU WHERE NEWS.id_contenu = CONTENU.id AND NEWS.id_site = ".$id_site." ORDER BY NEWS.date ASC, NEWS.id DESC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Récupération de la liste des news publiées d'un site :
function dbGetListeNewsActives($id_site){

    include('var.php');

    $query = "SELECT NEWS.id, NEWS.id_site, NEWS.titre, NEWS.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, NEWS.id_utilisateur, NEWS.date FROM NEWS, CONTENU WHERE NEWS.date <> '0000-00-00 00:00:00' NEWS.id_contenu = CONTENU.id AND NEWS.id_site = ".$id_site." ORDER BY date DESC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Enregistrement d'une news pour un site :
function dbInsertNews($id_site, $titre, $id_utilisateur, $id_type_contenu, $url, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en){

    include('var.php');

	//Enregistrement du contenu : 
    $id_contenu = dbInsertContenu($id_type_contenu, $url, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en);

	//Enregistrement de la news :
    $query = "INSERT INTO NEWS (id_site, titre, id_contenu, id_utilisateur, date) VALUES (".$id_site.", '".urldecode($titre)."', ".$id_contenu.", ".$id_utilisateur.", '0000-00-00 00:00:00');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbInsertAndGetNews($id_site, $titre, $id_utilisateur)
{
    include('var.php');

	//Enregistrement du contenu : 
    $id_contenu = dbInsertContenu(1, '', '', '', '', '');

	//Enregistrement de la newsletter :
    $query = "INSERT INTO NEWS (id_site, titre, id_contenu, id_utilisateur, date) VALUES (".$id_site.", '".urldecode($titre)."', ".$id_contenu.", ".$id_utilisateur.", '0000-00-00 00:00:00');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	$new_id = mysql_insert_id();
    mysql_close($link);

	return dbGetNews($new_id);
}

function dbPublishNews($id)
{
    include('var.php');

    $query = "UPDATE NEWS set date = '".date("Y-m-d H:i:s")."' WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Enregistrement d'un contenu d'un page pour une émission :
function dbUpdateTitreNews($id, $titre){

    include('var.php');

    $query = "UPDATE NEWS set titre = '".urldecode($titre)."' WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Enregistrement d'un contenu d'un page pour une émission :
function dbUpdateNews($id, $id_site, $titre, $id_contenu, $id_utilisateur, $date){

    include('var.php');

    $query = "UPDATE NEWS set id_site = ".$id_site.", titre = '".urldecode($titre)."', id_contenu = ".$id_contenu.", id_utilisateur = ".$id_utilisateur.", date = '".urldecode($date)."' WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeleteNews($id)
{
    include('var.php');
	$News = dbGetNews($id);
	dbDeleteContenu($News['id_contenu']);

	$query = "DELETE FROM NEWS WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

/*
BONUS :
=======
*/

//Récupération d'une bonus :
function dbGetBonus($id){

    include('var.php');

    $query = "SELECT BONUS.id, BONUS.id_site, BONUS.titre, BONUS.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, BONUS.id_utilisateur, BONUS.date FROM BONUS, CONTENU WHERE BONUS.id_contenu = CONTENU.id AND BONUS.id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Récupération de la liste des bonus d'un site :
function dbGetListeBonus($id_site){

    include('var.php');

    $query = "SELECT BONUS.id, BONUS.id_site, BONUS.titre, BONUS.id_contenu, CONTENU.id_type_contenu, CONTENU.url, CONTENU.contenu_fr, CONTENU.contenu_en, CONTENU.contenu_txt_fr, CONTENU.contenu_txt_en, BONUS.id_utilisateur, BONUS.date, TYPE_CONTENU.libelle FROM BONUS, CONTENU, TYPE_CONTENU WHERE BONUS.id_contenu = CONTENU.id AND BONUS.id_site = ".$id_site." AND CONTENU.id_type_contenu = TYPE_CONTENU.id ORDER BY date DESC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Enregistrement d'une bonus pour un site :
function dbInsertBonus($id_site, $titre, $id_utilisateur, $date, $id_type_contenu, $url, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en){

    include('var.php');

	//Enregistrement du contenu : 
    $id_contenu = dbInsertContenu($id_type_contenu, $url, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en);

	//Enregistrement de la bonus :
    $query = "INSERT INTO BONUS (id_site, titre, id_contenu, id_utilisateur, zone) VALUES (".$id_site.", '".urldecode($titre)."', ".$id_contenu.", ".$id_utilisateur.", '".date("Y-m-d H:i:s")."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Enregistrement d'un contenu d'un page pour une émission :
function dbUpdateBonus($id, $id_site, $titre, $id_contenu, $id_utilisateur, $date){

    include('var.php');

    $query = "UPDATE BONUS set id_site = ".$id_site.", titre = '".urldecode($titre)."', id_contenu = ".$id_contenu.", id_utilisateur = ".$id_utilisateur.", date = '".urldecode($date)."' WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeleteBonus($id)
{
    include('var.php');
	$Bonus = dbGetBonus($id);
	dbDeleteContenu($Bonus['id_contenu']);

	$query = "DELETE FROM BONUS WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

/*
ARTISTES :
==========
*/

//Récupération de la liste des artistes :
function dbGetListeArtiste(){

    include('var.php');

    $query = "SELECT nom, url FROM ARTISTE ORDER BY nom ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Enregistrement d'un artiste :
function dbInsertArtiste($nom, $url){

    include('var.php');

	//Enregistrement du mail :
    $query = "INSERT INTO ARTISTE (nom, url) VALUES ('".urldecode($nom)."', '".urldecode($url)."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Mise à jour de l'url d'un artiste :
function dbUpdateArtiste($nom, $url){

    include('var.php');

	//Update du mail :
    $query = "UPDATE ARTISTE set url = '".urldecode($url)."' WHERE nom = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

/*
LABELS :
========
*/

//Récupération de la liste des labels :
function dbGetListeLabel(){

    include('var.php');

    $query = "SELECT nom, url FROM LABEL ORDER BY nom ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Enregistrement d'un label :
function dbInsertLabel($nom, $url){

    include('var.php');

	//Enregistrement du mail :
    $query = "INSERT INTO LABEL (nom, url) VALUES ('".urldecode($nom)."', '".urldecode($url)."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Mise à jour de l'url d'un label :
function dbUpdateLabel($nom, $url){

    include('var.php');

	//Update du mail :
    $query = "UPDATE LABEL set url = '".urldecode($url)."' WHERE nom = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

/*
MAILING_LIST :
==============
*/

//Récupération de la liste des inscriptions a la mailinglist d'un site :
function dbGetListeMailingList($id_site){

    include('var.php');

    $query = "SELECT mail, id_site, est_annule FROM MAILING_LIST WHERE id_site = ".$id_site." ORDER BY mail ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Récupération de la liste des inscriptions actives a la mailinglist d'un site :
function dbGetListeMailingListActive($id_site){

    include('var.php');

    $query = "SELECT mail, id_site, est_annule FROM MAILING_LIST WHERE id_site = ".$id_site." AND est_annule = 0 ORDER BY mail ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Récupération de la liste des inscriptions actives a la mailinglist d'un site :
function dbCancelMailingList($id_site, $mail){

    include('var.php');

    $query = "UPDATE MAILING_LIST set est_annule = 1 WHERE id_site = ".$id_site." AND mail = '".urldecode($mail)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Enregistrement d'une newsletter :
function dbInsertMailingList($mail, $id_site){

    include('var.php');

	//Enregistrement du mail :
    $query = "INSERT INTO MAILING_LIST (mail, id_site, est_annule) VALUES ('".urldecode($mail)."', ".$id_site.", 0);";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Enregistrement d'une newsletter :
function dbUpdateMailingList($old_mail, $new_mail){

    include('var.php');

	//Update du mail :
    $query = "UPDATE MAILING_LIST set mail = '".urldecode($new_mail)."' WHERE mail = '".urldecode($old_mail)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

/*
NEWSLETTER :
============
*/

//Récupération de la liste des newsletter d'un site :
function dbGetListeNewsletter($id_site){

    include('var.php');

    $query = "SELECT id, id_site, destinataires, titre, contenu_fr, contenu_en, contenu_txt_fr, contenu_txt_en, date_envoi FROM NEWSLETTER, CONTENU WHERE NEWSLETTER.id_contenu = CONTENU.id AND NEWSLETTER.id_site = ".$id_site." ORDER BY date_envoi DESC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Récupération de la derniere newsletter d'un site :
function dbGetLastNewsletter($id_site){

    include('var.php');

    $query = "SELECT id, id_site, destinataires, titre, contenu_fr, contenu_en, contenu_txt_fr, contenu_txt_en, date_envoi FROM NEWSLETTER, CONTENU WHERE NEWSLETTER.id_contenu = CONTENU.id AND NEWSLETTER.id_site = ".$id_site." ORDER BY date_envoi DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Récupération d une newsletter :
function dbGetNewsletter($id){

    include('var.php');

    $query = "SELECT id, id_site, destinataires, titre, contenu_fr, contenu_en, contenu_txt_fr, contenu_txt_en, date_envoi FROM NEWSLETTER, CONTENU WHERE NEWSLETTER.id_contenu = CONTENU.id AND NEWSLETTER.id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Enregistrement d'une newsletter :
function dbInsertNewsletter($id_site, $destinataires, $titre, $contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en){

    include('var.php');

	//Enregistrement du contenu : 
    $id_contenu = dbInsertContenuTexte($contenu_fr, $contenu_en, $contenu_txt_fr, $contenu_txt_en);

	//Enregistrement de la newsletter :
    $query = "INSERT INTO NEWSLETTER (id_site, destinataires, titre, id_contenu, date_envoi) VALUES (".$id_site.", '".urldecode($destinataires)."', '".urldecode($titre)."', ".$id_contenu.", '".date("Y-m-d H:i:s")."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

/*
SITE :
======
*/

//Récupération de la liste de tous les sites :
function dbGetListeSites(){

    include('var.php');

    $query = "SELECT id, nom, url, accroche_fr, accroche_en, est_actif FROM SITE ORDER BY ID ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Récupération des informations d'un site :
function dbGetSite($id){

    include('var.php');

    $query = "SELECT id, nom, url, accroche_fr, accroche_en, est_actif FROM SITE WHERE id=".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Mise à jour des informations d'un site :
function dbUpdateSite($id, $nom, $url, $accroche_fr, $accroche_en, $est_actif){

    include('var.php');

    $query = "UPDATE SITE set nom = '".urldecode($nom)."', url = '".urldecode($url)."', accroche_fr = '".urldecode($accroche_fr)."', accroche_en = '".urldecode($accroche_en)."', est_actif = ".$est_actif." WHERE id=".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Mise à jour des informations d'un site :
function dbUpdateStatutSite($id, $est_actif){

    include('var.php');

    $query = "UPDATE SITE set est_actif = ".$est_actif." WHERE id=".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

/*
ADMINISTRATEURS :
=================
*/

//Récupération de la liste des sites d'un administrateur :
function dbGetListeSitesAdministrateur($id_utilisateur){

    include('var.php');

    $query = "SELECT id, nom, url, accroche_fr, accroche_en, est_actif FROM SITE, ADMINISTRATEUR WHERE SITE.id = ADMINISTRATEUR.id_site AND ADMINISTRATEUR.id_utilisateur = ".$id_utilisateur.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Récupération de la liste des administrateurs d'un site :
function dbGetListeAdministrateursSite($id_site){

    include('var.php');

    $query = "SELECT UTILISATEUR.id, UTILISATEUR.nom FROM UTILISATEUR, ADMINISTRATEUR WHERE UTILISATEUR.id = ADMINISTRATEUR.id_utilisateur AND ADMINISTRATEUR.id_site = ".$id_site.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//Récupération de la liste des administrateurs d'un site :
function dbDeleteAllAdministrateursSite($id_site){

    include('var.php');

    $query = "DELETE FROM ADMINISTRATEUR WHERE id_site = ".$id_site.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

//Récupération de la liste des administrateurs d'un site :
function dbAddAdministrateurSite($id_site, $id_utilisateur){

    include('var.php');

    $query = "INSERT INTO ADMINISTRATEUR (id_site, id_utilisateur) VALUES (".$id_site.", ".$id_utilisateur.");";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbCheckAdministrateur($id_site, $id_utilisateur){

    include('var.php');

    $query = "SELECT id_site, id_utilisateur FROM ADMINISTRATEUR WHERE id_site = ".$id_site." AND id_utilisateur = ".$id_utilisateur.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
		return true;
	else	
		return false;
}

/*
PARAMETRES APPLICATION :
========================
*/

function dbCheckSuperAdministrateur($id_utilisateur){

    include('var.php');

    $query = "SELECT id_super_administrateur FROM PARAMETRES_APPLICATION;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
		if ($row[0] == $id_utilisateur)
			return true;
			
	return false;
}

/*
PARAMETRES SITE :
=================
*/

function dbGetParametresSite($id_site) {

    include('var.php');
	
	$query = "SELECT id_site, mail_admin, have_titre, have_texte, have_participants, id_default_participant, have_image_jpg, have_image_jpg_toprint, have_image_gif, have_teaser_mp3, have_teaser_video, have_goodies, have_bonus, have_news, have_newsletter, have_zip, have_contenu_pages, have_statut_announced, template_reference_emission, template_nommage_fichiers_emission, template_nommage_morceaux_emission FROM PARAMETRES_SITE WHERE id_site = ".$id_site.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

function dbUpdateParametresSite($id_site, $mail_admin, $have_titre, $have_texte, $have_participants, $id_default_participant, $have_image_jpg, $have_image_jpg_toprint, $have_image_gif, $have_teaser_mp3, $have_teaser_video, $have_goodies, $have_bonus, $have_news, $have_newsletter, $have_zip, $have_contenu_pages, $have_statut_announced, $template_reference_emission, $template_nommage_fichiers_emission, $template_nommage_morceaux_emission) {

    include('var.php');
	$query = "INSERT INTO PARAMETRES_SITE (id_site, mail_admin, have_titre, have_texte, have_participants, id_default_participant, have_image_jpg, have_image_jpg_toprint, have_image_gif, have_teaser_mp3, have_teaser_video, have_goodies, have_bonus, have_news, have_newsletter, have_zip, have_contenu_pages, have_statut_announced, template_reference_emission, template_nommage_fichiers_emission, template_nommage_morceaux_emission) VALUES (".$id_site.", '".urldecode($mail_admin)."', ".$have_titre.", ".$have_texte.", ".$have_participants.", ".$id_default_participant.", ".$have_image_jpg.", ".$have_image_jpg_toprint.", ".$have_image_gif.", ".$have_teaser_mp3.", ".$have_teaser_video.", ".$have_goodies.", ".$have_bonus.", ".$have_news.", ".$have_newsletter.", ".$have_zip.", ".$have_contenu_pages.", ".$have_statut_announced.", '".urldecode($template_reference_emission)."' , '".urldecode($template_nommage_fichiers_emission)."' , '".urldecode($template_nommage_morceaux_emission)."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
}


/* 
INDEX :
=======
*/

//R�cup�ration de la derni�re �mission
function dbGetLastEmission($id_site){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION WHERE id_site = ".$id_site." AND etat=3 ORDER BY date_sortie DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	$row=mysql_fetch_array($res);
	return $row;
}

function dbListeEmissionsForFeed($id_site){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION WHERE id_site=".$id_site." AND etat=3 ORDER BY date_sortie DESC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

function dbGetMaxNumberEmission($id_site){

    include('var.php');

	$query = "SELECT numero FROM EMISSION WHERE id_site = ".$id_site." ORDER BY numero DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	$row=mysql_fetch_array($res);
	return $row['numero'];
}

//R�cup�ration de la liste de tous participants des �missions actives :
function dbGetNomsParticipantsActifs($id_site){

    include('var.php');

	$query = "SELECT DISTINCT login_forum FROM UTILISATEUR, PARTICIPANT, EMISSION WHERE UTILISATEUR.nom = PARTICIPANT.nom_utilisateur AND PARTICIPANT.id_emission = EMISSION.id AND EMISSION.id_site = ".$id_site." AND EMISSION.etat = 3;";
    $link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

/*
//Récupération de la liste de tous participants d'une émission :
function dbGetNomsParticipantsEmission($id){

    include('var.php');

	$query = "SELECT DISTINCT nom FROM UTILISATEUR, PARTICIPANT, EMISSION WHERE UTILISATEUR.nom = PARTICIPANT.nom_utilisateur AND PARTICIPANT.id_emission = EMISSION.id AND EMISSION.id = ".$id.";";
    $link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}
*/

//R�cup�ration de la liste de tous participants des �missions actives, en texte (avec leur nom sur le forum si possible) s�par�s par des virgules :
function listeParticipants($id_site)
{
    $listeParticipants = dbGetNomsParticipantsActifs($id_site);
	$separateur = "";
	$liste = "";
    while($array=mysql_fetch_array($listeParticipants))
	{
		$liste = $liste.$separateur.$array['login_forum'];
		$separateur = ", ";
	}
	
	return $liste;
}

/*
//Récupération de la liste de tous participants d'une émissions actives, en texte (avec leur nom sur le forum si possible) séparés par des " & " :
function listeParticipantsEmission($id)
{
    $listeParticipants = dbGetNomsParticipantsEmission($id);
	$separateur = "";
	$liste = "";
    while($array=mysql_fetch_array($listeParticipants))
	{
		$liste = $liste.$separateur.$array['nom'];
		$separateur = " & ";
	}
	
	return $liste;
}
*/

/*
NEWS :
======
*/

function dbGetListeEmissionsComingSoon($id_site){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION WHERE id_site = ".$id_site." AND etat = 2 ORDER BY numero ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

//R�cup�ration de la liste de tous les participants d'une �mission :
function dbGetParticipantsEmission($p_id_emission){

    include('var.php');

    $query = "SELECT id_emission, nom_utilisateur, ordre, est_chef FROM PARTICIPANT WHERE id_emission = ".$p_id_emission." ORDER BY ORDRE ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//R�cup�ration d'un participant :
function dbGetParticipant($p_nom){

    include('var.php');

    $query = "SELECT id_emission, nom_utilisateur, ordre, est_chef FROM PARTICIPANT WHERE nom_utilisateur = '".urldecode($p_nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);

	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

function dbGetChefFlag($p_nom){

    include('var.php');

    $query = "SELECT PARTICIPANT.id_emission FROM PARTICIPANT WHERE PARTICIPANT.est_chef = 1 AND PARTICIPANT.nom_utilisateur = '".urldecode($p_nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);

	if ($row=mysql_fetch_array($res))
	    return true;
    else
	    return false;
}

//R�cup�ration de la liste de tous les participants d'une �mission, en texte s�par�s par des virgules :
function listeParticipantsEmission($p_id_emission)
{
    $listeParticipants = dbGetParticipantsEmission($p_id_emission);
	$separateur = "";
	$liste = "";
    while($array=mysql_fetch_array($listeParticipants))
	{
		$liste = $liste.$separateur.$array['nom_utilisateur'];		   
		$separateur = ", ";
	}
	return $liste;
}

/*
PLAYLISTS :
===========
*/

//R�cup�ration de l'�mission :
function dbGetListeEmissions($id_site){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION WHERE id_site = ".$id_site." AND (etat = 2 OR etat = 3) ORDER BY numero ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

/*
PAGE D'UNE PLAYLIST :
=====================
*/

//R�cup�ration de l'�mission :
function dbGetEmission($p_id){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION WHERE id = ".$p_id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

function dbGetEmissionByNumero($p_id_site, $p_numero){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION WHERE id_site = ".$p_id_site." AND numero = ".$p_numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//R�cup�ration de l'�mission suivante :
function dbGetNextEmission($id_site, $p_numero){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION WHERE id_site = ".$id_site." AND etat = 3 AND numero < ".$p_numero." ORDER BY numero DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	{
		$query = "SELECT id, id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION WHERE id_site = ".$id_site." AND etat = 3 ORDER BY numero DESC LIMIT 0,1;";
		$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
		$select_base=mysql_selectdb($db);
		$res=mysql_db_query ($db, $query);	
		mysql_close($link);	
		$row=mysql_fetch_array($res);
		return $row;	
	}
}

//R�cup�ration de l'�mission pr�c�dente :
function dbGetPrevEmission($id_site, $p_numero){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION WHERE id_site = ".$id_site." AND etat = 3 AND numero < ".$p_numero." ORDER BY numero ASC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//Récupération du nom d'une émission :
function dbGetTitreEmission($id_site, $p_numero){

    include('var.php');

	$query = "SELECT titre FROM EMISSION WHERE id_site = ".$id_site." AND numero = ".$p_numero." LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row['titre'];
    else
	    return '';
}

//R�cup�ration d'un utilisateur :
function dbGetUtilisateur($p_nom_utilisateur){

    include('var.php');

	$query = "SELECT id, nom, login_forum, url_site, mail, password FROM UTILISATEUR WHERE nom = '".urldecode($p_nom_utilisateur)."';";
	$link=mysql_connect($hote,$login,$passwd); 
	mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
		return $row;
	else
		return 0;
}

//R�cup�ration d'un utilisateur :
function dbGetUtilisateurByMail($p_mail_utilisateur){

    include('var.php');

	$query = "SELECT id, nom, login_forum, url_site, mail, password FROM UTILISATEUR WHERE mail = '".urldecode($p_mail_utilisateur)."';";
	$link=mysql_connect($hote,$login,$passwd); 
	mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
		return $row;
	else
		return 0;
}

//Checke le mot de passe d'un utilisateur :
function dbCheckPass($p_nom_utilisateur, $p_password_utilisateur){

    include('var.php');

	$query = "SELECT id, nom, login_forum, url_site, mail, password FROM UTILISATEUR WHERE nom = '".urldecode($p_nom_utilisateur)."' AND password = '".urldecode($p_password_utilisateur)."';";
	$link=mysql_connect($hote,$login,$passwd); 
	mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
		return true;
	else
		return false;
}

//check si l'email exist :
function dbExistsMail($p_mail_utilisateur){

    include('var.php');

	$query = "SELECT mail FROM UTILISATEUR WHERE mail = '".urldecode($p_mail_utilisateur)."';";
	$link=mysql_connect($hote,$login,$passwd); 
	mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
		return true;
	else
		return false;
}
//R�cup�ration d'un utilisateur :
function dbDeleteUtilisateur($p_nom_utilisateur){

    include('var.php');

	$query = "DELETE FROM UTILISATEUR WHERE nom = '".urldecode($p_nom_utilisateur)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

//R�cup�ration de la playlist :
function dbGetPlaylist($p_id_emission){

    include('var.php');

	$query = "SELECT id, id_emission, nom_utilisateur, time_min, time_sec, nom_artiste, nom_morceau, nom_label, annee FROM MORCEAU WHERE id_emission = ".$p_id_emission." ORDER BY time_min, time_sec ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

//R�cup�ration de la playlist :
function dbGetPlaylistParticipant($p_id_emission, $nom_participant){

    include('var.php');

	$query = "SELECT id, id_emission, nom_utilisateur, time_min, time_sec, nom_artiste, nom_morceau, nom_label, annee FROM MORCEAU WHERE id_emission = ".$p_id_emission." AND nom_utilisateur = '".urldecode($nom_participant)."' ORDER BY time_min, time_sec ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

function dbGetMorceauxEmissionFlag($p_id_emission){

    include('var.php');

	$query = "SELECT id FROM MORCEAU WHERE id_emission = ".$p_id_emission.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return ($row=mysql_fetch_array($res));
}

//Formatage d'une dur�e :
function toTime($int)
{
    if (strlen($int) == 1)
	   return "0".$int;
	else
		return $int;
}

/*
================================================================================================= 
===================   A   D   M   I   N   I   S   T   R   A   T   I   O   N   =================== 
================================================================================================= 
*/

/* 
Gestion des �missions :
*/

function dbListeAllEtatEmission(){

    include('var.php');

    $query = "SELECT id, libelle FROM ETAT_EMISSION ORDER BY id ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

function dbGetLibelleEtatEmission($id_etat){

    include('var.php');

	$query = "SELECT libelle FROM ETAT_EMISSION WHERE id = ".$id_etat.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
		return $row['libelle'];
	else
		return '?!?';
}

function dbListeAllEmission($id_site){

    include('var.php');

    $query = "SELECT EMISSION.id, EMISSION.id_site, numero, titre, id_contenu_texte, date_sortie, etat, libelle, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION, ETAT_EMISSION WHERE EMISSION.id_site = ".$id_site." AND EMISSION.etat = ETAT_EMISSION.id ORDER BY numero ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

function dbListeAllEmissionForChef($id_site, $admin){

    include('var.php');

    $query = "SELECT DISTINCT EMISSION.id, EMISSION.id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION, PARTICIPANT WHERE EMISSION.id_site = ".$id_site." AND EMISSION.etat = 2 AND EMISSION.id = PARTICIPANT.id_emission AND PARTICIPANT.est_chef = 1 AND PARTICIPANT.nom_utilisateur = '".urldecode($admin)."' ORDER BY numero ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

function dbListeAllEmissionForChefSansAnnonce($id_site, $admin){

    include('var.php');

    $query = "SELECT DISTINCT EMISSION.id, EMISSION.id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec, teaser_video, url_lien_forum FROM EMISSION, PARTICIPANT WHERE EMISSION.id_site = ".$id_site." AND EMISSION.etat = 1 AND EMISSION.id = PARTICIPANT.id_emission AND PARTICIPANT.est_chef = 1 AND PARTICIPANT.nom_utilisateur = '".urldecode($admin)."' ORDER BY numero ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

function dbDeleteEmission($id){

    include('var.php');

    $query = "DELETE FROM EMISSION WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeletePlaylistParticipant($id, $nom){

    include('var.php');

    $query = "DELETE FROM MORCEAU WHERE id_emission = ".$id." AND nom_utilisateur = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbInsertMorceau($id, $nom, $time_min, $time_sec, $nom_artiste, $nom_morceau, $nom_label, $annee)
{
    include('var.php');
    $query = "INSERT INTO MORCEAU (id_emission, nom_utilisateur, time_min, time_sec, nom_morceau, nom_artiste, nom_label, annee) VALUES (".$id.", '".urldecode($nom)."', ".$time_min.", ".$time_sec.", '".urldecode($nom_morceau)."', '".urldecode($nom_artiste)."', '".urldecode($nom_label)."', '".urldecode($annee)."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeleteCascadeEmission($id){

    include('var.php');

	$emission = dbGetEmission($id);
	$numero = $emission["numero"];
	$titre = $emission["titre"];
	$nomParticipants = listeParticipantsEmission($id);

    $query = "DELETE FROM MORCEAU WHERE id_emission = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);

    $query = "DELETE FROM PARTICIPANT WHERE id_emission = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);

    $query = "DELETE FROM CONTENU WHERE id = ".$emission['id_contenu_texte'].";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
		
    $query = "DELETE FROM EMISSION WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
		
	$referenceEmission = getReferenceEmission($numero, $titre, $nomParticipants);
	$nomFichierEmission = getNomFichierEmission($numero, $titre, $nomParticipants);

	if (file_exists("../".PICS.$nomFichierEmission.".jpg"))
		unlink("../".PICS.$nomFichierEmission.".jpg");
	if (file_exists("../".PICS.$nomFichierEmission.".gif"))
		unlink("../".PICS.$nomFichierEmission.".gif");
	if (file_exists("../".PICS.$nomFichierEmission."-toPrint.jpg"))
		unlink("../".PICS.$nomFichierEmission."-toPrint.jpg");
	if (file_exists("../".MP3S.$nomFichierEmission."-teaser.mp3"))
		unlink("../".MP3S.$nomFichierEmission.$numero."-teaser.mp3");
	if (file_exists("../".MP3S.$nomFichierEmission.".mp3"))
		unlink("../".MP3S.$nomFichierEmission.$numero.".mp3");
}

function dbInsertEmission($id_site, $numero, $titre, $date_sortie, $etat, $time_min, $time_sec){

    include('var.php');

	$site = dbGetParametresSite($id_site);
	
	$id_contenu = 0;
	
	if ($site['have_texte'] != 0)
	{
		//Enregistrement du contenu : 
		$id_contenu = dbInsertContenuTexte('', '', '', '');
	}
	
    $query = "INSERT INTO EMISSION (id_site, numero, titre, id_contenu_texte, date_sortie, etat, time_min, time_sec) VALUES (".$id_site.", ".$numero.", '".urldecode($titre)."', ".$id_contenu.", '".$date_sortie."', ".$etat.", ".$time_min.", ".$time_sec.");";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbUpdateTimeEmission($id, $time_min, $time_sec){

    include('var.php');

    $query = "UPDATE EMISSION SET time_min = ".$time_min.", time_sec = ".$time_sec." WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbUpdateTeaserVideoEmission($id, $teaser_video){

    include('var.php');

    $query = "UPDATE EMISSION SET teaser_video = '".urldecode($teaser_video)."' WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbUpdateEmission($id, $id_site, $numero, $titre, $date_sortie, $etat, $time_min, $time_sec, $url_lien_forum){

    include('var.php');

    $query = "UPDATE EMISSION SET id_site = ".$id_site.", numero = ".$numero.", titre = '".urldecode($titre)."', date_sortie = '".$date_sortie."', etat = ".$etat.", time_min = ".$time_min.", time_sec = ".$time_sec.", url_lien_forum = '".urldecode($url_lien_forum)."' WHERE id = ".$id.";";
    //$query = "UPDATE EMISSION SET titre = '".$titre."', date_sortie = '".$date_sortie."', WHERE numero = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbUpdateEtatEmission($id_emission, $id_etat){

    include('var.php');

	if ($id_etat == '3')
		$query = "UPDATE EMISSION SET etat = ".$id_etat.", date_sortie = '".date("Y-m-d H:i:s")."' WHERE id = ".$id_emission.";";
	else
	    $query = "UPDATE EMISSION SET etat = ".$id_etat." WHERE id = ".$id_emission.";";

	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);

}

function getImageEmissionFlag($numero)
{
	$emission = dbGetEmissionByNumero(ID_SITE, $numero);
	$idEmission = $emission['id'];
	$titre = $emission['titre'];
	$nomParticipants = listeParticipantsEmission($idEmission);

	return file_exists("../".PICS.getNomFichierEmission($numero, $titre, $nomParticipants).".jpg");
}

function getImageEmissionToPrintFlag($numero)
{
	$emission = dbGetEmissionByNumero(ID_SITE, $numero);
	$idEmission = $emission['id'];
	$titre = $emission['titre'];
	$nomParticipants = listeParticipantsEmission($idEmission);

	return file_exists("../".PICS.getNomFichierEmission($numero, $titre, $nomParticipants)."-toPrint.jpg");
}

function getImageEmissionGifFlag($numero)
{
	$emission = dbGetEmissionByNumero(ID_SITE, $numero);
	$idEmission = $emission['id'];
	$titre = $emission['titre'];
	$nomParticipants = listeParticipantsEmission($idEmission);

	return file_exists("../".PICS.getNomFichierEmission($numero, $titre, $nomParticipants).".gif");
}

function getTeaserEmissionFlag($numero)
{
	$emission = dbGetEmissionByNumero(ID_SITE, $numero);
	$idEmission = $emission['id'];
	$titre = $emission['titre'];
	$nomParticipants = listeParticipantsEmission($idEmission);

	return file_exists("../".MP3S.getNomFichierEmission($numero, $titre, $nomParticipants)."-teaser.mp3");
}

function emissionHaveTeaser($numero)
{
	$emission = dbGetEmissionByNumero(ID_SITE, $numero);
	$idEmission = $emission['id'];
	$titre = $emission['titre'];
	$nomParticipants = listeParticipantsEmission($idEmission);

	return file_exists(MP3S.getNomFichierEmission($numero, $titre, $nomParticipants)."-teaser.mp3");
}

require('classAudioFile.php');
function getTimeEmission($numero)
{
	$emission = dbGetEmissionByNumero(ID_SITE, $numero);
	$idEmission = $emission['id'];
	$titre = $emission['titre'];
	$nomParticipants = listeParticipantsEmission($idEmission);
	
	$filePath = "../".MP3S.getNomFichierEmission($numero, $titre, $nomParticipants).".mp3";
	if (file_exists($filePath))
	{
		$AF = new AudioFile;
		$AF->loadFile($filePath);
		$time = date("h:i:s", mktime(0,0,round($AF->wave_length)));
		if (date("h", mktime(0,0,round($AF->wave_length))) <> 12)
			$min = (date("h", mktime(0,0,round($AF->wave_length))) * 60) + date("i", mktime(0,0,round($AF->wave_length)));
		else
			$min = date("i", mktime(0,0,round($AF->wave_length)));

		$sec = date("s", mktime(0,0,round($AF->wave_length)));
		
		return $min.":".$sec;
	}
	else
		return 0;
}

function getBytesLengthEmission($numero)
{
	$emission = dbGetEmissionByNumero(ID_SITE, $numero);
	$idEmission = $emission['id'];
	$titre = $emission['titre'];
	$nomParticipants = listeParticipantsEmission($idEmission);
	
	$filePath = "../".MP3S.getNomFichierEmission($numero, $titre, $nomParticipants).".mp3";
	if (file_exists($filePath))
	{
		return filesize($filePath);
	}
	else
		return 0;
}

function dbGetEmissionCompleteFlag($id)
{
	$emission = dbGetEmission($id);
	$numero = $emission["numero"];
	$titre = $emission['titre'];
	$nomParticipants = listeParticipantsEmission($id);
	
	$nomFichierEmission = getNomFichierEmission($numero, $titre, $nomParticipants);
	
	$filePath = "../".MP3S.$nomFichierEmission.".mp3";
	if (!file_exists($filePath))
		return false;
	
	$filePath = "../".PICS.$nomFichierEmission.".jpg";
	if (!file_exists($filePath))
		return false;
	
	if (listeParticipantsEmission($id) == '')
		return false;
		
	$liste_participants = dbGetListeParticipantsEmission($id);
	while($array=mysql_fetch_array($liste_participants))
	{	
		if (dbGetUtilisateur($array['nom_utilisateur']) == 0)
			return false;
	}	
	
	return true;
}

/**************************/

//R�cup�ration de l'�mission :

function dbGetListeAllParticipantsAndUsers(){

	include('var.php');

	$query = "SELECT DISTINCT allUsers.nom FROM ((SELECT nom FROM UTILISATEUR) UNION (SELECT nom_utilisateur as nom FROM PARTICIPANT)) as allUsers ORDER BY allUsers.nom ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

function dbInsertParticipant($id, $nom, $ordre, $est_chef){

    include('var.php');

    $query = "INSERT INTO PARTICIPANT (id_emission, nom_utilisateur, ordre, est_chef) VALUES (".$id.", '".urldecode($nom)."', ".$ordre.", ".$est_chef.");";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeleteParticipant($id, $nom){

    include('var.php');

	dbDeletePlaylistParticipant($id, $nom);
	
    $query = "DELETE FROM PARTICIPANT WHERE id_emission = ".$id." AND nom_utilisateur = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbGetListeParticipantsEmission($id){

    include('var.php');

	$query = "SELECT nom_utilisateur, ordre, est_chef FROM PARTICIPANT WHERE id_emission = ".$id." ORDER BY ordre ASC;";
	$link=mysql_connect($hote,$login,$passwd); 
	mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

function dbGetChefEmission($id)
{
    include('var.php');

	$query = "SELECT nom_utilisateur FROM PARTICIPANT WHERE est_chef = 1 AND id_emission = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res = mysql_db_query ($db, $query);	
	mysql_close($link);

	if ($row=mysql_fetch_array($res))
		return $row['nom_utilisateur'];
	else
		return '';

}

function dbUpdateChefEmission($id, $nom)
{

    include('var.php');

	$query = "UPDATE PARTICIPANT SET est_chef = 0 WHERE id_emission = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);

	$query = "UPDATE PARTICIPANT SET est_chef = 1 WHERE id_emission = ".$id." AND  nom_utilisateur = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

function dbUpdateOrdreParticipant($id, $nom, $ordre)
{

    include('var.php');

	$query = "UPDATE PARTICIPANT SET ordre = ".$ordre." WHERE id_emission = ".$id." AND  nom_utilisateur = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

function dbUpdateNomParticipant($nom, $newvalue)
{

    include('var.php');

	$query = "UPDATE PARTICIPANT SET nom_utilisateur = '".urldecode($newvalue)."' WHERE nom_utilisateur = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

/*******/

function dbInsertUtilisateur($nom, $login_forum, $url_site, $mail, $password)
{

    include('var.php');

	$query = "INSERT INTO UTILISATEUR (id, nom, login_forum, url_site, mail, password) VALUES (null,'".urldecode($nom)."', '".urldecode($login_forum)."', '".urldecode($url_site)."', '".urldecode($mail)."', '".urldecode($password)."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

function dbUpdateUtilisateur($nomWhere, $nom, $login_forum, $url_site, $mail, $password)
{

    include('var.php');

	$query = "UPDATE UTILISATEUR SET nom = '".urldecode($nom)."', login_forum = '".urldecode($login_forum)."', url_site = '".urldecode($url_site)."', mail = '".urldecode($mail)."', password = '".urldecode($password)."' WHERE nom = '".urldecode($nomWhere)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($nomWhere != $nom)
	{
		dbUpdateNomParticipant($nomWhere, $nom);
	
		$query = "UPDATE MORCEAU SET nom_utilisateur = '".urldecode($nom)."' WHERE nom_utilisateur = '".urldecode($nomWhere)."';";
		$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
		$select_base=mysql_selectdb($db);
		mysql_db_query ($db, $query);	
		mysql_close($link);
	}
}

function dbGetListeAllUtilisateurs()
{
    include('var.php');

	$query = "SELECT nom, login_forum, url_site, mail, password FROM UTILISATEUR ORDER BY nom ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res = mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

?>
