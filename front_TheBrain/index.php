<?php include('dbFunctions/dbFunctions.php');
include('sitevars.php');
include('siteparts.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
writeHead('index');
?>
</head>
<body class="index">
<?php
writeEntete('index');
?>

<div class="pageContent">

<form style="text-align:center;position:relative;" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=TheBrainRadioshow', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
	<p class="gris" style="font-size:smaller;color:#FF99CB;">
	<br />
	<br />
	<span class="presentation" style="color:#FF99CB;">
	<input type="text" style="width:200px;border:1px solid #FF99CB;background-color:black;;color:#FF99CB;" name="email"/>
	<input type="hidden" value="TheBrainRadioshow" name="uri"/>
	<input type="hidden" name="loc" value="en_US"/>
	<input type="submit" value="OK" style="width:30px;border:1px solid #FF99CB;background-color:black;;color:#FF99CB;cursor:pointer;cursor:hand;" />
	<br />Mailing-list subscription
	</span>
	<!--Delivered by <a href="http://feedburner.google.com" target="_blank">FeedBurner</a>-->
	</p>
</form>

<?php
writePiedDePage('index');
?>
</div>

<?php
writeGoogleAnalyticsTag();
?>

</body>
</html>
