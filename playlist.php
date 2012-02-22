<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

if ($_GET["episode"] == null)
	echo "<script>window.location.href = '".$radioclashHome."';</script>";
else
{
	define ('RE_INT','^[0-9]+$');
	if (!@ereg(RE_INT,$_GET["episode"]))
		echo "<script>window.location.href = '".$radioclashHome."';</script>";
	else
	{
		$numero = $_GET["episode"];
		$emission = dbGetEmissionByNumero($id_site, $numero);
		
		if ($emission == 0 || ($emission['etat'] != 3 && $_GET["preview"] == null))
		{
			echo "<script>window.location.href = '".$radioclashHome."';</script>";
		}
		else
		{
			$idEmission = $emission['id'];
			$nomParticipants = listeParticipantsEmission($emission['id']);
			$nomEmission = getReferenceEmission($numero, $emission['titre'], $nomParticipants);
			$nomFichierEmission = getNomFichierEmission($numero, $emission['titre'], $nomParticipants);
			
			if (file_exists($pics.$nomFichierEmission.".gif"))
				$imageEmission = $pics.$nomFichierEmission.".gif";
			else
				$imageEmission = $pics.$nomFichierEmission.".jpg";
			
			if (file_exists($pics.$nomFichierEmission."-toPrint.jpg"))
				$imageEmissionPrint = $pics.$nomFichierEmission."-toPrint.jpg";
			else
				$imageEmissionPrint = $pics.$nomFichierEmission.".jpg";

			$audioEmission = $mp3s.$nomFichierEmission.".mp3";
			
			if ($_GET["preview"] == null)
			{
				$zipEmission = $zips.$nomFichierEmission.".zip";
				$hideZipEmission = "";
			}
			else
			{
				$zipEmission = "";
				$hideZipEmission = "style='display:none;'";
			}
			$linkEmission = "playlist.php?episode=".$numero;
			$playlist = dbGetPlaylist($idEmission);
			$nextEmission = dbGetNextEmission($id_site, $numero);
			
			$linkEmissionAutoRedirect = "playlist.php?episode=".$nextEmission['numero']."&auto=1";
			
			$auto = "false";
			$firstPlay = 0;
			if ($_GET["auto"] != null)
			{
				$auto = "true";
			}
			else
			{
				if (emissionHaveTeaser($numero))
					$firstPlay = 1;
			}
		}
	}
}
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

