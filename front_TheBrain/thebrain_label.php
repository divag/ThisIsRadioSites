<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
writeHead('thebrain_label');
?>
</head>
<body>
<?php
writeEntete('thebrain_label');
?>

<div class="pageContent">
<h2><span>THE BRAIN RECORDS</span></h2>

<?php
	$contenuNews = dbGetContenuPageSite($id_site, 'thebrain_label', 'releases');
	if ($contenuNews != 0)
	{
		echo $contenuNews['contenu_fr']."\n";
	}
?>	
 
<?php
writePiedDePage('thebrain_label');
?>
</div>

<?php
writeGoogleAnalyticsTag();
?>

</body>
</html>
