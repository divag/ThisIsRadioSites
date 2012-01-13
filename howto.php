<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

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
	
	<link rel="stylesheet" href="<?php echo $lightbox ?>css/lightbox.css" type="text/css" media="screen" />

</head>

<body>

<?php
writeEntete('howto');
?>

<div class="pageContent">

<?php

$contenu = dbGetContenuPageSite($id_site, 'howto', 'contenu');
if ($contenu != 0)
{
	echo $contenu['contenu_fr']."\n";
}

writePiedDePage('howto');
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
