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
<span>FOR EVEN FRESHER NEWS, LIKE MIXES EVENTS, PLEASE GO ON OUR <a href="<?php echo $lienFacebook ?>" title="Facebook">FACEBOOK</a> !<br />
<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=TheBrainRadioshow', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
	<br />OR SUBSCRIBE TO OUR MAILING-LIST :	
	<input type="text" style="width:200px;border:1px solid #FF99CB;background-color:black;;color:#FF99CB;" name="email"/>
	<input type="hidden" value="TheBrainRadioshow" name="uri"/>
	<input type="hidden" name="loc" value="en_US"/>
	<input type="submit" value="OK" style="width:30px;border:1px solid #FF99CB;background-color:black;;color:#FF99CB;cursor:pointer;cursor:hand;" />
	<!--Delivered by <a href="http://feedburner.google.com" target="_blank">FeedBurner</a>-->
</form>
</span>
<?php
writePiedDePage('news');
?>
</div>

<?php
writeGoogleAnalyticsTag();
?>

</body>
</html>
