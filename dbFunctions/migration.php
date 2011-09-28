<?php 
	include('../dbFunctions/dbFunctions.php');
	include('../sitevars.php');
	include('../'.$zipModule);

//Récupération de la liste des émissions :
$listeEmissions = dbGetListeEmissions($id_site);

echo "<ul>\n";
	
$id_to_zip = 0;

while($emission=mysql_fetch_array($listeEmissions))
{
	$base = "../";
	$imageEmission = $base.$pics.getNomFichierEmission($emission['numero'], $emission['titre'], null).".jpg";
	$oldImageEmission = $base.$pics."thisisradioclash-episode".$emission['numero'].".jpg";
	$imageGifEmission = $base.$pics.getNomFichierEmission($emission['numero'], $emission['titre'], null).".gif";
	$oldImageGifEmission = $base.$pics."thisisradioclash-episode".$emission['numero'].".gif";
	$imageToPrintEmission = $base.$pics.getNomFichierEmission($emission['numero'], $emission['titre'], null)."-toPrint.jpg";
	$oldImageToPrintEmission = $base.$pics."thisisradioclash-episode".$emission['numero']."-toPrint.jpg";
	$mp3TeaserEmission = $base.$mp3s.getNomFichierEmission($emission['numero'], $emission['titre'], null)."-teaser.mp3";
	$oldMp3TeaserEmission = $base.$mp3s."thisisradioclash-episode".$emission['numero']."-teaser.mp3";
	$mp3Emission = $base.$mp3s.getNomFichierEmission($emission['numero'], $emission['titre'], null).".mp3";
	$oldMp3Emission = $base.$mp3s."thisisradioclash-episode".$emission['numero'].".mp3";
	$oldZipEmission = $base.$zips."thisisradioclash-episode".$emission['numero'].".zip";
	$zipEmission = $base.$zips.getNomFichierEmission($emission['numero'], $emission['titre'], null).".zip";
	
	echo "<li>\n";
	if (file_exists($oldImageEmission))
	{
		rename($oldImageEmission, $imageEmission);
		echo $oldImageEmission." >> ".$imageEmission."<br />";
	}
	if (file_exists($oldImageGifEmission))
	{
		rename($oldImageGifEmission, $imageGifEmission);
		echo $oldImageGifEmission." >> ".$imageGifEmission."<br />";
	}
	if (file_exists($oldImageToPrintEmission))
	{
		rename($oldImageToPrintEmission, $imageToPrintEmission);
		echo $oldImageToPrintEmission." >> ".$imageToPrintEmission."<br />";
	}
	if (file_exists($oldMp3Emission))
	{
		rename($oldMp3Emission, $mp3Emission);
		echo $oldMp3Emission." >> ".$mp3Emission."<br />";
	}
	if (file_exists($oldMp3TeaserEmission))
	{
		rename($oldMp3TeaserEmission, $mp3TeaserEmission);
		echo $oldMp3TeaserEmission." >> ".$mp3TeaserEmission."<br />";
	}
	if (file_exists($oldZipEmission))
	{
		unlink($oldZipEmission);
		echo "Suppression de l'ancien ZIP >> ".$oldZipEmission."<br />";
	}
	if ($emission['etat'] == 3 && !file_exists($zipEmission))
	{
		if ($id_to_zip == 0)
			$id_to_zip = $emission['id'];
			
		echo "<b>A mettre à jour : ".$emission['id']."</b>";
	}
	if ($emission['id'] == 45)
	{
		echo "<br />>>>>>>>>> <b>Mise à jour du ZIP de l'émission ID=".$emission['id']."</b>";
		createZipEmission($emission['id']);
	}
	echo "</li>\n";
}
	
echo "</ul>\n";

