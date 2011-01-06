<?php include('dbFunctions/dbFunctions.php');
include('siteparts.php');
include('sitevars.php');

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
writeEntete('listen');
?>

<div class="pageContent">

<ul class="listeEmissions">
<?php 
while($emission=mysql_fetch_array($listeEmissions))
{
	$texteEmission = $emission['numero']." : ".$emission['titre'];
	$imageEmission = $pics."thisisradioclash-episode".$emission['numero'].".jpg";
	$linkEmission = "playlist.php?episode=".$emission['numero'];

	echo "<li>";
	if ($emission['etat'] == 3)
	{
		echo "  <a href=\"".$linkEmission."\">";
		echo "    <img src=\"".$imageEmission."\" title=\"".$texteEmission."\"/><br />";
		echo "    <span class=\"lienEmission\">".$texteEmission."</span>";
		echo "  </a>";
	}
	else
	{
		echo "    <img src=\"".$pics."comingsoon.jpg\" title=\"".$texteEmission."\"/><br />";
		echo "    <span class=\"lienEmission\" class=\"lienEmission\">".$texteEmission."</span>";
	}
	echo "</li>";
}
	
echo "<li class=\"proposez\">";
	echo "  <a href=\"".$lienForum."\" target=\"blank\">";
	echo "    <img src=\"".$pics."proposez.jpg\" title=\"Proposez un th&egrave;me sur le forum !\"/><br />";
	echo "    >> <span>FORUM</span> <<";
	echo "  </a>";
echo "</li>";

?>
</ul>

<?php
writePiedDePage('listen');
?>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-15206866-1");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>
