<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');

//Récupération de la liste des émissions :
$listeEmissions = dbGetListeEmissions($id_site);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>.::: prototop.be :::.</title>
<style type="text/css">

body {
	font-family: sans-serif;
	font-size: 9pt;
	font-weight: bold;
	background-color: rgb(0, 0, 0);
	background-image: url("css/background.jpg");
	background-repeat: repeat-y;
	background-position: 10px 0px;
	padding-top: 0px;
	margin-top: 0px;
}

#dsr {
	position:absolute;
	text-align: center;
	margin-left: 2px;
	top: 50px;
	margin-top: 0px;
	background-image: url("css/logo_big.jpg");
	background-repeat: no-repeat;
	background-position: left top;
	height: 425px;
	width: 284px;
}

#container {
	color:#0B3E41;
	margin-left: 300px;
	padding: 5px;
	margin-top: 10px;
	background-repeat: no-repeat;
	background-position: left top;
	background-color: #A67240;
	border-color:#749C56;
	border-width:5px;
	border-style:solid;
}

#container ul, #container ul li {
	list-style: none; 
	padding-left:0px;
	margin-left:0px;
}

.workInProgress {
	text-align:center;
	font-weight:normal;
}

#container ul li h3 {
	background-color:#749C56; 
	padding-left:10px;
	margin-left:-10px;
	margin-right:-10px;
	padding-top:10px;
	padding-bottom:10px;
}
td {
	vertical-align:top;
}
td img {
padding-right:5px;
}

#container {
	border-color: rgb(0, 0, 0);
	background-color: transparent;
	color: rgb(51, 191, 130);
}

#content ul li h3 {
	background-color: #BA7F42;
	color: #000000;
}

.metadataShortCut {
	padding:0px;
	padding-left:5px;
	padding-right:5px;
	background-color: transparent;
	color: rgb(51, 191, 130);
}
.metadataShortCutPlaying {
	padding:1px;
	padding-left:5px;
	padding-right:5px;
	background-color: rgb(51, 191, 130);
	color: black;
}

.black {
	color:black;
}

.red {
	color:red;
}

.gris {
	color:gray;
}

.gras {
	font-weight:bold;
}

.italique {
	font-style:italic;
}

.big {
	font-size:14px;
}

.right {
	text-align:right;
	margin-right:5px;
}

.center {
	text-align:center;
}

.top {
	vertical-align:top;
}



</style>
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
	<span class="workInProgress">Bonjour et bienvenue sur l'Internet. <br />Ce site est en cours de construction, mais en attendant, voici tout de même les émissions :</span>
	<!--
	<span class="workInProgress">Bonjour et bienvenue sur l'Internet.<br /><br />Ce site est en cours de construction. <br />En attendant, voici tout de même les émissions :</span>
	-->
	<ul>
		<?php 
			$iEmission = 0;
			while($emission=mysql_fetch_array($listeEmissions))
			{
				$idEmission = $emission['id'];
				$texteEmission = getReferenceEmission($emission['numero'], null, null);
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
</body>
</html>
