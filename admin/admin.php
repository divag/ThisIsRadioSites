<?php 
include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');
$login;
$password;

if(isset($_POST) && isset($_POST['login']) && isset($_POST['password']) && $_POST['login'] != '' && $_POST['password'] != '')
{
	$i=0;
	foreach($_POST as $var => $val){
		if ($i == 0)
		{
			$log = $val;
			$login = $val;
		}
		if ($i == 1)
			$password = $val;
		$i++;
	}

	$utilisateur = dbGetUtilisateurByLogin(addslashes(urlencode($login)));
	$admin = '';
	$superAdmin = false;
	$isMultiAdmin = false;
	$contenuListeSites = '';
	
	if ($utilisateur != 0 && $utilisateur['password'] == $password)
	{
		$titrePage = $site['nom']." : ";
		$superAdmin = dbCheckSuperAdministrateur($utilisateur['id']);
		$isAdmin = dbCheckAdministrateur($id_site, $utilisateur['id']);
		
		if ($isAdmin)
		{
			$admin = '';
			$titrePage .= "Administration";
			
			//Affichage de la liste des sites à gérer, s'il y en a d'autres :
			$listeSitesAdministrateur = dbGetListeSitesAdministrateur($utilisateur['id']);
			if (mysql_num_rows($listeSitesAdministrateur) > 1)
			{
				$isMultiAdmin = true;
				$contenuListeSites .= "\n		<tr>\n";
				while ($siteAAfficher = mysql_fetch_array($listeSitesAdministrateur))
				{
					if ($siteAAfficher['id'] != $site['id'])
					{
						$contenuListeSites .= "\n			<td style=\"text-align:center;padding:5px;\">";
						$contenuListeSites .= "\n			    <form id=\"acces_site_".$siteAAfficher['id']."\" method=\"post\" action=\"".$siteAAfficher['url']."admin/admin.php?ModPagespeed=off\">\n";
						$contenuListeSites .= "\n			        <input type=\"hidden\" name=\"login\" value=\"".$utilisateur['login_forum']."\" />\n";
						$contenuListeSites .= "\n			        <input type=\"hidden\" name=\"password\" value=\"".$utilisateur['password']."\" />\n";
						$contenuListeSites .= "\n			        <a href=\"#\" style=\"border-width:0px;\" onclick=\"document.forms['acces_site_".$siteAAfficher['id']."'].submit();\" title=\"Accéder à l'administration du site ".$siteAAfficher['nom']."\">\n";
						$contenuListeSites .= "\n			            <img style=\"text-align:center;border-width:0px;\" src=\"css/logo_site".$siteAAfficher['id'].".jpg\" />\n";
						$contenuListeSites .= "\n			        </a>\n";
						$contenuListeSites .= "\n			    </form>\n";
						$contenuListeSites .= "\n			</td>\n";
					}
				}
				$contenuListeSites .= "\n		</tr>\n";
			}
		}
		else
		{
			if ($siteHaveParticipants)
			{
				$admin = addslashes($utilisateur['nom']);
				$titrePage .= "Accès \"CHEF\"";
			}
			else
				echo "<script>window.location.href = '".$radioclashHome."admin/';</script>";
		}
	}
	else
		echo "<script>window.location.href = '".$radioclashHome."admin/';</script>";
}
else
	echo "<script>window.location.href = '".$radioclashHome."admin/';</script>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $titrePage ?> : Administration</title>

	<!--<link rel="stylesheet" type="text/css" href="css/style.css" />-->
	<link rel="stylesheet" type="text/css" href="css/admin.css" />
    <script type="text/javascript" language="javascript" src="js/jQuery/jquery-1.2.3.js"></script>
    <script type="text/javascript" language="javascript" src="js/jQuery/jquery.form.js"></script>
	<script type="text/javascript" src="js/ajaxFunctions.js"></script>
	<script type="text/javascript" src="js/todolist.js"></script>
	<script type="text/javascript" src="../modules/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="../modules/ckfinder/ckfinder.js"></script>
	<script type="text/javascript">
		<?php
			if ($pageEmission == '')
				echo "var urlPreview = \"".$radioclashHome."?preview=1#{numero}\";";
			else
				echo "var urlPreview = \"".$radioclashHome.$pageEmission.".php?episode={numero}&preview=1\";";
		?>
		var urlBaseFunction = "<?php echo $radioclashHome ?>dbFunctions/";
		var id_site = '<?php echo $id_site ?>';
		var id_utilisateur = '<?php echo $utilisateur['id'] ?>';
		var admin = '<?php echo $admin ?>';
		var superAdmin = <?php echo ($superAdmin ? 'true' : 'false') ?>;
		var isMultiAdmin = <?php echo ($isMultiAdmin ? 'true' : 'false') ?>;
		//Options du site :
		var siteHaveTitre = <?php echo ($siteHaveTitre ? 'true' : 'false') ?>;
		var siteHaveTexte = <?php echo ($siteHaveTexte ? 'true' : 'false') ?>;
		var siteHaveParticipants = <?php echo ($siteHaveParticipants ? 'true' : 'false') ?>;
		var siteDefaultParticipant = '<?php echo $siteDefaultParticipant ?>';
		var siteHaveImageJpg = <?php echo ($siteHaveImageJpg ? 'true' : 'false') ?>;
		var siteHaveImageJpgToPrint = <?php echo ($siteHaveImageJpgToPrint ? 'true' : 'false') ?>;
		var siteHaveImageGif = <?php echo ($siteHaveImageGif ? 'true' : 'false') ?>;
		var siteHaveTeaserMp3 = <?php echo ($siteHaveTeaserMp3 ? 'true' : 'false') ?>;
		var siteHaveTeaserVideo = <?php echo ($siteHaveTeaserVideo ? 'true' : 'false') ?>;
		var siteHaveGoodies = <?php echo ($siteHaveGoodies ? 'true' : 'false') ?>;
		var siteHaveBonus = <?php echo ($siteHaveBonus ? 'true' : 'false') ?>;
		var siteHaveNews = <?php echo ($siteHaveNews ? 'true' : 'false') ?>;
		var siteHaveNewsletter = <?php echo ($siteHaveNewsletter ? 'true' : 'false') ?>;
		var siteHaveZip = <?php echo ($siteHaveZip ? 'true' : 'false') ?>;
		var siteHaveContenuPages = <?php echo ($siteHaveContenuPages ? 'true' : 'false') ?>;
		var siteHaveStatutAnnounced = <?php echo ($siteHaveStatutAnnounced ? 'true' : 'false') ?>;
		var templateReferenceEmission ='<?php echo $templateReferenceEmission ?>';
		var templateNommageFichiersEmission ='<?php echo $templateNommageFichiersEmission ?>';
		var templateNommageMorceauxEmission ='<?php echo $templateNommageMorceauxEmission ?>';
		var siteHaveLabel = (templateNommageMorceauxEmission.indexOf('{nom_label}') != -1);
		var siteHaveAnnee = (templateNommageMorceauxEmission.indexOf('{annee}') != -1);
	</script>
