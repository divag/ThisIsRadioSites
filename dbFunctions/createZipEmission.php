<?php      
	include('../dbFunctions/dbFunctions.php');
	include('../sitevars.php');
	include('../'.$zipModule);

	$id = $_POST['id'];
	//$id = $_GET['id'];
	
	$emission = dbGetEmission($id);
	$nomParticipants = listeParticipantsEmission($id);
	$numero = $emission['numero'];
	$titre = $emission['titre'];
	$id_site = $emission['id_site'];
	
	$ref_emission = getReferenceEmission($numero, $titre, $nomParticipants);
	$nom_emission = getNomFichierEmission($numero, $titre, $nomParticipants);
	$linkEmission = $radioclashHome.$pageEmission.".php?episode=".$numero;
    $chemin_destination = '../'.$zips;
	
	echo "/*";
	
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
	$fichier_playlist = $nomSite." ".$ref_emission." : (".$linkEmission.")\r\n";
	$fichier_playlist.= "\r\n";
	$fichier_playlist.= "\r\n";
			
	$playlist = dbGetPlaylist($id);
	$nomUtilisateurEnCours = "";
	$chef = dbGetChefEmission($id);
	$i = 0;
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
		
		if ($i == 0 && (toTime($array['time_min']) != "00" || toTime($array['time_sec']) != "00"))
		{
			echo "00:00 Introduction\r\n";
			$i++;
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
	fclose ($fd);
	
	echo "*/";
?>