<?php

/* 
INDEX :
=======
*/

//R�cup�ration de la derni�re �mission
function dbGetLastEmission(){

    include('var.php');

	$query = "SELECT numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE etat=3 ORDER BY date_sortie DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	$row=mysql_fetch_array($res);
	return $row;
}

function dbListeEmissionsForFeed(){

    include('var.php');

	$query = "SELECT numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE etat=3 ORDER BY date_sortie DESC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

function dbGetMaxNumberEmission(){

    include('var.php');

	$query = "SELECT numero FROM EMISSION ORDER BY numero DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	$row=mysql_fetch_array($res);
	return $row['numero'];
}

//R�cup�ration de la liste de tous participants des �missions actives :
function dbGetNomsParticipantsActifs(){

    include('var.php');

	$query = "SELECT DISTINCT allUsers.login_forum FROM ((SELECT login_forum FROM UTILISATEUR, PARTICIPANT, EMISSION WHERE UTILISATEUR.nom = PARTICIPANT.nom_utilisateur AND PARTICIPANT.numero_emission = EMISSION.numero AND EMISSION.etat = 3) UNION (SELECT login_forum FROM UTILISATEUR, GROUPE_UTILISATEURS, PARTICIPANT, EMISSION WHERE UTILISATEUR.nom = GROUPE_UTILISATEURS.nom_utilisateur AND GROUPE_UTILISATEURS.nom = PARTICIPANT.nom_utilisateur AND PARTICIPANT.numero_emission = EMISSION.numero AND EMISSION.etat = 3)) as allUsers;";
    $link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//R�cup�ration de la liste de tous participants des �missions actives, en texte (avec leur nom sur le forum si possible) s�par�s par des virgules :
function listeParticipants()
{
    $listeParticipants = dbGetNomsParticipantsActifs();
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

function dbGetListeEmissionsComingSoon(){

    include('var.php');

	$query = "SELECT numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE etat = 2 ORDER BY numero ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

//R�cup�ration de la liste de tous les participants d'une �mission :
function dbGetParticipantsEmission($p_numero_emission){

    include('var.php');

    $query = "SELECT numero_emission, nom_utilisateur, ordre, est_chef FROM PARTICIPANT WHERE numero_emission = ".$p_numero_emission." ORDER BY ORDRE ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

//R�cup�ration d'un participant :
function dbGetParticipant($p_nom){

    include('var.php');

    $query = "SELECT numero_emission, nom_utilisateur, ordre, est_chef FROM PARTICIPANT WHERE nom_utilisateur = '".urldecode($p_nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);

	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	    return 0;
}

//R�cup�ration d'un participant :
function dbGetMembreGroupe($p_nom){

    include('var.php');

    $query = "SELECT nom, nom_utilisateur FROM GROUPE_UTILISATEURS WHERE nom_utilisateur = '".urldecode($p_nom)."';";
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

    $query = "SELECT PARTICIPANT.numero_emission FROM PARTICIPANT, GROUPE_UTILISATEURS WHERE PARTICIPANT.est_chef = 1 AND (PARTICIPANT.nom_utilisateur = '".urldecode($p_nom)."' OR (PARTICIPANT.nom_utilisateur = GROUPE_UTILISATEURS.nom AND GROUPE_UTILISATEURS.nom_utilisateur = '".urldecode($p_nom)."'));";
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
function listeParticipantsEmission($p_numero_emission)
{
    $listeParticipants = dbGetParticipantsEmission($p_numero_emission);
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
function dbGetListeEmissions(){

    include('var.php');

	$query = "SELECT numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE etat = 2 OR etat = 3 ORDER BY numero ASC;";
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
function dbGetEmission($p_numero){

    include('var.php');

	$query = "SELECT numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE numero = ".$p_numero.";";
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
function dbGetNextEmission($p_numero){

    include('var.php');

	$query = "SELECT numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE etat = 3 AND numero < ".$p_numero." ORDER BY numero DESC LIMIT 0,1;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if ($row=mysql_fetch_array($res))
	    return $row;
    else
	{
		$query = "SELECT numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE etat = 3 ORDER BY numero DESC LIMIT 0,1;";
		$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
		$select_base=mysql_selectdb($db);
		$res=mysql_db_query ($db, $query);	
		mysql_close($link);	
		$row=mysql_fetch_array($res);
		return $row;	
	}
}

//R�cup�ration de l'�mission pr�c�dente :
function dbGetPrevEmission($p_numero){

    include('var.php');

	$query = "SELECT numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION WHERE etat = 3 AND numero < ".$p_numero." ORDER BY numero ASC LIMIT 0,1;";
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

	$query = "SELECT nom, login_forum, url_site, mail, password FROM UTILISATEUR WHERE nom = '".urldecode($p_nom_utilisateur)."';";
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

//R�cup�ration d'un groupe d'utilisateurs :
function dbGetGroupeUtilisateurs($p_nom_groupe){

    include('var.php');

	$query = "SELECT UTILISATEUR.nom, UTILISATEUR.login_forum, UTILISATEUR.url_site, UTILISATEUR.mail, UTILISATEUR.password FROM UTILISATEUR, GROUPE_UTILISATEURS WHERE UTILISATEUR.nom = GROUPE_UTILISATEURS.nom_utilisateur AND GROUPE_UTILISATEURS.nom = '".urldecode($p_nom_groupe)."' ORDER BY UTILISATEUR.nom ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	if (mysql_num_rows($res) == 0)
		return 0;
	else
		return $res;
}

//R�cup�ration de la playlist :
function dbGetPlaylist($p_numero_emission){

    include('var.php');

	$query = "SELECT id, numero_emission, nom_utilisateur, time_min, time_sec, nom_artiste, nom_morceau FROM MORCEAU WHERE numero_emission = ".$p_numero_emission." ORDER BY time_min, time_sec ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

//R�cup�ration de la playlist :
function dbGetPlaylistParticipant($p_numero_emission, $nom_participant){

    include('var.php');

	$query = "SELECT id, numero_emission, nom_utilisateur, time_min, time_sec, nom_artiste, nom_morceau FROM MORCEAU WHERE numero_emission = ".$p_numero_emission." AND nom_utilisateur = '".urldecode($nom_participant)."' ORDER BY time_min, time_sec ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

function dbGetMorceauxEmissionFlag($p_numero_emission){

    include('var.php');

	$query = "SELECT id FROM MORCEAU WHERE numero_emission = ".$p_numero_emission.";";
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

function dbListeAllEmission(){

    include('var.php');

    $query = "SELECT numero, titre, date_sortie, etat, libelle, time_min, time_sec, teaser_video FROM EMISSION, ETAT_EMISSION WHERE EMISSION.etat = ETAT_EMISSION.id ORDER BY numero ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

function dbListeAllEmissionForChef($admin){

    include('var.php');

    $query = "SELECT DISTINCT numero, titre, date_sortie, etat, time_min, time_sec, teaser_video FROM EMISSION, GROUPE_UTILISATEURS, PARTICIPANT WHERE EMISSION.etat = 2 AND EMISSION.numero = PARTICIPANT.numero_emission AND PARTICIPANT.est_chef = 1 AND ((PARTICIPANT.nom_utilisateur = '".urldecode($admin)."') OR (PARTICIPANT.nom_utilisateur = GROUPE_UTILISATEURS.nom AND GROUPE_UTILISATEURS.nom_utilisateur = '".urldecode($admin)."')) ORDER BY numero ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
    mysql_close($link);
    return $res;
}

function dbDeleteEmission($numero){

    include('var.php');

    $query = "DELETE FROM EMISSION WHERE numero = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeletePlaylistParticipant($numero, $nom){

    include('var.php');

    $query = "DELETE FROM MORCEAU WHERE numero_emission = ".$numero." AND nom_utilisateur = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbInsertMorceau($numero, $nom, $time_min, $time_sec, $nom_artiste, $nom_morceau)
{
    include('var.php');
    $query = "INSERT INTO MORCEAU (numero_emission, nom_utilisateur, time_min, time_sec, nom_morceau, nom_artiste) VALUES (".$numero.", '".urldecode($nom)."', ".$time_min.", ".$time_sec.", '".urldecode($nom_morceau)."', '".urldecode($nom_artiste)."');";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeleteCascadeEmission($numero){

    include('var.php');

    $query = "DELETE FROM MORCEAU WHERE numero_emission = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);

    $query = "DELETE FROM PARTICIPANT WHERE numero_emission = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);

    $query = "DELETE FROM EMISSION WHERE numero = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
	
	include('../sitevars.php');
	if (file_exists("../".$pics."thisisradioclash-episode".$numero.".jpg"))
		unlink("../".$pics."thisisradioclash-episode".$numero.".jpg");
	if (file_exists("../".$mp3s."thisisradioclash-episode".$numero.".mp3"))
		unlink("../".$mp3s."thisisradioclash-episode".$numero.".mp3");
}

function dbInsertEmission($numero, $titre, $date_sortie, $etat, $time_min, $time_sec){

    include('var.php');

    $query = "INSERT INTO EMISSION (numero, titre, date_sortie, etat, time_min, time_sec) VALUES (".$numero.", '".urldecode($titre)."', '".$date_sortie."', ".$etat.", ".$time_min.", ".$time_sec.");";
    //$query = "INSERT INTO EMISSION (numero, titre, date_sortie, etat, time_min, time_sec) VALUES (".$numero.", '".utf8_decode($titre)."', '".$date_sortie."', ".$etat.", ".$time_min.", ".$time_sec.");";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbUpdateTimeEmission($numero, $time_min, $time_sec){

    include('var.php');

    $query = "UPDATE EMISSION SET time_min = ".$time_min.", time_sec = ".$time_sec." WHERE numero = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbUpdateTeaserVideoEmission($numero, $teaser_video){

    include('var.php');

    $query = "UPDATE EMISSION SET teaser_video = '".urldecode($teaser_video)."' WHERE numero = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbUpdateEmission($numero, $titre, $date_sortie, $etat, $time_min, $time_sec){

    include('var.php');

    $query = "UPDATE EMISSION SET titre = '".urldecode($titre)."', date_sortie = '".$date_sortie."', etat = ".$etat.", time_min = ".$time_min.", time_sec = ".$time_sec." WHERE numero = ".$numero.";";
    //$query = "UPDATE EMISSION SET titre = '".$titre."', date_sortie = '".$date_sortie."', WHERE numero = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbUpdateEtatEmission($numero_emission, $id_etat){

    include('var.php');

	if ($id_etat == '3')
		$query = "UPDATE EMISSION SET etat = ".$id_etat.", date_sortie = '".date("Y-m-d H:i:s")."' WHERE numero = ".$numero_emission.";";
	else
	    $query = "UPDATE EMISSION SET etat = ".$id_etat." WHERE numero = ".$numero_emission.";";

	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);

}

function getImageEmissionFlag($numero)
{
	include('../sitevars.php');
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

function dbGetEmissionCompleteFlag($numero)
{
	include('../sitevars.php');
	
	$filePath = "../".$mp3s."thisisradioclash-episode".$numero.".mp3";
	if (!file_exists($filePath))
		return false;
	
	$filePath = "../".$pics."thisisradioclash-episode".$numero.".jpg";
	if (!file_exists($filePath))
		return false;
	
	if (listeParticipantsEmission($numero) == '')
		return false;
		
	$liste_participants = dbGetListeParticipantsEmission($numero);
	while($array=mysql_fetch_array($liste_participants))
	{	
		if (dbGetUtilisateur($array['nom_utilisateur']) == 0 && dbGetGroupeUtilisateurs($array['nom_utilisateur']) == 0)
			return false;
	}	
	
	return true;
}

/**************************/

//R�cup�ration de l'�mission :
function dbGetListeAllParticipants(){

    include('var.php');

	$query = "SELECT DISTINCT nom_utilisateur FROM PARTICIPANT ORDER BY nom_utilisateur ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

function dbGetListeAllParticipantsUsersAndGroupes(){

	include('var.php');

	$query = "SELECT DISTINCT allUsers.nom FROM ((SELECT nom FROM UTILISATEUR) UNION (SELECT nom FROM GROUPE_UTILISATEURS) UNION (SELECT nom_utilisateur as nom FROM PARTICIPANT)) as allUsers ORDER BY allUsers.nom ASC;";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

function dbInsertParticipant($numero, $nom, $ordre, $est_chef){

    include('var.php');

    $query = "INSERT INTO PARTICIPANT (numero_emission, nom_utilisateur, ordre, est_chef) VALUES (".$numero.", '".urldecode($nom)."', ".$ordre.", ".$est_chef.");";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbDeleteParticipant($numero, $nom){

    include('var.php');

	dbDeletePlaylistParticipant($numero, $nom);
	
    $query = "DELETE FROM PARTICIPANT WHERE numero_emission = ".$numero." AND nom_utilisateur = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
    mysql_close($link);
}

function dbGetListeParticipantsEmission($numero){

    include('var.php');

	$query = "SELECT nom_utilisateur, ordre, est_chef FROM PARTICIPANT WHERE numero_emission = ".$numero." ORDER BY ordre ASC;";
	$link=mysql_connect($hote,$login,$passwd); 
	mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res=mysql_db_query ($db, $query);	
	mysql_close($link);
	
	return $res;
}

function dbGetChefEmission($numero)
{
    include('var.php');

	$query = "SELECT nom_utilisateur FROM PARTICIPANT WHERE est_chef = 1 AND numero_emission = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	$res = mysql_db_query ($db, $query);	
	mysql_close($link);

	if ($row=mysql_fetch_array($res))
		return $row['nom_utilisateur'];
	else
		return '';

}

function dbUpdateChefEmission($numero, $nom)
{

    include('var.php');

	$query = "UPDATE PARTICIPANT SET est_chef = 0 WHERE numero_emission = ".$numero.";";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);

	$query = "UPDATE PARTICIPANT SET est_chef = 1 WHERE numero_emission = ".$numero." AND  nom_utilisateur = '".urldecode($nom)."';";
	$link=mysql_connect($hote,$login,$passwd); mysql_query("SET NAMES UTF8");
	$select_base=mysql_selectdb($db);
	mysql_db_query ($db, $query);	
	mysql_close($link);
}

function dbUpdateOrdreParticipant($numero, $nom, $ordre)
{

    include('var.php');

	$query = "UPDATE PARTICIPANT SET ordre = ".$ordre." WHERE numero_emission = ".$numero." AND  nom_utilisateur = '".urldecode($nom)."';";
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

		$query = "UPDATE GROUPE_UTILISATEURS SET nom_utilisateur = '".urldecode($nom)."' WHERE nom_utilisateur = '".urldecode($nomWhere)."';";
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