</head>
<body>
<a name="top" style="position:absolute;top:-10px;"></a>
<div id="divWait" class="divWait" onclick="return false;">
	<div>
	<img src="css/loading.gif" /><br />
	<span id="spanWait">Veuillez patienter...</span>
	</div>
</div>
<div id="adminContent">
	<div id="enteteAdmin">
		<h2><?php echo $titrePage ?></h2>
	</div>
	<div id="menuAdmin">
		<!-- affichage du menu -->
		<input id="buttonMenuhome" type="button" class="button" value="<< Maison <<" onclick="display('home');" />
		<input id="buttonMenuplaylists" type="button" class="button" value="Emissions" onclick="display('home');display('playlists');" />
		<input id="buttonMenunews" type="button" class="button" value="News" onclick="display('home');display('news');" />
		<input id="buttonMenunewsletter" type="button" class="button" value="Mailing list" onclick="display('home');display('newsletter');" />
		<input id="buttonMenuusers" type="button" class="button" value="Utilisateurs" onclick="display('home');display('users');" />
		<input id="buttonMenuartistesLabels" type="button" class="button" value="Artistes / Labels" onclick="display('home');display('artistesLabels');" style="display:none;" />
		<input id="buttonMenubonus" type="button" class="button" value="Bonus" onclick="display('home');display('bonus');" />
		<input id="buttonMenucontenuPageSite" type="button" class="button" value="Contenu des pages" onclick="display('home');display('contenuPageSite');" />
		<a href="<?php echo $radioclashHome ?>" id="lienVisiterSite" target="blank" alt="Visiter sur le site (dans un nouvel onglet)"><input id="buttonVisiterSite"id="buttonMenucontenuPageSite" type="button" class="button" value="Voir le site (nouvel onglet)" /></a>
	</div>
	<!-- affichage des playlists -->
	<div id="home">
		<h3>Bien l'bonjour <? echo $utilisateur['nom'] ?> !</h3>
		Bienvenue sur le site d'administration de "<?php echo $site['nom'] ?>".<br />
		<div id="autresSites" style="display:none;">
			<br />Quel honneur, tu es administrateur de plusieurs sites ! <br /> 
			Tu peux accéder à tes autres sites d'administration en cliquant directement sur les liens ci-dessous : 
			<br />
			<br />
			<table id="listeSites" style="padding-left:10px;"><? echo $contenuListeSites ?></table>
		</div>
		<br />
		<br />
		<h3>Des problèmes ? Des questions ? Des idées ?</h3>
		C'est ici que ça s'passe :<br />
		<ul>
			<li style="color:red;">Rien pour le moment, il faut trouver la solution qui sera la mieux...</li>
		</ul>
		<br />
		<span style="color:gray;"><i>
		Anciennement TODO LIST :<br />
		Dispo en ligne ici : <a href="http://todoist.com/">http://todoist.com/</a>
		<ul>
			<li>Email : <b>contact@thisisradioclash.org</b></li>
			<li>Password : <b>radiogaga</b></li>
		</ul>
		</i></span>
	</div>

	<div id="editeurContenu" style="display:none;">
		<br/>
		<fieldset id="formContenuFieldset">
			<legend id="formContenuLegend"></legend>
			<table width="100%">
				<tr id="formContenuType_Type">
					<td style="width:120px;" class="padded">
						<span id="spanContenuType"><b><u>Type de contenu :</u></b></span>
					</td>
					<td style="width:120px;text-align:left;" class="padded">
						<select id="formContenuType"></select>
					</td>
					<td style="text-align:left;" class="padded">
						<!-- Si type = 0 -->
						<div id="formContenuType_0">
							<span style="color:red;">Veuillez sélectionner un type de contenu.</span>
						</div>
						<!-- Si type = 2 -->
						<div style="text-align:left;" id="formContenuType_2">
								<input type="text" id="formContenuUrl" style="width:100%"/>
						</div>
						<!-- Si type = 3 -->
						<div style="text-align:left;white-space: no-wrap;" id="formContenuType_3">
							<form id="formUploadContenuImage" method="post" ENCTYPE="multipart/form-data">
								<input type="file" id="fileContenuImage" name="fileEmission" style="float:left;" onchange="return validateExtension(this, 'jpg', 'gif');" />
								<input id="fileContenuImageButton" class="button"  style="float:left;" type="submit" value="Uploader" />
								<input type="hidden" id="fileContenuImageId" name="numero" value="0"/>
								<input type="hidden" id="fileContenuImageFolder" name="folder" value="<?php echo $contenu ?>"/>
								<input type="hidden" id="fileContenuImageExtension" name="extension" value=""/>
								<input type="hidden" id="fileContenuImageUrl" />
							</form>                      
						</div>
						<div style="text-align:left;" id="formContenuType_4">
								<span style="color:red;"><b><u>A coder : Edition de contenu "Mp3"</u></b></span>
						</div>
						<div style="text-align:left;" id="formContenuType_5">
								<span style="color:red;"><b><u>A coder : Edition de contenu "Flash"</u></b></span>
						</div>
						<div style="text-align:left;" id="formContenuType_6">
							<input type="text" id="formContenuLienVideo" style="width:100%;" />
							<br />
							<span id="formContenuLienVideoError" style="color:red;"></span>
						</div>
					</td>
					<td style="width:50px;text-align:right;" class="padded">
						<input type="button" id="boutonValiderContenu" class="button" value="Enregistrer" />
					</td>
					<td style="width:50px;text-align:left;" class="padded">
						<input type="button" id="boutonAnnulerContenu" class="button" value="Retour" />
					</td>
				</tr>
				<tr>
					<td id="contenuAdditionnal" colspan="5" style="text-align:center;">
					</td>
				</tr>
				<tr>
					<td colspan="5" style="text-align:center;">
						<div style="text-align:center;" id="formContenuType_1">
								<h3><u>Version française :</u></h3>
								<textarea id="formContenuContenuFr" class="ckeditor" name="formContenuContenuFr"></textarea><br />
								<h3><u>Version anglaise :</u></h3>
								<textarea id="formContenuContenuEn" class="ckeditor" name="formContenuContenuEn"></textarea><br />
								<textarea id="formContenuContenuTxtFr" style="display:none;"></textarea><br />
								<textarea id="formContenuContenuTxtEn" style="display:none;"></textarea><br />
						</div>
						<script type="text/javascript">
							CKEDITOR.replace( 'formContenuContenuFr',
							{
								filebrowserBrowseUrl : '../modules/ckfinder/ckfinder.html',
								filebrowserImageBrowseUrl : '../modules/ckfinder/ckfinder.html?Type=Images',
								filebrowserFlashBrowseUrl : '../modules/ckfinder/ckfinder.html?Type=Flash',
								filebrowserUploadUrl : '../modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								filebrowserImageUploadUrl : '../modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
								filebrowserFlashUploadUrl : '../modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
							});
							
							CKEDITOR.replace( 'formContenuContenuEn',
							{
								filebrowserBrowseUrl : '../modules/ckfinder/ckfinder.html',
								filebrowserImageBrowseUrl : '../modules/ckfinder/ckfinder.html?Type=Images',
								filebrowserFlashBrowseUrl : '../modules/ckfinder/ckfinder.html?Type=Flash',
								filebrowserUploadUrl : '../modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								filebrowserImageUploadUrl : '../modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
								filebrowserFlashUploadUrl : '../modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
							});
						</script>
						<div style="text-align:center;" id="formContenuType_3_Preview">
								<span id="fileContenuImageError" style="color:red;font-weight:bold;"></span>
								<br />
								<a id="imgContenuImage" target="blank"><img id="imgContenuImageThumb" /></a>
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
	</div>

	<!-- affichage des playlists -->
	<div id="playlists">
		<h3 id="texteChef">Yo Chef de proue ! <br />V'la donc les &eacute;missions sur lesquelles tu peux uploader des fichiers :</h3>
		<h3 id="ajoutEmission">Liste des &eacute;missions : <input type="button" class="button" value="Ajouter une &eacute;mission" onclick="newEmission();" /></h3>
		<table id="listeEmissions" class="tableaux">
		</table>
		<span id="spanChefNoEmission" style="display:none;color:red;"><b>Que dalle pout le moment... :// Lance donc un th&egrave;me ;))</b></span>
	</div>
	<!-- edition d'une playlist -->
	<div id="playlist">

		<h3><input type="button" class="button" value="<< Retour" onclick="currentItem = ''; display('playlists');" /></h3>
		
		<table width="95%">
		<tr><td width="55%" style="vertical-align:top;">
		
			<fieldset id="emission">
			<legend>Informations g&eacute;n&eacute;rales</legend>
			<table>
				<tr>
					<td class="formLeft">Num&eacute;ro :</td>
					<td class="formRight"><input type="text" id="txtNumeroEmission" onchange="document.getElementById('formEnregistrer').disabled = (!Verif_Numero(this))" /><br />
					<span id="txtNumeroEmissionError" style="color:red;"></span></td>
				</tr>
				<tr id="trTitreEmission">
					<td class="formLeft">Titre :</td>
					<td class="formRight"><input type="text" id="txtTitreEmission" onchange="document.getElementById('formEnregistrer').disabled = (siteHaveTitre && !Verif_NonVide(this));" /><br />
					<span id="txtTitreEmissionError" style="color:red;"></span></td>
				</tr>
				<tr id="trDateEmission">
					<td class="formLeft">
						<span id="lblDateEmissionPublie">Date de sortie :</span>
						<span id="lblDateEmission">Date de sortie pr&eacute;vue :</span>
					</td>
					<td class="formRight">
						<input type="text" id="txtDateEmission" onchange="document.getElementById('formEnregistrer').disabled = (!Verif_Date(this));" /><br />
						<span id="txtDateEmissionError" style="color:red;"></span>
					</td>
				</tr>
				<tr id="trLienForumEmission">
					<td class="formLeft">Lien des commentaires :</td>
					<td class="formRight"><input type="text" id="txtUrlLienForumEmission" onchange="document.getElementById('formEnregistrer').disabled = (siteHaveTitre && !Verif_IsUrl(this));" /><br />
					<span id="txtUrlLienForumEmissionError" style="color:red;"></span></td>
				</tr>
				<div style="display:none;">
					<input type="text" id="txtMinutesEmission" size="2" />
					<input type="text" id="txtSecondesEmission" size="2" />
				</div>
				<tr id="trBoutonsEmission">
					<td class="formLeft"></td>
					<td class="formRight">
						<input id="formEnregistrerAnnuler" type="button" class="button" style="float:left;" value="Annuler" onclick="currentItem = ''; display('playlists');" /> 
						<input id="formEnregistrer" type="button" class="button" style="float:left;" value="Enregistrer l'&eacute;mission" onclick="formEnregistrer();" />
						<input id="boutonUpdateZipEmission" type="button" class="button" style="float:left;" value="Mettre &agrave; jour le ZIP de l'&eacute;mission" onclick="updateZipEmission();" />
					</td>
				</tr>
			</table>
			</fieldset>
			<fieldset id="mailAdmin" class="etat22">
					<legend>Envoyez un message ou votre playlist au grand admin</legend>
					<textarea id="txtEnvoiMail" style="width:100%;" rows="9" onkeyup="document.getElementById('boutonEnvoiMail').disabled = (trim(this.value) == '')"></textarea><br />
					<input type="button" class="button" id="boutonEnvoiMail" style="width:100%;" value="Envoyer un mail &agrave; l'administrateur" onclick="envoiPlaylistAdmin();" disabled="true" />
			</fieldset>
			<fieldset id="textePresentationEmission" class="etat22">
					<legend>Texte de présentation</legend>
					<div id="previewPresentationEmission" style="width:100%;"></div>
					<br />
					<input type="button" class="button" id="boutonTextePresentationEmission" style="width:100%;" value="Modifier" />
			</fieldset>
			<fieldset id="participants">
			<legend>Participants de l'&eacute;mission</legend>
			<input id="boutonAddParticipant" type="button" class="button" onclick="showAddParticipant();" value="Ajouter un participant" /><br />
			<fieldset id="addParticipant">
			<legend>Ajout d'un participant :</legend>
				<input type="text" id="txtNomParticipant" onchange="document.getElementById('formAddParticipant').disabled = (!Verif_NonVide(this))" /><br />
				<span id="txtNomParticipantError" style="color:red;"></span>
				<br />
				<select id="listeAllUsersAndGroupes" onchange="document.getElementById('txtNomParticipant').value = this.value; document.getElementById('formAddParticipant').disabled = (!Verif_NonVide(document.getElementById('txtNomParticipant')));">
				</select>
				<br />
				<input type="button" class="button" value="Annuler" onclick="hideAddParticipant();" /> <input id="formAddParticipant" type="button" class="button" value="Ajouter le participant" onclick="formAddParticipant();" />
			</fieldset>
			<br />
			<span id="noParticipants" style="color:red;"><i>Aucun participant pour cette &eacute;mission...</i></span>
			<table id="listeParticipants" class="tableaux">
			</table>
			</fieldset>
			<fieldset id="goodiesEmission" class="etat22">
				<legend>Goodies : Liens YouTube/Vimeo en cadeaux avec l'&eacute;mission</legend>
				<input id="boutonAddGoodiesEmission" type="button" class="button" value="Ajouter un goodies" /><br />
				<br />
				<u>Voici la liste des goodies :</u>
				<br />
				<br />
				<table id="listeGoodiesEmission">
				</table>
			</fieldset>
		</td>
		<td width="45%" style="vertical-align:top;">
			<fieldset id="pochetteEmission">
			<legend>Pochette de l'&eacute;mission en JPG</legend>
				<form id="formUploadPochette" method="post" ENCTYPE="multipart/form-data">
					<input type="file" id="filePochetteEmission" name="fileEmission" onchange="return validateExtension(this, 'jpg');" /> 
					<input id="filePochetteEmissionButton" class="button" type="submit" value="Uploader" /><input id="filePochetteEmissionDeleteButton" type="button" class="button" onclick="deleteFile('pochette');" value="Supprimer" /><br />
					<span id="filePochetteEmissionError" style="color:red;"></span>
					<input type="hidden" id="numeroEmissionForUploadPochette" name="numero"/>
					<input type="hidden" name="folder" value="<?php echo $pics ?>"/>
					<input type="hidden" name="extension" value=".jpg"/>
				</form>
				<br />
				<a id="imgPochetteEmission" target="blank"><img id="imgPochetteEmissionThumb" width="100px" height="100px" /></a>
			</fieldset>
			<fieldset id="pochetteEmissionToPrint">
			<legend>Pochette de l'&eacute;mission &agrave; imprimer en JPG</legend>
				<form id="formUploadPochetteToPrint" method="post" ENCTYPE="multipart/form-data">
					<input type="file" id="filePochetteEmissionToPrint" name="fileEmission" onchange="return validateExtension(this, 'jpg');" /> 
					<input id="filePochetteEmissionToPrintButton" class="button" type="submit" value="Uploader" /><input id="filePochetteEmissionToPrintDeleteButton" type="button" class="button" onclick="deleteFile('pochetteToPrint');" value="Supprimer" /><br />
					<span id="filePochetteEmissionToPrintError" style="color:red;"></span>
					<input type="hidden" id="numeroEmissionForUploadPochetteToPrint" name="numero"/>
					<input type="hidden" name="folder" value="<?php echo $pics ?>"/>
					<input type="hidden" name="extension" value=".jpg"/>
				</form>
				<br />
				<a id="imgPochetteEmissionToPrint" target="blank"><img id="imgPochetteEmissionThumbToPrint" width="200px" height="100px" /></a>
			</fieldset>
			<fieldset id="pochetteEmissionGif">
			<legend>Pochette de l'&eacute;mission en GIF</legend>
				<form id="formUploadPochetteGif" method="post" ENCTYPE="multipart/form-data">
					<input type="file" id="filePochetteEmissionGif" name="fileEmission" onchange="return validateExtension(this, 'gif');" /> 
					<input id="filePochetteEmissionGifButton" class="button" type="submit" value="Uploader" /><input id="filePochetteEmissionGifDeleteButton" type="button" class="button" onclick="deleteFile('pochetteGif');" value="Supprimer" /><br />
					<span id="filePochetteEmissionGifError" style="color:red;"></span>
					<input type="hidden" id="numeroEmissionForUploadPochetteGif" name="numero"/>
					<input type="hidden" name="folder" value="<?php echo $pics ?>"/>
					<input type="hidden" name="extension" value=".gif"/>
				</form>
				<br />
				<a id="imgPochetteEmissionGif" target="blank"><img id="imgPochetteEmissionThumbGif" width="100px" height="100px" /></a>
			</fieldset>
			<fieldset id="mp3Emission">
			<legend>Fichier MP3 de l'&eacute;mission</legend>
				<span id="noMp3" style="color:red;"><i>Aucun fichier mp3 n'a &eacute;t&eacute; trouv&eacute;.</i></span>
				<span id="yesMp3"><a id="linkMp3Emission">Fichier de l'&eacute;mission</a> (<span id="timeMp3Emission"></span>)</span>
				<form id="formUploadMp3" method="POST" enctype="multipart/form-data">
					<input type="file" id="fileMp3Emission" name="fileEmission" onchange="return validateExtension(this, 'mp3');" /> 
					<input id="fileMp3EmissionButton" class="button" type="submit" value="Uploader" /><input id="fileMp3DeleteButton" type="button" class="button" onclick="deleteFile('mp3');" value="Supprimer" /><br />
					<span id="fileMp3EmissionError" style="color:red;"></span>
					<input type="hidden" id="numeroEmissionForUploadMp3" name="numero"/>
					<input type="hidden" name="folder" value="<?php echo $mp3s ?>"/>
					<input type="hidden" name="extension" value=".mp3"/>
				</form>
			</fieldset>
			<fieldset id="mp3Teaser">
			<legend>[<span style="color:red;">TEASER</span>] Fichier MP3 du teaser</legend>
				<form id="formUploadMp3Teaser" method="POST" enctype="multipart/form-data">
					<input type="file" id="fileMp3Teaser" name="fileEmission" onchange="return validateExtension(this, 'mp3');" /> 
					<input id="fileMp3TeaserButton" class="button" type="submit" value="Uploader" /><input id="fileMp3TeaserDeleteButton" type="button" class="button" onclick="deleteFile('teaserMp3');" value="Supprimer" /><br />
					<span id="fileMp3TeaserError" style="color:red;"></span>
					<input type="hidden" id="numeroTeaserForUploadMp3" name="numero"/>
					<input type="hidden" name="folder" value="<?php echo $mp3s ?>"/>
					<input type="hidden" name="extension" value=".mp3"/>
				</form>
				<br />
				<span id="noMp3Teaser" style="color:red;"><i>Aucun fichier mp3 n'a &eacute;t&eacute; trouv&eacute;.</i></span>
				<span id="yesMp3Teaser"><a id="linkMp3Teaser">Fichier du teaser</a></span>
			</fieldset>
			<fieldset id="videoTeaser">
			<legend>[<span style="color:red;">TEASER</span>] Adresse YOUTUBE/VIMEO du teaser vid&eacute;o</legend>
				<input type="hidden" id="txtChelouQuiContientLidDeLemissionEtQueSiIlNestPasLaAlorsLaZoneSuivanteNeFonctionnePlus" /> 
				<input type="text" id="txtVideoTeaser" style="width:265px;" onkeyup="return validateAdresseYoutube(this);" /> 
				<input id="txtVideoTeaserButton" type="button" class="button" value="Modifier" onclick="updateVideoTeaser()" /><br />
				<span id="txtVideoTeaserError" style="color:red;"></span>
				<br />
				<span id="noVideoTeaser" style="color:red;"><i>Aucun teaser vid&eacute;o n'a &eacute;t&eacute; trouv&eacute;.</i></span>
				<span id="yesVideoTeaser">
					<div id="divVideoTeaserYoutube">
						<object width="265" height="200">
							<param id="linkVideoTeaserValue" name="movie"></param>
							<param name="allowFullScreen" value="true"></param>
							<param name="allowscriptaccess" value="always"></param>
							<embed id="linkVideoTeaserSrc" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="265" height="200"></embed>
						</object>
					</div>
					<div id="divVideoTeaserVimeo">
						<iframe id="iframeVideoTeaserVimeo" width="265" height="200" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
					</div>
				</span>
			</fieldset>
		</td></tr>
		<tr>
			<td colspan="2">
				<fieldset id="morceaux" style="width:100%">
				<legend>Playlist de l'&eacute;mission</legend>
				<span id="noMorceaux" style="color:red;"><i>Pas de participant, pas de morceaux !</i></span>
				<span id="haveMorceaux">
					<br />
					<b><u>Attention :</u></b> 
					<br />Chaque ligne doit être écrite comme ça :
					<br /><br /><br />
					<span id="haveMorceauxExample">
						<span id="exampleNomMorceau">00:00 Artiste - Nom morceau</span>
					</span>
				</span>
				<br />
				<ul id="listeMorceaux">
				</ul>
				</fieldset>		
			</td>
		</tr>
		</table>
	</div>
	<!-- affichage de la page contenu -->
	<div id="contenuPageSite">
		<h3>Edition du contenu des pages :</h3>
		<br />
		<u>Voici la liste des pages et leur contenu paramétrable :</u>
		<br />
		<br />
		<table id="listeContenuPageSite">
		</table>
	</div>
	<!-- affichage des utilisateurs -->
	<div id="users">
			<!-- edition d'un utilisateur -->
			<h3>Liste des utilisateurs : <input type="button" class="button" value="Ajouter un utilisateur" onclick="newUser();" /></h3>
			<div id="user">
			<table id="editUser" cellspacing="0">
			</table>
			</div>
			<span><i>En rouge</i> : Utilisateurs non utilis&eacute;s (ils peuvent &ecirc;tre supprim&eacute;s)</span><br />
			<span><i>En jaune</i> : Chef d'une &eacute;mission annonc&eacute;e sur la page news (ils peuvent faire des choses dans leur acc&egrave;s CHEF)</span><br />
			<span><img src="css/chef_ok.gif" /> : Chefs avec un acc&egrave;s CHEF !</span><br />
			<span><img src="css/chef_ko.gif" /> : Chefs sans acc&egrave;s CHEF (manque mail ou mot de passe)</span><br />
			<br />
			<table id="listeUsers" class="tableaux">
			</table>
	</div>
	<!-- affichage des artistes et des labels -->
	<div id="artistesLabels">
		<table>
			<tr><td>
				<div id="artistes">
					<h3>Liste des artistes :</h3>
					<table id="editArtiste" cellspacing="0">
					</table>
					<br />
					<table id="listeArtistes" class="tableaux">
					</table>
				</div>
			</td><td>
				<div id="labels">
					<h3>Liste des labels :</h3>
					<table id="editLabel" cellspacing="0">
					</table>
					<br />
					<table id="listeLabels" class="tableaux">
					</table>
				</div>
			</td></tr>
		</table>
	</div>
	
	<!-- affichage des newsletter -->
	<div id="newsletter">
		<h3>Newsletters : <input id="boutonAddNewsletter" type="button" class="button" value="Envoyer une nouvelle newsletter" /></h3>
		<table>
			<tr><td>
				<u>Voici la liste des newsletters :</u>
				<br />
				<br />
				<table id="listeNewsletter">
				</table>
			</td><td>
				<u>Voici la liste des mails inscrits :</u>
				<br />
				<br />
				<table id="listeMailNewsletter">
				</table>
			</td></tr>
		</table>
	</div>

	<!-- affichage des newsletter -->
	<div id="news">
		<h3>News : <input id="boutonAddNews" type="button" class="button" value="Ajouter une nouvelle news" /></h3>
		<u>Voici la liste des news :</u>
		<br />
		<br />
		<table id="listeNews">
		</table>
	</div>

	<!-- affichage des bonus -->
	<div id="bonus">
		<h3>Bonus : <input id="boutonAddBonus" type="button" class="button" value="Ajouter une nouveau bonus" /></h3>
		<u>Voici la liste des bonus :</u>
		<br />
		<br />
		<table id="listeBonus">
		</table>
	</div>

