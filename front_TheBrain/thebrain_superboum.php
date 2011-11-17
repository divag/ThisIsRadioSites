<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
writeHead('thebrain_superboum');
?>
</head>
<body>
<?php
writeEntete('thebrain_superboum');
?>

<div class="pageContent">
<h2><span>BOUM BOUM ! SUPERBOUM !!!</span></h2>

<?php
	$contenuNews = dbGetContenuPageSite($id_site, 'thebrain_superboum', 'contenu');
	if ($contenuNews != 0)
	{
		echo $contenuNews['contenu_fr']."\n";
	}
?>	
 
<?php
writePiedDePage('thebrain_superboum');
?>
</div>

<?php
writeGoogleAnalyticsTag();
?>

</body>
</html>
