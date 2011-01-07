<?php

/*
SITES :
=======
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

    $query = "UPDATE SITE set nom = '".$nom."', url = '".$url."', accroche_fr = '".$accroche_fr."', accroche_en = '".$accroche_en."', est_actif = ".$est_actif." WHERE id=".$id.";";
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
function dbDeleteAdministrateursSite($id_site){

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

function dbGetParametresSite($id_site) {

    include('var.php');
	
	$query = "SELECT id_site, mail_admin, have_titre, have_texte, have_participants, id_default_participant, have_image_jpg, have_image_jpg_toprint, have_image_gif, have_teaser_mp3, have_teaser_video, have_goodies, have_zip, have_contenu_pages, have_statut_announced, template_reference_emission, template_nommage_fichiers_emission, template_nommage_morceaux_emission FROM PARAMETRES_SITE WHERE id_site = ".$id_site.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

function dbUpdateParametresSite($id_site, $mail_admin, $have_titre, $have_texte, $have_participants, $id_default_participant, $have_image_jpg, $have_image_jpg_toprint, $have_image_gif, $have_teaser_mp3, $have_teaser_video, $have_goodies, $have_zip, $have_contenu_pages, $have_statut_announced, $template_reference_emission, $template_nommage_fichiers_emission, $template_nommage_morceaux_emission) {

    include('var.php');
	$query = "INSERT INTO PARAMETRES_SITE (id_site, mail_admin, have_titre, have_texte, have_participants, id_default_participant, have_image_jpg, have_image_jpg_toprint, have_image_gif, have_teaser_mp3, have_teaser_video, have_goodies, have_zip, have_contenu_pages, have_statut_announced, template_reference_emission, template_nommage_fichiers_emission, template_nommage_morceaux_emission) VALUES (".$id_site.", '".$mail_admin."', ".$have_titre.", ".$have_texte.", ".$have_participants.", ".$id_default_participant.", ".$have_image_jpg.", ".$have_image_jpg_toprint.", ".$have_image_gif.", ".$have_teaser_mp3.", ".$have_teaser_video.", ".$have_goodies.", ".$have_zip.", ".$have_contenu_pages.", ".$have_statut_announced.", '".$template_reference_emission."' , '".$template_nommage_fichiers_emission."' , '".$template_nommage_morceaux_emission."');";
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

	$query = "SELECT id, id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE id_site = ".$id_site." AND etat=3 ORDER BY date_sortie DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	$row=mysql_fetch_array($res);
	return $row;
}

function dbListeEmissionsForFeed($id_site){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE id_site=".$id_site." AND etat=3 ORDER BY date_sortie DESC;";
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
NEWS :
======
*/