function createZipEmission($id)
{
	include('../sitevars.php');
	
	$emission = dbGetEmission($id);
	$nomParticipants = listeParticipantsEmission($id);
	$numero = $emission['numero'];
	$titre = $emission['titre'];
	$id_site = $emission['id_site'];
	
	$ref_emission = getReferenceEmission($numero, $titre, $nomParticipants);
	$nom_emission = getNomFichierEmission($numero, $titre, $nomParticipants);
    $chemin_destination = '../'.$zips;
	
    if (!file_exists($chemin_destination))
    {
        mkdir($chemin_destination, 0777);
        chmod($chemin_destination, 0777);
    }    

	$filename = $chemin_destination.$nom_emission.'.zip';

	// Creation du nom du fichier zip
	$nomFichierZip = $filename;

	// Si le zip a déjà été généré il faut l"effacer de suite pour eviter de creer un zip 
	// contenant le zip précédent
	if(file_exists($nomFichierZip))
	 @unlink($nomFichierZip);

	// instanciation de l'objet createZip
	$radioclashZip = new createZip;  

	// On genere le fichier de la playlist :	
	$fichier_playlist = "ThisIsRadioclash ".$ref_emission."\r\n";
	$fichier_playlist.= "\r\n";
	$fichier_playlist.= "\r\n";
	
	
	$fichier_playlist.=" 00:00 This is radioclash - Introduction Jingle\r\n";
	
	$playlist = dbGetPlaylist($id);
	$nomUtilisateurEnCours = "";
	$chef = dbGetChefEmission($id);
	$i = 1;
	while($array=mysql_fetch_array($playlist))
	{
		if ($nomUtilisateurEnCours != strtoupper($array['nom_utilisateur']))
		{
			$fichier_playlist.="\r\n";
			$utilisateurEnCours = dbGetUtilisateur($array['nom_utilisateur']);
			$nomUtilisateurEnCours = strtoupper($array['nom_utilisateur']);
			
			if ($utilisateurEnCours['url_site'] != "http://" && $utilisateurEnCours['url_site'] != "")
				$fichier_playlist.=$nomUtilisateurEnCours." (".$utilisateurEnCours['url_site'].")\r\n";
			else
				$fichier_playlist.=$nomUtilisateurEnCours."\r\n";

			$fichier_playlist.="\r\n";
		}
		
		$fichier_playlist.=" ".getNomMorceauEmission(toTime($array['time_min']), toTime($array['time_sec']), $array['nom_artiste'], $array['nom_morceau'], $array['nom_label'], $array['annee'])."\r\n";
		$i++;
	}
	
	$fichier_playlist.="\r\n";
	$fichier_playlist.="\r\n";
	if ($chef != '')
	    $fichier_playlist.="Une émission présidée par ".$chef."\r\n";
		
	$fichier_playlist.="\r\n";
		
	if ($emission['teaser_video'] != '')
	{
		$fichier_playlist.="\r\n";
		$fichier_playlist.="Teaser vidéo : ";
		$fichier_playlist.="\r\n - ".$emission['teaser_video'];
		$fichier_playlist.="\r\n";
	}	
    
	$fichier_playlist.="\r\n";
	$fichier_playlist.="---------------------------------\r\n";
	$fichier_playlist.=">> ".$radioclashHome." <<\r\n";
	$fichier_playlist.=">> ".$lienForum." <<\r\n";
	$fichier_playlist.="\r\n";

	$radioclashZip -> addFile($fichier_playlist, $nom_emission.'.txt'); 

	if (file_exists('../'.$mp3s.$nom_emission.'.mp3'))
	{
		$fileContents = file_get_contents('../'.$mp3s.$nom_emission.'.mp3');
		$radioclashZip -> addFile($fileContents, $nom_emission.'.mp3'); 
	}
	if (file_exists('../'.$mp3s.$nom_emission.'-teaser.mp3'))
	{
		$fileContents = file_get_contents('../'.$mp3s.$nom_emission.'-teaser.mp3');
		$radioclashZip -> addFile($fileContents, $nom_emission.'-teaser.mp3'); 
	}
	if (file_exists('../'.$pics.$nom_emission.'.jpg'))
	{
		$fileContents = file_get_contents('../'.$pics.$nom_emission.'.jpg');
		$radioclashZip -> addFile($fileContents, $nom_emission.'.jpg'); 
	}
	if (file_exists('../'.$pics.$nom_emission.'-toPrint.jpg'))
	{
		$fileContents = file_get_contents('../'.$pics.$nom_emission.'-toPrint.jpg');
		$radioclashZip -> addFile($fileContents, $nom_emission.'-toPrint.jpg'); 
	}
	if (file_exists('../'.$pics.$nom_emission.'.gif'))
	{
		$fileContents = file_get_contents('../'.$pics.$nom_emission.'.gif');
		$radioclashZip -> addFile($fileContents, $nom_emission.'.gif'); 
	}

	//
	// TODO : Ajouter les bonus des émissions, et le texte de présentation
	//
	
	$fd = fopen ($nomFichierZip, "wb");
	$out = fwrite ($fd, $radioclashZip -> getZippedfile());
	fclose ($fd);}

?>
