<?php
$numero = $_POST['numero'];
$extension = $_POST['extension'];
$folder = $_POST['folder'];

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$toPrint = (strpos($numero, '-toPrint'));
if ($toPrint == true)
	$numero = str_replace("-toPrint", "", $numero);

$teaser = (strpos($numero, '-teaser'));
if ($teaser == true)
	$numero = str_replace("-teaser", "", $numero);

$emission = dbGetEmissionByNumero($id_site, $numero);
$idEmission = $emission['id'];
$titre = $emission['titre'];
$nomParticipants = listeParticipantsEmission($idEmission);

if ($folder == 'contenu/')
	$fpath= '../'.$folder.$numero.$extension;
else
{
	$fpath = '../'.$folder.getNomFichierEmission($numero, $titre, $nomParticipants);
	if ($toPrint)
		$fpath .= '-toPrint';
		
	if ($teaser)
		$fpath .= '-teaser';
		
	$fpath .= $extension;
}
	
print_r($_FILES);

if ($_FILES['fileEmission']['error']) {
          switch ($_FILES['fileEmission']['error']){
                   case 1: // UPLOAD_ERR_INI_SIZE
                   echo"Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
                   break;
                   case 2: // UPLOAD_ERR_FORM_SIZE
                   echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
                   break;
                   case 3: // UPLOAD_ERR_PARTIAL
                   echo "L'envoi du fichier a été interrompu pendant le transfert !";
                   break;
                   case 4: // UPLOAD_ERR_NO_FILE
                   echo "Le fichier que vous avez envoyé a une taille nulle !";
                   break;
          }
}
else {
 // $_FILES['fileEmission']['error'] vaut 0 soit UPLOAD_ERR_OK
 // ce qui signifie qu'il n'y a eu aucune erreur
}

if (move_uploaded_file($_FILES['fileEmission']['tmp_name'], $fpath)) 
{
/*
	if ($extension == '.jpg' && $numero != 0)
	{
		$fpath_thumb = str_replace('.jpg', '_t.jpg', $fpath);
	
		//CREATION DU THUMBNAIL :
		//=======================
		
		// Set a maximum height and width
		$width = 126;
		$height = 126;

		$thumbsize = 126;

		// Get new dimensions
		list($width_orig, $height_orig) = getimagesize($fpath);

		$ratio_orig = $width_orig/$height_orig;

		if ($width/$height > $ratio_orig) {
		   $width = $height*$ratio_orig;
		} else {
		   $height = $width/$ratio_orig;
		}

		// Resample
		$image_p = imagecreatefromjpeg('../pochettes/comingsoon.jpg');
		$image = imagecreatefromjpeg($filename);
		imagecopyresampled($image_p, $image, -($width/2) + ($thumbsize/2), -($height/2) + ($thumbsize/2), 0, 0, $width, $height, $width_orig, $height_orig);

		// Output
		imagejpeg($image_p, $fpath_thumb, 126);
		
		chmod($fpath_thumb, 0777);
	}
*/
	echo "success";
	chmod($fpath, 0644);

} else {
  // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
  // Otherwise onSubmit event will not be fired
  echo "error";
}

?>