</div>
<br />
<br />

	<script type="text/javascript">
		if (admin == '')
		{
			display('home');
			//showTodoList();
			if (isMultiAdmin)
				document.getElementById('autresSites').style.display = 'block';
			else
				document.getElementById('autresSites').style.display = 'none';
			
			
			var ddlTypeContenu = document.getElementById('formContenuType');
			while (ddlTypeContenu.hasChildNodes())
				ddlTypeContenu.removeChild(ddlTypeContenu.firstChild);
				
			getDatas('dbListeAllTypeContenu', 'listeAllTypeContenu', '');
			
			for(var i=0; i<listeAllTypeContenu.length; i++)
			{
				var optionTypeContenu = document.createElement("option");
				optionTypeContenu.value = listeAllTypeContenu[i].id;
				optionTypeContenu.text = listeAllTypeContenu[i].libelle;
				ddlTypeContenu.appendChild(optionTypeContenu);
			}
			
			var boutonValiderContenu = document.getElementById('boutonValiderContenu');
			var boutonAnnulerContenu = document.getElementById('boutonAnnulerContenu');
		}
		else
			display('adminChef');
			
		document.getElementById('exampleNomMorceau').innerHTML = templateNommageMorceauxEmission.replace('{time_min}', '00').replace('{time_sec}', '00').replace('{nom_artiste}', 'Artiste').replace('{nom_morceau}', 'Nom du morceau').replace('{nom_label}', 'Nom du label').replace('{annee}', 'Année de sortie');
	</script>
</body>
</html>
