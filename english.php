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


<table class="maxSize">
	<tr>
		<td>
		<!--
			<a href="<?php echo $linkLastEmission ?>">
				<img src="<?php echo $imageLastEmission ?>" width="198" height="198" border="0" align="top" /><br />
				<span class="lienEmission"><?php echo $texteLastEmission ?></span>
			</a>
		-->
		</td>
		<td>
			<div class="texteAccueil">
				<p class="presentation">
					A "Radioclash" is a 60 minutes mix made of 4/5 parts of 12 or 15 minutes around a THEMA<br />
					chosen by YOU or someone else. Participate or propose a thema 24/24 <a href="http://www.musiques-incongrues.net/forum/discussions" target="blank"><span>HERE</span></a> Whatever you want,<br />
					whenever you want ! 
				</p>
				<p class="historique">
					This project was born on <a href="http://www.musiques-incongrues.net" target="blank"><span>MUSIQUES INCONGRUES</span></a> forum from an idea of Ogon Feraille.<br />
					It is all participative and interactive, everybody is warmly welcome,<br />
					are you pro or not, girl or not, robot or not, horny or not !<br />
					<br />
					<b>ATTENTION ! THIS IS RADIOCLASH IS A PARTICIPATIVE PROJECT !!!</b><br />
					This is why you are free (and even warmly invited) to propose a thema un th&egrave;me whenever in the year, night and day.<br />
					This just force you to collect the different parts from your thema colleagues and to do the final assemblage<br />
					(but you can also delegue it to someone of your crew). It is the same for the "cover"<br />
					- just respect the format and write "This is radiclash n&deg; x" and thema.<br />
					You are also absolutely free to join any thema as long as there is room for you.<br />
					4 or 5 participants for one hour seems a good ratio. At last, if you desire, you can participate<br />
					to 2 or more Radioclash in the same time or even propose a thema while participating to another one,<br />
					but remember that once the crew constituted you have one month to give your part.<br />
					(Known as Schling test case ).<br />
					There is only one obligation : stick to the thema<br />
					THIS IS RADIOCLASH EST UN PROJET AUTOGERE QUI S'ECRIT EN DIRECT AVEC VOUS
				</p>
			</div>
		</td>
	<tr>
</table>
<br />


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
