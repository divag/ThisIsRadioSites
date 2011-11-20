<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

//Récupération de la liste des émissions :
$listeEmissions = dbGetListeEmissions($id_site);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
writeHead();
?>
</head>
<body>
<?php
writeEntete('index');
?>

<div class="pageContent">
<h2><span>CLICK ON THE PIC TO SEE PLAYLIST</span></h2>

<ul class="listeEmissions amix">
<?php 

$first = 1;
while($emission=mysql_fetch_array($listeEmissions))
{
	$nomParticipants = listeParticipantsEmission($emission['id']);
	$texteEmission = getReferenceEmission($emission['numero'], null, $nomParticipants);
	
	$texteEmission = str_replace(" by ", "<br />", $texteEmission);
	
	$texteDownloadEmission = "Download ".$texteEmission;

	$imageEmission = $pics.getNomFichierEmission($emission['numero'], null, $nomParticipants).".jpg";
	$mp3Emission = $mp3s.getNomFichierEmission($emission['numero'], null, $nomParticipants).".mp3";
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
			echo "<h3><span>".$anneeEmission."'S ARCHIVES</span></h3>";
			echo "<ul class=\"listeEmissions amix\">\n";
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

<?php
writePiedDePage('index');
?>
</div>

<?php
writeGoogleAnalyticsTag();
?>

</body>
</html>
