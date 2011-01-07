<?php
include('../dbFunctions/sendMail.php');
// - inclu indirectement : include('../dbFunctions/dbFunctions.php');
// - inclu indirectement : include('../sitevars.php');

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
	<title><?php echo $site['nom'] ?> : Administration</title>
	<style>
	body {
		background-color:#FFF;
	}
#divWait {
	text-align: center;
}

#divWait div form {
	text-align: center;
}

#divWait div form table {
	text-align: left;
	margin-left: auto;
	margin-right: auto;
	border: 2px double rgb(199, 199, 199);
	padding: 4px;
	background-color: rgb(242, 242, 242);
}

#divWait div form table input {
	width: 170px;
}

.libelle {
	text-align: right;
}

#body {
	font-family: sans-serif;
	font-size: 9pt;
}

#divWait div form table tbody tr td.libelle {
	font-size: 9pt;
	color: rgb(94, 94, 94);
}

	</style>
</head>
<body>
<div id="divWait" class="divWait">
	<div>
	<br /><br />
	<br /><br />
	<img src="css/logo_site<?php echo $id_site ?>.jpg" />
	<br />
	<br />
		<form id="identification" method="post" action="thisisradioclashadmin.php">
			<table>
				<tr><td class="libelle">Nom : </td><td><input type="text" name="login" /></td></tr>
				<tr><td class="libelle">Mot de passe : </td><td><input type="password" name="password" /></td></tr>
				<tr><td class="libelle"></td><td><input type="submit" value=" >>>>>  G O  >>>>>" /></td></tr>
			</table>			
		</form>
		<br />
		<form id="sendMotDePasse" method="post" action="index.php">
			>> <a href="#" id="boutonEnvoiMotDePasse" onclick="this.style.display = 'none'; document.getElementById('divEnvoiMotDePasse').style.display = 'block';">Mot de passe oublié ?</a> <<
			<br />
			<div style="display:none;" id="divEnvoiMotDePasse">
				<table>
					<tr><td class="libelle">Adresse mail : </td><td><input type="text" id="nomCompte" name="nomCompte" /></td></tr>
					<tr><td class="libelle"></td><td><input type="submit" value="Envoyer le mot de passe" /></td></tr>
				</table>
			</div>
		</form>
	</div>
</div>

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
