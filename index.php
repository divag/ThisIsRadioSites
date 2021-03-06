<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

//R�cup�ration de la derni�re �mission :
$lastEmission = dbGetLastEmission($id_site);

$nomLastParticipants = listeParticipantsEmission($lastEmission['id']);
$texteLastEmission = getReferenceEmission($lastEmission['numero'], $lastEmission['titre'], $nomParticipants);
$nomFichierEmission = getNomFichierEmission($lastEmission['numero'], $lastEmission['titre'], $nomParticipants);
$contenuImageNews = dbGetContenuPageSite($id_site, "index", "image page accueil");
if ($contenuImageNews != 0)
	$lienImageNews = $contenuImageNews['url'];

if (file_exists($pics.$nomFichierEmission.".gif"))
	$imageLastEmission = $pics.$nomFichierEmission.".gif";
else
	$imageLastEmission = $pics.$nomFichierEmission.".jpg";

$linkLastEmission = "playlist.php?episode=".$lastEmission['numero'];

//R�cup�ration de la liste des participants :
$listeParticipants = listeParticipants($id_site);

//NEWS :
//R�cup�ration de la liste des �missions � venir :
$listeEmissions = dbGetListeEmissionsComingSoon($id_site);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
writeHead();
?>
<!-- required -->
<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>css/360player.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>css/360player-visualization.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>css/360divagSpecialFeatures.css" />
<!-- special IE-only canvas fix -->
<!--[if IE]><script type="text/javascript" src="<?php echo $soundmanager ?>script/excanvas.js"></script><![endif]-->

<!-- Apache-licensed animation library -->
<script type="text/javascript" src="<?php echo $soundmanager ?>script/berniecode-animator.js"></script>

<!-- the core stuff -->
<script type="text/javascript" src="<?php echo $soundmanager ?>script/soundmanager2.js"></script>
<script type="text/javascript" src="<?php echo $soundmanager ?>script/360player.js"></script>

<script type="text/javascript">
soundManager.url = '<?php echo $soundmanager ?>swf/'; // path to directory containing SM2 SWF
soundManager.useFastPolling = true; // increased JS callback frequency, combined with useHighPerformance = true
soundManager.metadataSeparator = '<br />';
soundManager.radioclashSpecialFeatures = true;
soundManager.radioclashSpecialRedirectUrl = '';
soundManager.radioclashSpecialFirstPlay = -1;

threeSixtyPlayer.config.hide360 = true;
threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
threeSixtyPlayer.config.autoPlay = false;
threeSixtyPlayer.config.playNext = true;
threeSixtyPlayer.config.divagSpecialFeatures = true;
threeSixtyPlayer.config.imageRoot = '<?php echo $soundmanager ?>css/';

</script>

	<!-- Lightbox -->
	<script type="text/javascript" src="<?php echo $lightbox ?>js/prototype.js"></script>
	<script type="text/javascript" src="<?php echo $lightbox ?>js/scriptaculous.js?load=effects"></script>
	<script type="text/javascript">
		var fileLoadingImage = "<?php echo $lightbox ?>css/loading.gif";
		var fileBottomNavCloseImage = "<?php echo $lightbox ?>css/closelabel.gif";
	</script>
	<script type="text/javascript" src="<?php echo $lightbox ?>js/lightbox.js"></script>
	<script type="text/javascript" src="js/jQuery/jquery-1.5.min.js"></script>
	<script type="text/javascript" src="js/my.js"></script>
	<link rel="stylesheet" href="<?php echo $lightbox ?>css/lightbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/mailing.css" type="text/css" media="screen" />

</head>
<body>
<?php
writeEntete('');
?>

<div class="pageContent">


