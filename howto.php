<?php include('dbFunctions/dbFunctions.php');
include('siteparts.php');
include('sitevars.php');

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

<h2 class="gris">RADIOCLASH MODE D'EMPLOI</h2>
<h3 class="gris">THIS IS RADIOCLASH EST UN PROJET PARTICIPATIF !!!</h3>
<p class="italique">
A ce titre vous &ecirc;tes libre (et m&ecirc;me chaleureusement invit&eacute;) de lancer un th&egrave;me &agrave; n'importe quel moment de l'ann&eacute;e, de jour comme de nuit.<br /> 
Ceci ne vous engage qu'&agrave; r&eacute;colter le diff&eacute;rentes parties aupr&egrave;s de vos coll&egrave;gues de th&egrave;me et &agrave; faire le montage final (mais vous pouvez aussi d&eacute;l&eacute;guer &ccedil;a &agrave; quelqu'un de votre &eacute;quipe). M&ecirc;me chose pour la "pochette" - juste respecter le format (346 X 346) et indiquer "This is Radioclash n&deg; x" et le th&egrave;me.<br />
Vous &ecirc;tes tout aussi libre de vous rallier &agrave; n'importe quel th&egrave;me lanc&eacute; du moment qu'il reste de la place.<br />
4 &agrave; 5 participants pour une heure semble un bon ratio. Enfin si le coeur vous en dit vous pouvez participer &agrave; 2 ou plus Radioclash en m&ecirc;me temps ou encore lancer un th&egrave;me tout en participant &agrave; un autre, mais rappelez vous que une fois l'&eacute;quipe constitu&eacute;e vous avez un mois pour rendre votre partie.<br /> 
(Jurisprudence dite de Schling).<br />
une seule obligation : coller au th&egrave;me.
</p>
<p class="gris italique">THIS IS RADIOCLASH EST UN PROJET AUTOGERE QUI S'ECRIT EN DIRECT AVEC VOUS</p>
<p class="big gras">
LE GENERIQUE EST <a href="mp3/generiqueradioclash.mp3" target="blank" title="G&eacute;n&eacute;rique de THIS IS RADIOCLASH"><span>ICI</span></a><br />
LA TAILLE DES POCHETTES<br />
EST <span class="gris">346 X 346 pixels</span>
</p>
<?php
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
