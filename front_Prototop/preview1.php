<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');

//Récupération de la liste des émissions :
$listeEmissions = dbGetListeEmissionsByDate($id_site);

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
	echo "<link rel=\"shortcut icon\" type=\"image/png\" href=\"css/favicon.ico\" />\n";
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"".$lienPodcast."\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/prototop.css\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mailing.css\" />\n";
?>

	<!-- required -->
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/divagSpecialFeatures.css" />

	<!-- special IE-only canvas fix -->
	<!--[if IE]><script type="text/javascript" src="<?php echo $soundmanager ?>script/excanvas.js"></script><![endif]-->

	<!-- Page player core CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/page-player.css" />
	<!-- soundManager.useFlashBlock: related CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/flashblock/flashblock.css" />
	<!-- optional: annotations/sub-tracks/notes, and alternate themes -->
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/optional-annotations.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/optional-themes.css" />
	<!--
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/prototopPlayerStyle.css" />
	-->
	<!-- soundManager API -->
	<script src="<?php echo $soundmanager ?>demo/script/soundmanager2.js"></script>

	<script>

	/* --------

	  Config override: This demo uses shiny flash 9 stuff, overwriting Flash 8-based defaults
	  Alternate PP_CONFIG object must be defined before soundManager.onready()/onload() fire.
	  Alternately, edit the config in page-player.js to simply use the values below by default

	-------- */

	// demo only, but you can use these settings too..
	soundManager.flashVersion = 9;
	soundManager.preferFlash = true; // for visualization effects
	soundManager.useHighPerformance = true; // keep flash on screen, boost performance
	soundManager.wmode = 'transparent'; // transparent SWF, if possible
	soundManager.useFastPolling = true; // increased JS callback frequency
	soundManager.url = '<?php echo $soundmanager ?>demo/swf/';
	soundManager.metadataSeparator = '<br />>> ';
	soundManager.radioclashSpecialFeatures = true;
	soundManager.radioclashSpecialRedirectUrl = '';
	soundManager.radioclashSpecialFirstPlay = true;

	// custom page player configuration

	var PP_CONFIG = {
	  divagSpecialFeatures: true,
	  autoStart: false,      // begin playing first sound when page loads
	  playNext: true,        // stop after one sound, or play through list until end
	  useThrottling: false,  // try to rate-limit potentially-expensive calls (eg. dragging position around)</span>
	  usePeakData: true,     // [Flash 9 only] whether or not to show peak data (left/right channel values) - nor noticable on CPU
	  useWaveformData: false,// [Flash 9 only] show raw waveform data - WARNING: LIKELY VERY CPU-HEAVY
	  useEQData: false,      // [Flash 9 only] show EQ (frequency spectrum) data
	  useFavIcon: false,     // try to apply peakData to address bar (Firefox + Opera) - performance note: appears to make Firefox 3 do some temporary, heavy disk access/swapping/garbage collection at first(?) - may be too heavy on CPU
	  useMovieStar: true     // Flash 9.0r115+ only: Support for a subset of MPEG4 formats.
	}

	</script>
	<!-- Page player main script -->
	<script src="<?php echo $soundmanager ?>demo/script/page-player.js"></script>
	<!-- optional: Metadata UI prototype (not needed unless you want the bottom-most demo bits) -->
	<script src="<?php echo $soundmanager ?>demo/script/optional-page-player-metadata.js"></script>



	<!-- Lightbox -->
	<script type="text/javascript" src="<?php echo $lightbox ?>js/prototype.js"></script>
	<script type="text/javascript" src="<?php echo $lightbox ?>js/scriptaculous.js?load=effects"></script>
	<script type="text/javascript">
		var fileLoadingImage = "<?php echo $lightbox ?>css/loading.gif";
		var fileBottomNavCloseImage = "<?php echo $lightbox ?>css/closelabel.gif";
	</script>
	<script type="text/javascript" src="<?php echo $lightbox ?>js/lightbox.js"></script>
	<script type="text/javascript" src="js/jQuery/jquery-1.5.min.js"></script>
	
	<link rel="stylesheet" href="<?php echo $lightbox ?>css/lightbox.css" type="text/css" media="screen" />

	<link rel="stylesheet" type="text/css" href="css/prototop.css" />
<style>

body {
	margin-bottom:0px;
	padding-bottom:0px;
	border-color:black;
	border-style:solid;
	border-width:0px;
	border-top-width:1px;
	border-bottom-width:1px;
}

ul.playlist li
{
	-moz-border-radius:6px;
	-khtml-border-radius:6px;
	border-radius:6px;
	background-color:rgb(168,211,87);
}


