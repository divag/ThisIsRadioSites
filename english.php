<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

//Récupération de la derni&egrave;re émission :
$lastEmission = dbGetLastEmission($id_site);

$nomLastParticipants = listeParticipantsEmission($lastEmission['id']);
$texteLastEmission = getReferenceEmission($lastEmission['numero'], $lastEmission['titre'], $nomParticipants);
$nomFichierEmission = getNomFichierEmission($lastEmission['numero'], $lastEmission['titre'], $nomParticipants);

if (file_exists($pics.$nomFichierEmission.".gif"))
	$imageLastEmission = $pics.$nomFichierEmission.".gif";
else
	$imageLastEmission = $pics.$nomFichierEmission.".jpg";

$linkLastEmission = "playlist.php?episode=".$lastEmission['numero'];

//Récupération de la liste des participants :
$listeParticipants = listeParticipants($id_site);
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
writeEntete('');
?>

<div class="pageContent">

<?php
$contenu = dbGetContenuPageSite($id_site, 'english', 'contenu');
if ($contenu != 0)
{
	echo $contenu['contenu_fr']."\n";
}
?>

<div class="texteAccueil">
	<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=thisisradioclash', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
		You can subscribe to our mailing-list just here :	
		<input type="text" style="width:200px;border:1px solid black;background-color:white;;color:black;" name="email"/>
		<input type="hidden" value="thisisradioclash" name="uri"/>
		<input type="hidden" name="loc" value="en_US"/>
		<input type="submit" value="OK" style="width:30px;border:1px solid black;background-color:#EEEEEE;color:black;cursor:pointer;cursor:hand;" />
		<!--Delivered by <a href="http://feedburner.google.com" target="_blank">FeedBurner</a>-->
		<br /><br />
	</form>
</div>	

<h2 class="gris">Ne HAISSEZ pas la Radioclash, <i>SOYEZ la Radioclash !</i></h2>
<p>They are, they were, they will be so far : 
<span class="italique"><?php echo $listeParticipants ?></span> &amp; YOU !</p>

<?php
writePiedDePage('');
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
