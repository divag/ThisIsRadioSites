<?php

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$emission = dbGetEmission($_POST["id"]);
$nomParticipants = listeParticipantsEmission($_POST["id"]);

$base = "../";

$oldImageEmission = $base.$pics.getNomFichierEmission($emission['numero'], $emission['titre'], $nomParticipants).".jpg";
$imageEmission = $base.$pics.getNomFichierEmission($_POST["numero"], $_POST["titre"], $nomParticipants).".jpg";
$oldImageGifEmission = $base.$pics.getNomFichierEmission($emission['numero'], $emission['titre'], $nomParticipants).".gif";
$imageGifEmission = $base.$pics.getNomFichierEmission($_POST["numero"], $_POST["titre"], $nomParticipants).".gif";
$oldImageToPrintEmission = $base.$pics.getNomFichierEmission($emission['numero'], $emission['titre'], $nomParticipants)."-toPrint.jpg";
$imageToPrintEmission = $base.$pics.getNomFichierEmission($_POST["numero"], $_POST["titre"], $nomParticipants)."-toPrint.jpg";
$oldMp3Emission = $base.$mp3s.getNomFichierEmission($emission['numero'], $emission['titre'], $nomParticipants).".mp3";
$mp3Emission = $base.$mp3s.getNomFichierEmission($_POST["numero"], $_POST["titre"], $nomParticipants).".mp3";
$oldZipEmission = $base.$zips.getNomFichierEmission($emission['numero'], $emission['titre'], $nomParticipants).".zip";

if (file_exists($oldImageEmission))
	rename($oldImageEmission, $imageEmission);

if (file_exists($oldImageGifEmission))
	rename($oldImageGifEmission, $imageGifEmission);

if (file_exists($oldImageToPrintEmission))
	rename($oldImageToPrintEmission, $imageToPrintEmission);
	
if (file_exists($oldMp3Emission))
	rename($oldMp3Emission, $mp3Emission);
	
if (file_exists($oldZipEmission))
	unlink($oldZipEmission);

dbUpdateEmission($_POST["id"], $_POST["id_site"], $_POST["numero"], $_POST["titre"], $_POST["date_sortie"], $_POST["etat"], $_POST["time_min"], $_POST["time_sec"], $_POST["url_lien_forum"]);

?>