<!-- Opengraph tags (@see http://ogp.me/) -->
<meta property="og:site_name" content="This is Radioclash" />
<meta property="og:title" content="<?php echo $nomEmission ?> | This is Radioclash" />
<meta property="og:image" content="http://www.thisisradioclash.org/<?php echo $imageEmission ?>" />
<meta property="og:audio" content="http://www.thisisradioclash.org/<?php echo $audioEmission ?>" />
<meta property="og:audio:title" content="This is Radioclash - <?php echo $nomEmission ?>" />
<meta property="og:audio:artist" content="<?php echo $nomParticipants ?>" />
<meta property="og:audio:album" content="This is Radioclash" />
<meta property="og:audio:type" content="application/mp3" />

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
soundManager.radioclashSpecialRedirectUrl = '<?php echo $linkEmissionAutoRedirect ?>';
soundManager.radioclashSpecialFirstPlay = <?php echo $firstPlay ?>;

threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
threeSixtyPlayer.config.autoPlay = <?php echo $auto ?>;
threeSixtyPlayer.config.playNext = true;
threeSixtyPlayer.config.showHMSTime = true;
// enable some spectrum stuffs
threeSixtyPlayer.config.useWaveformData = true;
threeSixtyPlayer.config.useEQData = true;
threeSixtyPlayer.config.divagSpecialFeatures = true;
threeSixtyPlayer.config.imageRoot = '<?php echo $soundmanager ?>css/';

// enable this in SM2 as well, as needed
if (threeSixtyPlayer.config.useWaveformData) {
  soundManager.flash9Options.useWaveformData = true;
}
if (threeSixtyPlayer.config.useEQData) {
  soundManager.flash9Options.useEQData = true;
}
if (threeSixtyPlayer.config.usePeakData) {
  soundManager.flash9Options.usePeakData = true;
}
</script>

	<!-- Lightbox -->
	<script type="text/javascript" src="<?php echo $lightbox ?>js/prototype.js"></script>
	<script type="text/javascript" src="<?php echo $lightbox ?>js/scriptaculous.js?load=effects"></script>
	<script type="text/javascript">
		var fileLoadingImage = "<?php echo $lightbox ?>css/loading.gif";
		var fileBottomNavCloseImage = "<?php echo $lightbox ?>css/closelabel.gif";
	</script>
	<script type="text/javascript" src="<?php echo $lightbox ?>js/lightbox.js"></script>
	
	<link rel="stylesheet" href="<?php echo $lightbox ?>css/lightbox.css" type="text/css" media="screen" />

	<link rel="stylesheet" type="text/css" href="css/thisisradioclash.css" />

</head>

<body>

<?php
writeEntete('playlist');
?>

<div class="pageContent">

  <table cellspacing="4" cellpadding="0" class="maxSize">
    <tr>
		<td class="top playerCell">
			<a href="<?php echo $imageEmissionPrint ?>" rel="lightbox" title="Click to download/print the cover" rev="<?php echo $imageEmissionPrint ?>"><img src="<?php echo $imageEmission ?>" width="270" height="270" border="0" /></a>
			<div class="center">
			<?php 
				if (emissionHaveTeaser($numero))
				{
					$linkTeaser = $mp3s.$nomFichierEmission."-teaser.mp3";

					echo "<div class=\"sm2-inline-list\">";
					echo "    <div class=\"ui360\"><a id=\"teaser\" href=\"".$linkTeaser."\"><span style=\"color:red;text-decoration:underline;font-weight:bolder;margin-top:50px;\">>> TEASER <<</span></a></div>";
					echo "</div>";
				}
			?>
			<div class="sm2-inline-list sm2-inline-list-first">
				<div class="ui360"><a id="lecteur" href="<?php echo $audioEmission ?>"><span style="color:red;text-decoration:underline;font-weight:bolder;margin-top:50px;">ON AIR :</span></a>
				<div class="metadata">
				<div class="duration"><?php echo toTime($emission['time_min']).":".toTime($emission['time_sec']) ?></div> <!-- total track time (for positioning while loading, until determined -->
				<ul>
					<li><p>This is Radioclash Jingle</p><span>00:00</span></li>
					<?php 
					 while($array=mysql_fetch_array($playlist))
						echo "<li><p>".strtoupper($array['nom_utilisateur'])."<br />".$array['nom_artiste']." - ".$array['nom_morceau']."</p><span>".toTime($array['time_min']).":".toTime($array['time_sec'])."</span></li>\n";
					?>
				</ul>
			   </div>
				</div>
			</div>
			<div class="sm2-inline-list">
				<div class="ui360"><a href="mp3/thisisradioclash-transition.mp3"><span style="color:red;text-decoration:underline;font-weight:bolder;margin-top:50px;">[[ CHANGEMENT DE PROGRAMME ]]</span></a></div>
			</div>
		</div>
	</td>
	<td class="top playlistCell">
		<h2 class="titreEmission">
			<a class="myShortcut" cible="lecteur"><span class="nomEmission"><font>&nbsp;<?php echo $nomEmission ?>&nbsp;</font></span></a><span class="mp3link"> (<a href="<?php echo $audioEmission ?>" target="blank"><span class="red gras">MP3</span></a><span <?php echo $hideZipEmission ?>> - <a href="<?php echo $zipEmission ?>" target="blank"><span class="red gras">ZIP</span></a></span>)</span>
		</h2>
		
		<span class="metadataShortCut" id="lecteurmetadataShortCut0">00:00 This is radioclash - Introduction Jingle</span><br />
		<?php 
		$playlist = dbGetPlaylist($idEmission);
		$nomUtilisateurEnCours = "";
		$chef = dbGetChefEmission($idEmission);
		$i = 1;
		while($array=mysql_fetch_array($playlist))
		{
			if ($nomUtilisateurEnCours != strtoupper($array['nom_utilisateur']))
			{
				$utilisateurEnCours = dbGetUtilisateur($array['nom_utilisateur']);
				$nomUtilisateurEnCours = strtoupper($array['nom_utilisateur']);

				if ($utilisateurEnCours['url_site'] != "http://" && $utilisateurEnCours['url_site'] != "")
					echo "<a href=\"".$utilisateurEnCours['url_site']."\"><span>".$nomUtilisateurEnCours."</span></a><br />\n";
				else
					echo "<span><strong><u>".$nomUtilisateurEnCours."</u></strong></span></a><br />\n";
			}
			echo "<span class=\"metadataShortCut\" id=\"lecteurmetadataShortCut".$i."\">".getNomMorceauEmission(toTime($array['time_min']), toTime($array['time_sec']), $array['nom_artiste'], $array['nom_morceau'], $array['nom_label'], $array['annee'])."</span><br />\n";
			$i++;
		}
		
		echo "<br />";
		if ($chef != '')
		echo "<p class=\"gris italique\">Une &eacute;mission pr&eacute;sid&eacute;e par ".$chef.".</p>";
		echo "<br />";
		
		if (emissionHaveTeaser($numero) || $emission['teaser_video'] != '')
		{
			$linkTeaser = $mp3s.$nomFichierEmission."-teaser.mp3";
			echo "<h2>R.I.P. teasers :</h2>";
			
			if (emissionHaveTeaser($numero))
				echo "<a href=\"".$linkTeaser."\" class=\"myShortcut\" cible=\"teaser\" target=\"blank\"><span class=\"linkTeaser\"><font class=\"red\">)) </font><font class=\"underline\">TEASER - This is radioclash ".$nomEmission."</font><font class=\"red\"> ((</font></span></a>";
			
			if (emissionHaveTeaser($numero) && $emission['teaser_video'] != '')
				echo "<br /><br />";
			
			if ($emission['teaser_video'] != '')
			{
				echo "<object width=\"400\" height=\"350\">";
				echo "	<param name=\"movie\" value=\"".$emission['teaser_video']."\"></param>";
				echo "	<param name=\"allowFullScreen\" value=\"true\"></param>";
				echo "	<param name=\"allowscriptaccess\" value=\"always\"></param>";
				echo "	<embed src=\"".$emission['teaser_video']."\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"400\" height=\"350\"></embed>";
				echo "</object>";
			}
		}

		
		?>
	</td>
</tr>
</table>
<?php
writePiedDePage('playlist');
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
