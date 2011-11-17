<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
writeHead('news');
?>
</head>
<body>
<?php
writeEntete('news');
?>
<div class="pageContent">
<h2><span>WE ARE ALL GONNA DIE BUT BEFORE...</span></h2>

<?php
	
	$contenuNews = dbGetContenuPageSite($id_site, 'news', 'introduction');
	if ($contenuNews != 0)
	{
		echo "<span class=\"presentation\">\n";
		echo $contenuNews['contenu_fr']."\n";
		echo "</span>\n";
	}
	
	$listeNews = dbGetListeNewsActives($id_site);
	echo '<ul class="listeNews">';
	while ($news=mysql_fetch_array($listeNews))
	{
		$dateNews = date('d/m/Y', strtotime($news['date']));	
		echo '    <li>';
		echo '      <h3>'.$news['titre'].'</h3>';
		echo '      <p>'.$news['contenu_fr'].'</p>';
		echo '      <p class="date">Post&eacute;e le '.$dateNews.'</p>';
		echo '    </li>';
	}
	echo '</ul>';
?>
<br />
<span>FOR EVEN FRESHER NEWS, LIKE MIXES EVENTS, PLEASE GO ON OUR <a href="<?php echo $lienFacebook ?>" title="Facebook">FACEBOOK</a> !</span>
<br />
<?php
writePiedDePage('news');
?>
</div>

<?php
writeGoogleAnalyticsTag();
?>

</body>
</html>
