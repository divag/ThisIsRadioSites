<?php      
	include('../sitevars.php');
	include('dbFunctions.php');
	include('../'.$zipModule);

	$numero = $_POST['numero'];
	//$numero = $_GET['numero'];
	$nom_emission = 'thisisradioclash-episode'.$numero;
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
	$emission = dbGetEmission($numero);
	
	$fichier_playlist ="THIS IS RADIOCLASH N°".$numero." : ".$emission['titre']."\r\n";
	$fichier_playlist.="\r\n";
	$fichier_playlist.="\r\n";
	
	
	$fichier_playlist.=" 00:00 This is radioclash - Introduction Jingle\r\n";
	
	$playlist = dbGetPlaylist($numero);
	$nomUtilisateurEnCours = "";
	$chef = dbGetChefEmission($numero);
	$i = 1;
	while($array=mysql_fetch_array($playlist))
	{
		if ($nomUtilisateurEnCours != strtoupper($array['nom_utilisateur']))
		{
			$fichier_playlist.="\r\n";
			$utilisateurEnCours = dbGetUtilisateur($array['nom_utilisateur']);
			$nomUtilisateurEnCours = strtoupper($array['nom_utilisateur']);
			
			if ($utilisateurEnCours != 0)
			{
				$fichier_playlist.=$nomUtilisateurEnCours." (".$utilisateurEnCours['url_site'].")\r\n";
			}
			else
			{
				$utilisateursEnCours = dbGetGroupeUtilisateurs($array['nom_utilisateur']);
				$fichier_playlist.=$nomUtilisateurEnCours." [";
				$separateur = "";
				while($utilisateurEnCours=mysql_fetch_array($utilisateursEnCours))
				{
				    $fichier_playlist.=strtoupper($utilisateurEnCours['nom'])." (".$utilisateurEnCours['url_site'].")\r\n";
					$separateur = " + ";
				}
				$fichier_playlist.="]\r\n";
			}
			$fichier_playlist.="\r\n";
		}
		$fichier_playlist.=" ".toTime($array['time_min']).":".toTime($array['time_sec'])." ".$array['nom_artiste']." - ".$array['nom_morceau'].")\r\n";
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
	$fichier_playlist.=">> http://www.thisisradioclash.org/ <<\r\n";
	$fichier_playlist.=">> http://www.musiques-incongrues.net/ <<\r\n";
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
	if (file_exists('../'.$pics.$nom_emission.'.gif'))
	{
		$fileContents = file_get_contents('../'.$pics.$nom_emission.'.gif');
		$radioclashZip -> addFile($fileContents, $nom_emission.'.gif'); 
	}

	$fd = fopen ($nomFichierZip, "wb");
	$out = fwrite ($fd, $radioclashZip -> getZippedfile());
	fclose ($fd);
    
?>