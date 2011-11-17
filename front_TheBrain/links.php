<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
writeHead('links');
?>
</head>
<body>
<?php
writeEntete('links');
?>

<div class="pageContent">
<h2><span>LINKS, CHAINS, BAND AID</span></h2>

<span class="presentation">
<?php
	$contenuNews = dbGetContenuPageSite($id_site, 'links', 'introduction');
	if ($contenuNews != 0)
	{
		echo $contenuNews['contenu_fr']."\n";
	}
?>	
</span>

<div class="menu">
  <ul class="menu links">
    <li class="first"><a href="mailto:<?php echo $mailAdmin ?>" title="Contact">
	<span>CONTACT</span>
	</a></li>
    <li><a href="<?php echo $lienForum ?>" title="Forum">
	<span>FORUM</span>
	</a></li>
    <li><a href="<?php echo $lienFacebook ?>" title="Facebook">
	<span>FACEBOOK</span>
	</a></li>
    <li><a href="<?php echo $lienPodcast ?>" title="Podcast">
	<span>PODCAST</span>
	</a></li>
  </ul>
  <ul class="menu links">
    <li class="first secondLine"><a href="thebrain_dj.php" title="The Brain DJ">
	<span>THE BRAIN DJ</span>
	</a></li>
    <li class="secondLine"><a href="thebrain_superboum.php" title="Superboum">
	<span>SUBERBOUM</span>
	</a></li>
    <li class="secondLine"><a href="thebrain_label.php" title="Label">
	<span>LABEL</span>
	</a></li>
    <li class="secondLine"><a href="http://www.ecrans.fr/Rencontre-avec-le-cerveau,9507.html" title="Interview">
	<span>INTERVIEW</span>
	</a></li>
  </ul>
</div>
<br clear="all" />

<?php
	$contenuNews = dbGetContenuPageSite($id_site, 'links', 'links');
	if ($contenuNews != 0)
	{
		echo $contenuNews['contenu_fr']."\n";
	}
?>
 
<?php
writePiedDePage('links');
?>
</div>

<?php
writeGoogleAnalyticsTag();
?>

</body>
</html>