<table class="maxSize">
	<tr>
		<td>
			<a href="<?php echo $linkLastEmission ?>" title="Emission <?php echo $texteLastEmission ?>">
				<img src="<?php echo $imageLastEmission ?>" alt="<?php echo $texteLastEmission ?>" style="border:0; width: 198px; height: 198px;" align="top" /><br />
				<span class="lienEmission"><?php echo $texteLastEmission ?></span>
			</a>
		</td>
		<td>
			<div class="texteAccueil">
				<p class="presentation">
					Une &quot;Radioclash&quot; est un mix de 60 minutes compos&eacute; de 4 ou 5 parties <br />
					de 12 &agrave; 15 minutes autour d'un THEME choisi &agrave; l'avance par VOUS <br />
					ou quelqu'un d'autre. <br />
					Pour participer ou proposer un th&egrave;me 24/24 c'est <a href="http://www.musiques-incongrues.net/forum/discussions" target="blank"><span>ICI</span></a> ce que vous voulez, <br />
					quand vous voulez.
				</p>
				<p class="historique">
					Ce projet est n&eacute; sur le forum <a href="http://www.musiques-incongrues.net" target="blank"><span>MUSIQUES INCONGRUES</span></a> sur une id&eacute;e d'Ogoun Ferraille.<br />
					Il est enti&egrave;rement participatif et interactif. Tout le monde est plus que bienvenu :<br />
					Pros ou pas, fille ou pas, robot ou pas, houmpa ou pas !<br />
					Plus de d&eacute;tails sur l'art et la mani&egrave;re ? Voir en page <a href="howto.php"><span>Mode d'emploi</span></a> 
				</p>
				<p class="presentation">
					<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=thisisradioclash', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
						Pour s'inscrire à la mailing-list, c'est ici :	
						<input type="text" style="width:200px;border:1px solid black;background-color:white;;color:black;" name="email"/>
						<input type="hidden" value="thisisradioclash" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
						<input type="submit" value="OK" style="width:30px;border:1px solid black;background-color:#EEEEEE;color:black;cursor:pointer;cursor:hand;" />
						<!--Delivered by <a href="http://feedburner.google.com" target="_blank">FeedBurner</a>-->
					</form>
				</p>	
				<p class="translate">
					<span class="red">PARDON OUR FRENCH : </span><a href="english.php"><span>English translation</span></a>
				</p>	
			</div>
		</td>
	<tr>
</table>
<br />

<table class="maxSize right">
	<tr>
		<td class="maxSize right top">
			<h2 class="gris">SOON ON AIR</h2>
			<ul class="listeEmissionsComingSoon">
			<?php 
			
			$videoTeasers = '';
			$nbVideoTeasers = 0;
			
			while($emission=mysql_fetch_array($listeEmissions))
			{
				$texteEmission = $emission['numero']." : ".$emission['titre'];
				
				if ($emission['date_sortie'] == "0000-00-00 00:00:00")
					$dateEmission = "...suspens...";
				else
					$dateEmission = date('d/m/Y', strtotime($emission['date_sortie']));
					
				$listeParticipantsEmission = listeParticipantsEmission($emission['id']);
				
				$teaserLinkStart = '';
				$teaserLinkEnd = '';
				
				if (emissionHaveTeaser($emission['numero']))
				{
					$nomParticipants = '';
					$nomFichierEmission = getNomFichierEmission($emission['numero'], $emission['titre'], '');
					//$nomParticipants = listeParticipantsEmission($emission['id']);
					//$nomFichierEmission = getNomFichierEmission($emission['numero'], $emission['titre'], $nomParticipants);

					$linkTeaser = $mp3s.$nomFichierEmission."-teaser.mp3";
					$teaserLinkStart = "<a href=\"".$linkTeaser."\" class=\"myShortcut\" cible=\"teaser-".$emission['numero']."\" target=\"blank\"><span class=\"linkTeaser\"><font class=\"red\">)) </font><font class=\"underline\">TEASER</font><font class=\"red\"> ((</font>>>>>> ";
					$teaserLinkEnd = "</span></a>";
					
					
					echo "<div class=\"sm2-inline-list\"><div class=\"ui360\">";
					echo "    <a id=\"teaser-".$emission['numero']."\" href=\"".$linkTeaser."\"><span></span></a>";
					echo "</div></div>";
				}
				
				echo "<li>";
				echo "  <span class=\"titre\">".$teaserLinkStart."<b>".$texteEmission."</b><font style=\"font-weight:normal;\"> avec</font>".$teaserLinkEnd."</span><br />";
				echo "  <span class=\"participants\">".$listeParticipantsEmission."</span><br />";
				echo "  <span class=\"sortie\">Publication : ".$dateEmission."</span>";
				echo "</li>";
				
				//if ($nbVideoTeasers == 0 && $emission['teaser_video'] != '')
				if ($emission['teaser_video'] != '')
				{
					$videoTeasers .= "<object width=\"265\" height=\"200\">\n";
					$videoTeasers .= "	<param name=\"movie\" value=\"".$emission['teaser_video']."\"></param>\n";
					$videoTeasers .= "	<param name=\"allowFullScreen\" value=\"true\"></param>\n";
					$videoTeasers .= "	<param name=\"allowscriptaccess\" value=\"always\"></param>\n";
					$videoTeasers .= "	<embed src=\"".$emission['teaser_video']."\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"265\" height=\"200\"></embed>\n";
					$videoTeasers .= "</object>\n";
					$videoTeasers .= "<br />\n";
					
					$nbVideoTeasers++;
				}
			}
			?>
			</ul>
		</td>
		<td class="imageNews">		
			<?php 
			
			if ($videoTeasers != '')
				echo $videoTeasers;
				
			if ($contenuImageNews != 0)
				echo "<img src=\"".$lienImageNews."\" />";
			
			?>
		</td>
	</tr>
