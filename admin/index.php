<?php
include('../sitevars.php');
include('../dbFunctions/dbFunctions.php');
include('../dbFunctions/sendMail.php');

if(isset($_POST['nomCompte']))
{
	$email=$_POST['nomCompte'];
	if (isMail($_POST['nomCompte']) && dbExistsMail($_POST['nomCompte']))
	{		
		$file_email=sendPassword($email);
		if(!empty($file_email))
		{
			$result=sendEmailFile($file_email);
			if (!$result)
				echo '<script type="text/javascript">alert("Une erreur est survenue lors de l\'envoi de mail");</script>';
				
			echo '<script type="text/javascript">alert("result :  '.$result.'");</script>';			
		}
		else
			echo '<script type="text/javascript">alert("Une erreur est survenue lors de la création du mail");</script>';
	}
	else
		echo '<script type="text/javascript">alert("email invalide ou inexistant");</script>';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>This is Radioclash administration</title>
	<style>
	body {
		background-color:#FFF;
	}
	</style>
</head>
<body>
<img src="../css/bandeau.gif" />
<br />
<table>
<tr><td style="padding-left:15px;">
		<h3 style="margin-bottom:0px;margin-top:0px;">COME ON BABY :</h3> 
</td><td>
	<form method="post" action="thisisradioclashadmin.php">
		<input type="text" name="login" />
		<input type="password" name="password" />
		<input type="submit" value=" >>>>>>>>  G O  >>>>>>>>" />	
	</form>  
</td></tr>
<tr><td>
</td><td style="text-align:right;">
	<form method="post" action="index.php">
		<input type="button" id="boutonEnvoiMotDePasse" value=">> Mot de passe oublié ?" onclick="this.style.display = 'none'; document.getElementById('divEnvoiMotDePasse').style.display = 'block';" />
		<div style="display:none;" id="divEnvoiMotDePasse">
			Ton adresse mail : 
			<input type="text" id="nomCompte" name="nomCompte" />
			<input type="submit" value="Envoyer le mot de passe" />
		</div>
	</form>
</td></tr>
</table>
	<script>
	if (navigator.appName != 'Netscape')
		location.href = 'noIE.html';
	else
	{
		if (location.href.indexOf('www') == -1)
			location.href = '<?php echo $radioclashHome ?>admin/';
	}
	
	</script>
</body>
</html>