li.itemEmission
{
	background-color:rgb(10,56,54);
	-moz-border-radius:6px;
	-khtml-border-radius:6px;
	border-radius:6px;
	margin-bottom:15px;
}

li.itemAutre
{
	padding:15px;
	text-align:center;
	color:black;
	background-color:rgb(168,211,87);
}

li.itemFooter
{
	color:rgb(168,211,87);
	background-color:rgb(10,56,54);
}

li.itemHeader
{
	color:rgb(168,211,87);
	background-color:rgb(10,56,54);
}
.titreSite {
	font-size:40px;
}

li.siteHeader {
	padding:15px;
	padding-top: 0px;
	background-color:black;
}

div.prototopLinks {
	width:170px;
	float:left;
	text-align:left;
}

ul.prototopLinks {
	list-style-type:none;
	padding-left:10px;
}

ul.prototopLinks a {
	text-decoration:none;
}

ul.prototopLinks a img {
	position:relative;
	top:2px;
	height:16px;
	width:16px;
}

img.icon {
	position:relative;
	top:3px;
	height:16px;
	width:16px;
}

ul.prototopLinks li a span {
	padding-left:5px;
}

#container {
	border-color: rgb(0, 0, 0);
	background-color: transparent;
	border-width:0px;
	margin-bottom:0px;
	padding-bottom:0px;
}

#content {
	background-color:black;
	border-color:black;
	border-style:solid;
	border-width:7px;
	border-bottom-width:0px;
	margin-bottom:0px;
	padding-bottom:0px;
}

.friensLinksContainer {
	width:170px;
	text-align:right;
	float:right;
}

.friendLinks
{
	float:right;
	text-align:left;
}

.friendLinks ul
{
	padding-left:20px;
}

.friendLinks p
{
	padding:0px;
	margin:0px;
}

.itemFooter p
{
	padding:0px;
	margin:0px;
}

.titreNews
{
	font-size:24px;
	background-color:rgb(10,56,54);
	-moz-border-radius:6px;
	-khtml-border-radius:6px;
	border-radius:6px;
	background-color:rgb(168,211,87);
	padding:15px;
	font-family:Arial, Helvetica, sans-serif; /**/
	font-family:	sans-serif;
	font-size:	28.8px;
	font-weight:	400;
	font-style:	normal;
	font-size-adjust:	none;
	color:	#000000;
	text-transform:	none;
	text-decoration:	none;
	letter-spacing:	-1px;
	word-spacing:	0;
	line-height:	34px;
	text-align:	left;
	vertical-align:	baseline;
	direction:	ltr;
	text-overflow:	clip;
	padding-top:	6px;
	padding-right:	12px;
	padding-bottom:	6px;
	padding-left:	12px;
}

li.itemNews
{
	padding:0px;
	background-color:rgb(10,56,54);
	text-align:left;	
}
.itemNews .presentation
{
	padding:15px;
	color:rgb(168,211,87);
	font-weight:normal;
}

.itemNews p
{
	padding:0px;
	margin:0px;
}
.itemMenu {
	padding:10px;
	text-align:center;
	margin-top:-5px;
}
.separator {
	margin:0px;
	padding:0px;
	padding-left:7px;
	padding-right:7px;
	color:#666666;
}
.itemMenuEntete {
	-moz-border-radius:0px;
	-khtml-border-radius:0px;
	border-radius:0px;

}

.currentItem {
	text-decoration:none;
}

</style>
<script language="javascript">
	function showContenu (item) {
	
		$('li.menuLiensContenu a').css('text-decoration', 'underline');
		$('a.lien' + item).css('text-decoration', 'none');
	
		$('ul.contenu').toggle();
		
		$('ul.contenu li.noItem').hide();
		
		if (item == 'all')
		{
			$('ul.contenu li.item').show();
		}
		else
		{
			$('ul.contenu li.item').hide();
			
			if ($('ul.contenu li.' + item).length == 0)
				$('ul.contenu li.no' + item).show();
			else
				$('ul.contenu li.' + item).show();
		}
		
		$('ul.contenu').toggle();
	}
	
	$(document).ready(function () {
		showContenu ('all');
	});
	
</script>

</head>
<body name="top">
<div id="container">
	<div id="content">
		<ul class="listeEmissions">
			
			<!-- Exemple de menu horizontal -->	