</table>

<h2 class="gris">Don't HATE The Radioclash, <i>BE The Radioclash !</i></h2>
<p>They are, they were, they will be so far : 
<span class="italique"><?php echo $listeParticipants ?></span> &amp; YOU !</p>

<h2 class="gris">Articles, diffusions hertziennes, rebonds...</i></h2>
<div class="listeLiens">
	<a href="http://www.cannibalcaniche.com" title="Click to visit the Cannibal Caniche Radio website"><img src="css/logo_cannibalcaniche.gif" alt="Cannibal Caniche"/></a>
	<a href="http://www.jetfm.asso.fr/site/-Festival-sonor-.html" title="Click to visit the SONOR Festival website"><img src="css/logo_festival_sonor_2011.gif" alt="Festival SONOR"/></a>
	<a href="http://www.jetfm.asso.fr" title="Click to visit the JET FM Radio website"><img src="css/logo_jetfm.gif" alt="Jet FM"/></a>
	<a href="http://www.48fm.fr" title="Click to visit the 48 FM Radio website"><img src="css/logo_48fm.gif" alt="48 FM"/></a>
	<a href="http://www.campusfm.fr" title="Click to visit the Toulouse Radio Campus website"><img src="css/logo_radiocampus_toulouse.gif" alt="Radio Campus Toulouse"/></a>
	<a href="http://www.radiogalere.org" title="Click to visit the Radio Galere website"><img src="css/logo_radiogalere.gif" alt="Radio Galere"/></a>
	<a href="http://radiocampus.ulb.ac.be" title="Click to visit the Bruxelles Radio Campus website"><img src="css/logo_radiocampus_bruxelles.gif" alt="Radio Campus Bruxelles"/></a>
	<a href="http://radiopaysdegueret.fr" title="Click to visit the Radio RPG website"><img src="css/logo_radiorpg.gif" alt="Radio RPGRadio RPG"/></a>
	<a href="css/articleliberation.jpg" rel="lightbox" title="Click to see press article talking about ThisIsRadioclash !" rev="css/articleliberation.jpg"><img src="css/logo_liberation.gif" alt="Logo Liberation" /></a>
</div>

<?php
writePiedDePage('');


echo "<div class=\"sm2-inline-list\"><div class=\"ui360\">";
echo "    <a href=\"blank.mp3\"><span></span></a>";
echo "</div></div>";

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