function dbGetListeEmissionsComingSoon($id_site){

    include('var.php');

	$query = "SELECT id, id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE id_site = ".$id_site." AND etat = 2 ORDER BY numero ASC;";
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

	$query = "SELECT id, id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE id_site = ".$id_site." AND (etat = 2 OR etat = 3) ORDER BY numero ASC;";
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

	$query = "SELECT id, id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE id = ".$p_id.";";
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

	$query = "SELECT id, id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE id_site = ".$p_id_site." AND numero = ".$p_numero.";";
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

	$query = "SELECT id, id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE id_site = ".$id_site." AND etat = 3 AND numero < ".$p_numero." ORDER BY numero DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	{
		$query = "SELECT id, id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE id_site = ".$id_site." AND etat = 3 ORDER BY numero DESC LIMIT 0,1;";
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

	$query = "SELECT id, id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE id_site = ".$id_site." AND etat = 3 AND numero < ".$p_numero." ORDER BY numero ASC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
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

	$query = "SELECT id, id_emission, nom_utilisateur, time_min, time_sec, nom_artiste, nom_morceau FROM MORCEAU WHERE id_emission = ".$p_id_emission." ORDER BY time_min, time_sec ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

//R�cup�ration de la playlist :
function dbGetPlaylistParticipant($p_id_emission, $nom_participant){

    include('var.php');

	$query = "SELECT id, id_emission, nom_utilisateur, time_min, time_sec, nom_artiste, nom_morceau FROM MORCEAU WHERE id_emission = ".$p_id_emission." AND nom_utilisateur = '".urldecode($nom_participant)."' ORDER BY time_min, time_sec ASC;";
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

    $query = "SELECT EMISSION.id, EMISSION.id_site, numero, titre, date_sortie, etat, libelle, time_min, time_sec, teaser_video FROM EMISSION, ETAT_EMISSION WHERE EMISSION.id_site = ".$id_site." AND EMISSION.etat = ETAT_EMISSION.id ORDER BY numero ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

function dbListeAllEmissionForChef($id_site, $admin){

    include('var.php');

    $query = "SELECT DISTINCT EMISSION.id, EMISSION.id_site, numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION, PARTICIPANT WHERE EMISSION.id_site = ".$id_site." AND EMISSION.etat = 2 AND EMISSION.id = PARTICIPANT.id_emission AND PARTICIPANT.est_chef = 1 AND PARTICIPANT.nom_utilisateur = '".urldecode($admin)."' ORDER BY numero ASC;";
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

function dbInsertMorceau($id, $nom, $time_min, $time_sec, $nom_artiste, $nom_morceau)
{
    include('var.php');
    $query = "INSERT INTO MORCEAU (id_emission, nom_utilisateur, time_min, time_sec, nom_morceau, nom_artiste) VALUES (".$id.", '".urldecode($nom)."', ".$time_min.", ".$time_sec.", '".urldecode($nom_morceau)."', '".urldecode($nom_artiste)."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeleteCascadeEmission($id){

    include('var.php');

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

    $query = "DELETE FROM EMISSION WHERE id = ".$id.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
	
	$emission = dbGetEmission($id);
	$numero = $emission["numero"];
	
	include('../sitevars.php');
	if (file_exists("../".$pics."thisisradioclash-episode".$numero.".jpg"))
		unlink("../".$pics."thisisradioclash-episode".$numero.".jpg");
	if (file_exists("../".$mp3s."thisisradioclash-episode".$numero.".mp3"))
		unlink("../".$mp3s."thisisradioclash-episode".$numero.".mp3");
}

function dbInsertEmission($id_site, $numero, $titre, $date_sortie, $etat, $time_min, $time_sec){

    include('var.php');

    $query = "INSERT INTO EMISSION (id_site, numero, titre, date_sortie, etat, time_min, time_sec) VALUES (".$id_site.", ".$numero.", '".urldecode($titre)."', '".$date_sortie."', ".$etat.", ".$time_min.", ".$time_sec.");";
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

function dbUpdateEmission($id, $id_site, $numero, $titre, $date_sortie, $etat, $time_min, $time_sec){

    include('var.php');

    $query = "UPDATE EMISSION SET id_site = ".$id_site.", numero = ".$numero.", titre = '".urldecode($titre)."', date_sortie = '".$date_sortie."', etat = ".$etat.", time_min = ".$time_min.", time_sec = ".$time_sec." WHERE id = ".$id.";";
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
	include('../sitevars.php');
	//$fichier = str_replace("{numero}", $numero, $templateNommageFichiersEmission);	
	//return file_exists("../".$pics.$fichier.".jpg");
	return file_exists("../".$pics."thisisradioclash-episode".$numero.".jpg");
}

function getImageEmissionGifFlag($numero)
{
	include('../sitevars.php');
	return file_exists("../".$pics."thisisradioclash-episode".$numero.".gif");
}

function getTeaserEmissionFlag($numero)
{
	include('../sitevars.php');
	return file_exists("../".$mp3s."thisisradioclash-episode".$numero."-teaser.mp3");
}

function emissionHaveTeaser($numero)
{
	include('sitevars.php');
	return file_exists($mp3s."thisisradioclash-episode".$numero."-teaser.mp3");
}

require('classAudioFile.php');
function getTimeEmission($numero)
{

include('../sitevars.php');
	
	$filePath = "../".$mp3s."thisisradioclash-episode".$numero.".mp3";
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
	include('../sitevars.php');
	
	$filePath = "../".$mp3s."thisisradioclash-episode".$numero.".mp3";
	if (file_exists($filePath))
	{
		return filesize($filePath);
	}
	else
		return 0;
}

function dbGetEmissionCompleteFlag($id)
{
	include('../sitevars.php');
	
	$emission = dbGetEmission($id);
	$numero = $emission["numero"];
	
	$filePath = "../".$mp3s."thisisradioclash-episode".$numero.".mp3";
	if (!file_exists($filePath))
		return false;
	
	$filePath = "../".$pics."thisisradioclash-episode".$numero.".jpg";
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
