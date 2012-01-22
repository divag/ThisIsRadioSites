<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

if ($_GET["episode"] == null)
	echo "<script>window.location.href = '".$radioclashHome."';</script>";
else
{
	define ('RE_INT','^[0-9]+$');
	if (!ereg(RE_INT,$_GET["episode"]))
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
			$nomEmission = getReferenceEmission($numero, null, null);
			$anneeEmission = date('Y', strtotime($emission['date_sortie']));
			$moisEmission = date('m', strtotime($emission['date_sortie']));
			$dateEmission = $moisEmission."/".$anneeEmission;
			$nomFichierEmission = getNomFichierEmission($numero, null, null);
			
			$gifEmission = $pics.$nomFichierEmission.".gif";
			$imageEmission = $pics.$nomFichierEmission.".jpg";
			
			$audioEmission = $mp3s.$nomFichierEmission.".mp3";
			
			$commentsEmission = $emission['url_lien_forum'];
			$linkEmission = $pageEmission.".php?episode=".$numero;
			$nextEmission = dbGetNextEmission($id_site, $numero);
			
			$listeGoodies = dbGetListeGoodiesEmission($idEmission);
			
			$linkEmissionAutoRedirect = $pageEmission.".php?episode=".$nextEmission['numero']."&auto=1";
			
			$firstPlay = 0;
			$auto = "false";
			if ($_GET["auto"] != null)
				$auto = "true";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
	writeHead('listen');
	?>

	<!-- required -->
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/divagSpecialFeatures.css" />

	<?php	
		$playlist = dbGetPlaylist($idEmission);
		$i = 0;
		$description = "The Brain ".$nomEmission.". Playlist : ";
		while($array=mysql_fetch_array($playlist))
		{
			if ($i == 0 && (toTime($array['time_min']) != "00" || toTime($array['time_sec']) != "00"))
			{
				$description .= "00:00 Introduction";
				$i++;
			}
			$description .= " // ".strip_tags(str_replace(" class=\"upper\"", "", getNomMorceauEmission(toTime($array['time_min']), toTime($array['time_sec']), $array['nom_artiste'], $array['nom_morceau'], $array['nom_label'], $array['annee'])));
			$i++;
		}
	?>
	
	
	<!-- Opengraph tags (@see http://ogp.me/) -->
	<meta property="og:site_name" content="The Brain" />
	<meta property="og:description" content="<?php echo $description ?>"/>
	<meta property="og:title" content="The Brain <?php echo $nomEmission ?>" />
	<meta property="og:image" content="<?php echo $radioclashHome.$imageEmission ?>" />
	<meta property="og:audio" content="<?php echo $radioclashHome.$audioEmission ?>" />
	
	<meta property="og:audio:title" content="The Brain <?php echo $nomEmission ?>" />
	<meta property="og:audio:artist" content="<?php echo $nomParticipants ?>" />
	<meta property="og:audio:album" content="The Brain" />
	
	<meta property="og:audio:type" content="application/mp3" />

	<!-- special IE-only canvas fix -->
	<!--[if IE]><script type="text/javascript" src="<?php echo $soundmanager ?>script/excanvas.js"></script><![endif]-->

	<!-- Page player core CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/page-player.css" />
	<!-- soundManager.useFlashBlock: related CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/flashblock/flashblock.css" />
	<!-- optional: annotations/sub-tracks/notes, and alternate themes -->
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/optional-annotations.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/optional-themes.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $soundmanager ?>demo/css/theBrainPlayerStyle.css" />
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
	soundManager.metadataSeparator = ' | ';
	soundManager.radioclashSpecialFeatures = true;
	soundManager.radioclashSpecialRedirectUrl = '<?php echo $linkEmissionAutoRedirect ?>';
	soundManager.radioclashSpecialFirstPlay = <?php echo $firstPlay ?>;

	// custom page player configuration

	var PP_CONFIG = {
	  divagSpecialFeatures: true,
	  autoStart: <?php echo $auto ?>,      // begin playing first sound when page loads
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
	
	<link rel="stylesheet" href="<?php echo $lightbox ?>css/lightbox.css" type="text/css" media="screen" />

	<link rel="stylesheet" type="text/css" href="css/thebrain.css" />

</head>
<body>
<?php
writeEntete('listen');
?>

<div class="pageContent">

<ul class="enligne" style="height:350px;">
<li>
	<a href="<?php echo $imageEmission ?>" rel="lightbox" title="Click to download/print the cover" rev="<?php echo $imageEmission ?>"><img src="<?php echo $imageEmission ?>" width="350" height="350" border="0" /></a>
</li>
<li class="center">
	<a href="<?php echo $radioclashHome ?>" title="Accueil">
		<img src="css/logoListen.jpg" alt=\"The Brain radioshow logo\" />
	</a>
	<br />
	<a href="<?php echo $pageListen ?>.php" title="Shows">
		<span>SHOWS</span>
	</a>
	<br />
	<br />
	<h2><?php echo $nomEmission ?>
		<br />
		<span style="font-size:smaller;"><?php echo $dateEmission ?></span>
	</h2>
	<br />
	<a class="myShortcut" cible="lecteur">
		<div>
		<span class="nomEmission"><font>&nbsp;PLAY&nbsp;</font></span>
		</div>
	</a>
	<br />
	<?php 
	if ($commentsEmission == "")
		echo "<br />";
	?>
	<a href="<?php echo $audioEmission ?>" class="exclude">
		<span class="lienDownloadEmission">Download</span>
	</a>
	<br />
	<a href="<?php echo $lienPodcast ?>">
		<span class="lienDownloadEmission">Podcast</span>
	</a>
	<?php 
	if ($commentsEmission != "")
	{
		echo "<br />";
		echo "<a href=\"".$commentsEmission."\">";
		echo "    <span class=\"lienDownloadEmission\">Comments</span>";
		echo "</a>";
	}
	?>
	<br />
	<a href="<?php echo $lienDeeperInside ?>">
		<span class="lienDownloadEmission">Deeper Inside</span>
	</a>
</li>
<li>
	<img src="<?php echo $gifEmission ?>" height="350" border="0" />
</li>
</ul>
<br class="clear" />
<div class="player">
	 <ul class="playlist"<?php if (!$auto) echo " style=\"display:none;\""; ?>>
	  <li>
	   <a id="lecteur" href="<?php echo $audioEmission ?>"><span class="titre">The Brain <?php echo $nomEmission ?></span></a>
	   <div class="metadata">
		<div class="duration"><?php echo toTime($emission['time_min']).":".toTime($emission['time_sec']) ?></div> <!-- total track time (for positioning while loading, until determined -->
		<ul>
			<?php 
			$playlist = dbGetPlaylist($idEmission);
			$i=0;
			while($array=mysql_fetch_array($playlist))
			{
				if ($i == 0 && (toTime($array['time_min']) != "00" || toTime($array['time_sec']) != "00"))
				{
					echo "<li><p>Introduction</p><span>00:00</span></li>";
					$i++;
				}
				echo "<li><p>".$array['nom_artiste']." - ".$array['nom_morceau']."</p><span>".toTime($array['time_min']).":".toTime($array['time_sec'])."</span></li>\n";
				$i++;
			}
			?>
		</ul>
	   </div>
	  </li>
	</ul>
</div>
<h3>
<?php 
$playlist = dbGetPlaylist($idEmission);
$i = 0;
while($array=mysql_fetch_array($playlist))
{
	if ($i == 0 && (toTime($array['time_min']) != "00" || toTime($array['time_sec']) != "00"))
	{
		echo "<span class=\"metadataShortCut\" id=\"lecteurmetadataShortCut".$i."\">00:00 Introduction</span><br />\n";
		$i++;
	}
	echo "<span class=\"metadataShortCut\" id=\"lecteurmetadataShortCut".$i."\">".getNomMorceauEmission(toTime($array['time_min']), toTime($array['time_sec']), "<span class=\"upper\">".$array['nom_artiste']."</span>", $array['nom_morceau'], $array['nom_label'], $array['annee'])."</span><br />\n";
	$i++;
}

echo "</h3>";
echo "<div>";
while($array=mysql_fetch_array($listeGoodies))
{
	//1 Texte enrichi
	//2 Lien
	//3 Image
	//4 Mp3
	//5 Flash
	//6 Lien YouTube
	if ($array['id_type_contenu'] == 6)
	{
		if (strstr($array['url'],"youtube.com"))
		{
			echo "<object width=\"400\" height=\"350\" style=\"float:left;\">";
			echo "	<param name=\"movie\" value=\"".$array['url']."\"></param>";
			echo "	<param name=\"allowFullScreen\" value=\"true\"></param>";
			echo "	<param name=\"allowscriptaccess\" value=\"always\"></param>";
			echo "	<embed src=\"".$array['url']."\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"400\" height=\"350\"></embed>";
			echo "</object>";
		}
		if (strstr($array['url'],"http://player.vimeo.com"))
		{
			echo "<iframe src=\"".$array['url']."\" width=\"400\" height=\"350\" style=\"float:left;\" frameborder=\"0\" webkitallowfullscreen=\"\" mozallowfullscreen=\"\" allowfullscreen=\"\"></iframe>";
		}
	}
}
echo "<br class=\"clear\" />";
echo "</div>";

writePiedDePage('listen');

?>
</div>

<?php
writeGoogleAnalyticsTag();
?>

<div class="playerHeight">
</div>
</body>
</html>
