<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

//Récupération de la liste des émissions :
$listeEmissions = dbGetListeEmissionsByDate($id_site);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
writeHead('playlists');
?>
</head>
<body>
<?php
writeEntete('playlists');
?>

<div class="pageContent">
<h2><span>CLICK ON THE PIC TO SEE PLAYLIST</span></h2>

<ul class="listeEmissions">
<?php 

$first = 1;
while($emission=mysql_fetch_array($listeEmissions))
{
	$texteEmission = getReferenceEmission($emission['numero'], null, null);
	$texteDownloadEmission = "Download ".$texteEmission;
	$anneeEmission = date('Y', strtotime($emission['date_sortie']));
	$moisEmission = date('m', strtotime($emission['date_sortie']));
	$texteEmission .= " - ".$moisEmission."/".$anneeEmission;
	$imageEmission = $pics.getNomFichierEmission($emission['numero'], null, null).".jpg";
	$mp3Emission = $mp3s.getNomFichierEmission($emission['numero'], null, null).".mp3";
	$linkEmission = $pageEmission.".php?episode=".$emission['numero'];
	
	if ($emission['etat'] == 3)
	{
		if ($first == 1)
		{
			$first = 0;
			$tmpAnnee = $anneeEmission;
		}		
		
		if ($tmpAnnee != $anneeEmission)
		{
			echo "</ul>";
			echo "<br class=\"clear\" />";
			echo "<h3><span>".$anneeEmission."</span></h3>";
			echo "<ul class=\"listeEmissions\">\n";
			$tmpAnnee = $anneeEmission;
		}

		echo "<li>";
		echo "  <a href=\"".$linkEmission."\">";
		echo "    <img src=\"".$imageEmission."\" title=\"".$texteEmission."\"/><br />";
		echo "    <span class=\"lienEmission\">".$texteEmission."</span>";
		echo "  </a>";
		echo "  <br />";
		echo "  <a href=\"".$mp3Emission."\">";
		echo "    <span class=\"lienDownloadEmission\">".$texteDownloadEmission."</span>";
		echo "  </a>";
		echo "</li>";
	}
}
	
?>
</ul>

<br class="clear" />
<h4><span>PLEASE WAIT FOR OLDER SHOWS, THEY ARE COMING LATER...</span></h4>

<?php
writePiedDePage('playlists');
?>
</div>

<?php
writeGoogleAnalyticsTag();
?>

</body>
</html>
