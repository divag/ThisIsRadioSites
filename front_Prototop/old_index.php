<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');

//Récupération de la liste des émissions :
$listeEmissions = dbGetListeEmissions($id_site);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
	echo "<meta name=\"author\" content=\"Prototop &amp; Divag\" />\n";
	echo "<meta name=\"keywords\" content=\"prototop, radio, music, crotal, torturo, musique, émission, radioshow, mix, free mp3, musiques incongrues\" />\n";
	echo "<meta name=\"description\" content=\"Prototop radioshows and more.\" />\n";
	echo "<meta name=\"robots\" content=\"all\" />\n";
	echo "<title>.::: prototop.be :::.</title>";
	echo "<link rel=\"shortcut icon\" type=\"image/png\" href=\"css/favicon.png\" />\n";
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"".$lienPodcast."\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/prototop.css\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mailing.css\" />\n";
?>

<!-- required -->
<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>css/360player.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>css/360player-visualization.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>css/360divagSpecialFeatures.css" />
<style>
/* Styles for divag speciel features */

.sm2-inline-list {
 display:none;
}

.sm2-inline-list-first {
 display:block;
}

.myShortcut {
color:black;
text-decoration:none;
}

.myShortcut span {
	padding-left: 23px;
}

.myShortcutPlaying {
/*color:red;*/
text-decoration:none;
}
.myShortcutPaused{
/*color:red;*/
font-style:italic;
}

.myShortcut {
cursor:pointer;
}

.myShortcut span {
background-position:left -3px;
background-repeat:no-repeat;
height:30px;
background-image:url(css/player/button-play.png);
}
.myShortcut span:hover {
background-image:url(css/player/button-play-light.png);
}
.myShortcutPlaying span {
background-image:url(css/player/button-play-light.png);
}
.myShortcutPlaying span:hover {
background-image:url(css/player/button-pause-light.png);
}
.myShortcutPaused span {
background-image:url(css/player/button-pause.png);
}
.myShortcutPaused span:hover {
background-image:url(css/player/button-play-light.png);
}

.mp3link a {
	color:black;
	text-decoration:underline;
}

.presentation {
	font-weight:normal;
}

</style>

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
soundManager.radioclashSpecialFirstPlay = true;

threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
threeSixtyPlayer.config.autoPlay = false;
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
</head>
<body>
<a name="1"></a>
<div id="dsr">
</div>
<div id="container">
	<div id="content">
	<span class="workInProgress">
	<?php 
		$contenuEntete = dbGetContenuPageSite($id_site, 'index', 'texte_entete_site');
		if ($contenuEntete != 0)
		{
			echo $contenuEntete['contenu_fr']."\n";
		}
	?>
		<br />Pour s'inscrire au <a href="<?php echo $lienPodcast; ?>">podcast</a> par mail, cliquez <a href="#" onclick="window.open('http://feedburner.google.com/fb/a/mailverify?uri=Prototop', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">ici</a>.
	</span>
	<!--
	<span class="workInProgress">Bonjour et bienvenue sur l'Internet.<br /><br />Ce site est en cours de construction. <br />En attendant, voici tout de même les émissions :</span>
	-->
	<ul>
		<?php 
			$iEmission = 0;
			while($emission=mysql_fetch_array($listeEmissions))
			{
				$idEmission = $emission['id'];
				$texteEmission = $nomSite." ".getReferenceEmission($emission['numero'], null, null);
				
				$nomFichierEmission = getNomFichierEmission($emission['numero'], null, null);
				$imageEmission = $pics.$nomFichierEmission.".jpg";
				$mp3Emission = $mp3s.$nomFichierEmission.".mp3";
				$zipEmission = $zips.$nomFichierEmission.".zip";
				$playlist = dbGetPlaylist($idEmission);
				$playlistForTiming = dbGetPlaylist($idEmission);
				
				echo "<li>";
				if ($emission['etat'] == 3 || $_GET["preview"] != null)
				{ 
					echo "<div style=\"visibility:hidden;display:none;\">";
					//echo "<div>";
					if ($iEmission == 0)
						echo "  <div class=\"sm2-inline-list sm2-inline-list-first\">";
					else
						echo "  <div class=\"sm2-inline-list\">";
					
					echo "    <div class=\"ui360\"><a id=\"lecteur".$iEmission."\" href=\"".$mp3Emission."\"><span style=\"color:red;text-decoration:underline;font-weight:bolder;margin-top:50px;\">ON AIR :</span></a>";
					echo "  	<div class=\"metadata\">";
					echo "  	  <div class=\"duration\">".toTime($emission['time_min']).":".toTime($emission['time_sec'])."</div> <!-- total track time (for positioning while loading, until determined -->";
					echo "          <ul>";
					
					while($array=mysql_fetch_array($playlistForTiming))
						echo "<li><p>".$array['nom_artiste']." - ".$array['nom_morceau']."</p><span>".toTime($array['time_min']).":".toTime($array['time_sec'])."</span></li>\n";
						
					echo "          </ul>";
					echo "        </div>";
					echo "  	</div>";
					echo "  </div></div>";
					if ($iEmission != 0)
						echo "<br /><a name=\"".($iEmission+1)."\"></a>";
					echo "  <h3><a class=\"myShortcut\" cible=\"lecteur".$iEmission."\"><span class=\"nomEmission\"><font>&nbsp;".$texteEmission."&nbsp;</font></span></a><span class=\"mp3link\"> (<a href=\"".$mp3Emission."\" target=\"blank\"><span class=\"black\">Download MP3</span></a>)</h3>";
					
					if ($emission['id_contenu_texte'] != '')
					{
						$contenuTexteEmission = dbGetContenu($emission['id_contenu_texte']);
						$presentationEmission = $contenuTexteEmission['contenu_fr'];

						if ($presentationEmission != '')
							echo "<span class=\"presentation\">".$presentationEmission."</span>";
					}
					//echo "  <a href=\"".$mp3Emission."\">";
					//echo "    <h3><span class=\"lienEmission\"><b>".$texteEmission."</b></span> (cliquez ici pour télécharger l'émission à partir de l'Internet)</h3>";
					//echo "  </a>";
					
					echo "  <table><tr><td>";
					echo "  <img src=\"".$imageEmission."\" title=\"".$texteEmission."\"/><br />";
					echo "  </td><td>";
					
					$i = 0;
					while($array=mysql_fetch_array($playlist))
					{
						echo "<span class=\"metadataShortCut\" id=\"lecteur".$iEmission."metadataShortCut".$i."\">".getNomMorceauEmission(toTime($array['time_min']), toTime($array['time_sec']), $array['nom_artiste'], $array['nom_morceau'], $array['nom_label'], $array['annee'])."</span><br />\n";
						$i++;
					}
					echo "  </td></tr></table>";
				}
				echo "</li>";
				$iEmission++;
			}
		?>
	</ul>
	</div>
</div>
<div style="height:400px"></div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28345251-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