<!--			
			<li class="itemEmission itemMenu itemMenuEntete">
				<?php
					echo "<a href=\"".$lienPodcast."\" class=\"exclude\"><span>PODCAST / RSS</span></a>";
					echo "<span class=\"separator\">|</span>";
					echo "<a href=\"".$lienFacebook."\" class=\"exclude\"><span>FACEBOOK</span></a>";
					echo "<span class=\"separator\">|</span>";
					echo "<a href=\"#\" class=\"exclude\" onclick=\"window.open('http://feedburner.google.com/fb/a/mailverify?uri=Prototop', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true\">MAILING-LIST</a>";
					echo "<span class=\"separator\">|</span>";
					echo "<a href=\"".$lienTwitter."\" class=\"exclude\"><span>TWITTER</span></a>";
					echo "<span class=\"separator\">|</span>";
					echo "<a href=\"".$lienForum."\" class=\"exclude\"><span>ANANAS LAND</span></a>";
				?>
			</li>
-->
			<!-- Entete -->
			<li class="itemEmission itemAutre itemHeader siteHeader">
				<div class="prototopLinks">
					<ul class="prototopLinks">
						<?php
							echo "<li><a href=\"".$lienFacebook."\" class=\"exclude\"><img src=\"css/facebook.ico\" width=\"16\" heigth=\"16\" />&nbsp;<span>FACEBOOK</span></a></li>";
							echo "<li><a href=\"".$lienForum."\" class=\"exclude\"><img src=\"css/musiques_incongrues.png\" width=\"16\" heigth=\"16\" />&nbsp;<span>FORUM</span></a></li>";
							echo "<li><a href=\"".$lienPodcast."\" class=\"exclude\"><img src=\"css/rss.png\" width=\"16\" heigth=\"16\" />&nbsp;<span>PODCAST / RSS</span></a></li>";
							echo "<li><a href=\"#\" class=\"exclude\" onclick=\"window.open('http://feedburner.google.com/fb/a/mailverify?uri=Prototop', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true\"><img src=\"css/email.png\" width=\"16\" heigth=\"16\" />&nbsp;<span>MAILING-LIST</span></a></li>";
							echo "<li><a href=\"".$lienTwitter."\" class=\"exclude\"><img src=\"css/twitter.ico\" width=\"16\" heigth=\"16\" />&nbsp;<span>TWITTER</span></a></li>";
						?>
					</ul>
				</div>
				<div class="friensLinksContainer">
					<div class="friendLinks">
						<?php
						$contenuLiens = dbGetContenuPageSite($id_site, 'index', 'liens');
						if ($contenuLiens != 0)
						{
							echo $contenuLiens['contenu_fr']."\n";
						}
						?>
					</div>
				</div>
				<div>
					<br />
					<img src="css/prototop.jpg" alt="Prototop" align="center" width="350" />
					<br />
					<span class="accrocheSite">Idioten Music Since 2009</span>
				</div>
				<br style="clear:both;"/>
			</li>			
			
			<!-- Menu -->
			<li class="itemEmission itemMenu menuLiensContenu">
				<a href="#top" title="Voir tout" onclick="javascript:showContenu('all');" class="lienall">TOUT</a>			
				<span class="separator">|</span>
				<a href="#top" title="Voir les news" onclick="javascript:showContenu('news');" class="liennews">NEWS</a>
				<span class="separator">|</span>
				<a href="#top" title="Voir les mixes" onclick="javascript:showContenu('mixes');" class="lienmixes">MIXES</a>
				<span class="separator">|</span>
				<a href="#top" title="Voir les bonus" onclick="javascript:showContenu('bonus');" class="lienbonus">BONUS</a>
			</li>
		</ul>
		<ul class="listeEmissions contenu">
			<!-- Exemple de news / bonus -->
			<li class="itemEmission itemAutre itemNews item news">
				<div class="titreNews">
				<?php
					$contenuEntete = dbGetContenuPageSite($id_site, 'index', 'titre_entete_site');
					if ($contenuEntete != 0)
					{
						echo $contenuEntete['contenu_fr']."\n";
					}
				?>
				</div>
				<div class="presentation">
				<?php
					$contenuEntete = dbGetContenuPageSite($id_site, 'index', 'texte_entete_site');
					if ($contenuEntete != 0)
					{
						echo $contenuEntete['contenu_fr']."\n";
					}
				?>
				</div>
			</li>

			<!-- Mixes -->
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
					$commentsEmission = $emission['url_lien_forum'];
					$playlist = dbGetPlaylist($idEmission);
					$playlistForTiming = dbGetPlaylist($idEmission);
					
					echo "<li class=\"itemEmission item mixes\">";
					if ($emission['etat'] == 3 || $_GET["preview"] != null)
					{ 
					echo "<a name=\"".$emission[numero]."\"></a>";

						echo "  <div>";
						echo "<ul class=\"playlist\"><li>";
						echo "    <a id=\"lecteur".$iEmission."\" href=\"".$mp3Emission."\"><span class=\"titre\">".$texteEmission."</span><span style=\"font-size:smaller;font-weight:normal;color:gray;\"> (Click to start/stop listening)</span></a>";
						echo "    <div class=\"metadata\">";
						echo "      <div class=\"duration\">".toTime($emission['time_min']).":".toTime($emission['time_sec'])."</div> <!-- total track time (for positioning while loading, until determined -->";
						echo "      <ul>";
						
						while($array=mysql_fetch_array($playlistForTiming))
							echo "        <li><p>".$array['nom_artiste']." - ".$array['nom_morceau']."</p><span>".toTime($array['time_min']).":".toTime($array['time_sec'])."</span></li>\n";
							
						echo "      </ul>";
						echo "    </div>";

						echo "  </li></ul></div>";

						if ($emission['id_contenu_texte'] != '')
						{
							$contenuTexteEmission = dbGetContenu($emission['id_contenu_texte']);
							$presentationEmission = $contenuTexteEmission['contenu_fr'];

							if ($presentationEmission != '')
								echo "<span class=\"presentation\">".$presentationEmission."</span>";
						}
						
						echo "  <table><tr><td style=\"text-align:center;\">";
						echo "	<a href=\"".$imageEmission."\" rel=\"lightbox\" title=\"Click to download/print the cover\" rev=\"".$imageEmission."\"><img src=\"".$imageEmission."\" width=\"346\" height=\"346\" border=\"0\" /></a>";
						
						echo "<br /><br /><a href=\"".$commentsEmission."\" class=\"exclude\" target=\"blank\"><span>COMMENTAIRES</span></a>";
						echo "<span class=\"separator\">|</span><a href=\"".$mp3Emission."\" class=\"exclude\" target=\"blank\"><span>DOWNLOAD MP3</span></a>";
						echo "<span class=\"separator\">|</span><a href=\"".$zipEmission."\" class=\"exclude\" target=\"blank\"><span>DOWNLOAD ZIP</span></a>";
						//echo "<br /><br /><img src=\"css/musiques_incongrues.png\" alternate=\"\" title=\"\" class=\"icon\" /><a href=\"".$commentsEmission."\" class=\"exclude\" target=\"blank\"><span>COMMENTAIRES</span></a>";
						//echo "<span class=\"separator\">|</span><img src=\"css/download_icon.png\" alternate=\"\" title=\"\" class=\"icon\" /><a href=\"".$mp3Emission."\" class=\"exclude\" target=\"blank\"><span>MP3</span></a>";
						//echo "<span class=\"separator\">|</span><img src=\"css/zip_icon.png\" alternate=\"\" title=\"\" class=\"icon\" /><a href=\"".$zipEmission."\" class=\"exclude\" target=\"blank\"><span>ZIP</span></a>";

						echo "  </td><td>";
						
						$i = 0;
						while($array=mysql_fetch_array($playlist))
						{
							if ($i == 0 && (toTime($array['time_min']) != "00" || toTime($array['time_sec']) != "00"))
							{
								echo "<span class=\"metadataShortCut\" id=\"lecteur".$iEmission."metadataShortCut".$i."\">00:00 Prototop - Intro</span><br />\n";
								$i++;
							}
							echo "<span class=\"metadataShortCut\" id=\"lecteur".$iEmission."metadataShortCut".$i."\">".getNomMorceauEmission(toTime($array['time_min']), toTime($array['time_sec']), $array['nom_artiste'], $array['nom_morceau'], $array['nom_label'], $array['annee'])."</span><br />\n";
							$i++;
						}
						echo "  </td></tr></table><br />";
					}
					echo "</li>";
					$iEmission++;
				}
			?>
			
			<!-- Zones vides -->
			<li class="itemEmission itemAutre itemFooter noItem nonews">
				<br />
				<br />
				Aucune news n'est disponible pour le moment.
				<br />
				<br />
				<br />
			</li>
			<li class="itemEmission itemAutre itemFooter noItem nobonus">
				<br />
				<br />
				Aucun bonus n'est disponible pour le moment.
				<br />
				<br />
				<br />
			</li>

			<!-- Pied de page -->
			<li class="itemEmission itemAutre itemFooter">
				<span class="presentation">
				<?php
					$contenuFooter = dbGetContenuPageSite($id_site, 'index', 'footer');
					if ($contenuFooter != 0)
					{
						echo $contenuFooter['contenu_fr']."\n";
					}
				?>
				</span>
			</li>
		</ul>
		
		<!-- Pied de page graphique -->
		<div style="width:100%;text-align:right;">
			<img src="css/footer2.jpg" />
		</div>
	</div>
</div>
<!-- Google analytics -->
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
