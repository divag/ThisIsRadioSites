  // ------------- AVEC JQUERY -------------
  // Fonction lancer une fois la page chargée
   $(document).ready(function(){
    
     // Une fois la page prête (DOM ready), on prépare le formulaire d'Upload
      var optionsPochette = { 
        //target:        '#formUploadPochette #message',   // target element(s) to be updated with server response 
        beforeSubmit:  fonctionAvantUploadImage,      // pre-submit callback 
        success:       refreshImageFormZoneAfterUpload,      // post-submit callback 
 
        // other available options: 
		//upload_image.php
		async: false,
        url:  '../dbFunctions/imageReceptor.php',         // override for form's 'action' attribute 
        type: 'POST',                     // 'get' or 'post', override for form's 'method' attribute 
        contentType: 'multipart/form-data'
    }; 
     // Une fois la page prête (DOM ready), on prépare le formulaire d'Upload
      var optionsPochetteToPrint = { 
        //target:        '#formUploadPochette #message',   // target element(s) to be updated with server response 
        beforeSubmit:  fonctionAvantUploadImage,      // pre-submit callback 
        success:       refreshImageToPrintFormZoneAfterUpload,      // post-submit callback 
 
        // other available options: 
		//upload_image.php
		async: false,
        url:  '../dbFunctions/imageReceptor.php',         // override for form's 'action' attribute 
        type: 'POST',                     // 'get' or 'post', override for form's 'method' attribute 
        contentType: 'multipart/form-data'
    }; 
     // Une fois la page prête (DOM ready), on prépare le formulaire d'Upload
      var optionsPochetteGif = { 
        //target:        '#formUploadPochette #message',   // target element(s) to be updated with server response 
        beforeSubmit:  fonctionAvantUploadImage,      // pre-submit callback 
        success:       refreshImageGifFormZoneAfterUpload,      // post-submit callback 
 
        // other available options: 
		//upload_image.php
		async: false,
        url:  '../dbFunctions/imageReceptor.php',         // override for form's 'action' attribute 
        type: 'POST',                     // 'get' or 'post', override for form's 'method' attribute 
        contentType: 'multipart/form-data'
    }; 
      var optionsContenuImage = { 
        //target:        '#formUploadPochette #message',   // target element(s) to be updated with server response 
        beforeSubmit:  fonctionAvantUploadContenuImage,      // pre-submit callback 
        success:       refreshContenuImageFormZoneAfterUpload,      // post-submit callback 
 
        // other available options: 
		//upload_image.php
		async: false,
        url:  '../dbFunctions/imageReceptor.php',         // override for form's 'action' attribute 
        type: 'POST',                     // 'get' or 'post', override for form's 'method' attribute 
        contentType: 'multipart/form-data'
    }; 
      var optionsMp3 = { 
        //target:        '#upload #message',   // target element(s) to be updated with server response 
        beforeSubmit:  fonctionAvantUploadMp3,      // pre-submit callback 
        success:       refreshMp3FormZoneAfterUpload,      // post-submit callback 
 
        // other available options: 
		//upload_image.php
		async: false,
        url:  '../dbFunctions/imageReceptor.php',         // override for form's 'action' attribute 
        type: 'POST',                     // 'get' or 'post', override for form's 'method' attribute 
        contentType: 'multipart/form-data'
    }; 
      var optionsMp3Teaser = { 
        //target:        '#upload #message',   // target element(s) to be updated with server response 
        beforeSubmit:  fonctionAvantUploadMp3Teaser,      // pre-submit callback 
        success:       refreshMp3TeaserFormZoneAfterUpload,      // post-submit callback 
 
        // other available options: 
		//upload_image.php
		async: false,
        url:  '../dbFunctions/imageReceptor.php',         // override for form's 'action' attribute 
        type: 'POST',                     // 'get' or 'post', override for form's 'method' attribute 
        contentType: 'multipart/form-data'
    }; 
 
    // bind form using 'ajaxForm' 
    $('#formUploadContenuImage').ajaxForm(optionsContenuImage); 
    $('#formUploadPochette').ajaxForm(optionsPochette); 
    $('#formUploadPochetteToPrint').ajaxForm(optionsPochetteToPrint); 
    $('#formUploadPochetteGif').ajaxForm(optionsPochetteGif); 
    $('#formUploadMp3').ajaxForm(optionsMp3); 
    $('#formUploadMp3Teaser').ajaxForm(optionsMp3Teaser); 
     
    
 });   
// --------------    UPLOAD
// pre-submit callback 
function fonctionAvantUploadContenuImage(formData, jqForm, options) { 
	changeWaitMessage("<b>Upload de l'image sélectionnée ...</b><br /><br />Cela peut être long si le fichier est volumineux.<br /><br /> <span style=\"color:red;\">Si vous avez le temps de lire ce message, il faudrait penser à mettre un fichier moins lourd...!</span>");
	showWait();
    var queryString = $.param(formData); 
    return true; 
} 

function fonctionAvantUploadImage(formData, jqForm, options) { 
	changeWaitMessage("<b>Upload de l'image sélectionnée ...</b><br /><br />Cela peut être long si le fichier est volumineux.<br /><br /> <span style=\"color:red;\">Si vous avez le temps de lire ce message, il faudrait penser à mettre un fichier moins lourd...!</span>");
	showWait();
    var queryString = $.param(formData); 
    return true; 
} 

function fonctionAvantUploadMp3(formData, jqForm, options) { 
	changeWaitMessage("<b>Upload du mp3 de l'émission en cours ...</b><br /><br />Cela peut durer jusqu'à 15 minutes, cela est normal car le fichier est volumineux.<br /><br /><span style=\"color:red;\"><b>Merci de vérifier que votre fichier pèse <u>moins de 150Mo</u> !!</b><br />Si ce n'est pas le cas, merci de fermer la fenêtre et de recommencer l'opération.</span>");
	showWait();
    var queryString = $.param(formData); 
    return true; 
} 

function fonctionAvantUploadMp3Teaser(formData, jqForm, options) { 
	changeWaitMessage("<b>Upload du teaser MP3 de l'émission ...</b><br /><br />Cela peut être long si le fichier est volumineux.<br /> Ne pas s'inquiéter.");
	showWait();
    var queryString = $.param(formData); 
    return true; 
} 

function hideWait()
{
	document.getElementById('divWait').style.display = 'none';
}

function showWait()
{
	document.getElementById('divWait').style.display = 'block';
}

function initialiseWaitMessage()
{	
	document.getElementById('spanWait').innerHTML = "Veuillez patienter ...";
}

function changeWaitMessage(message)
{	
	document.getElementById('spanWait').innerHTML = message;
}

function getDatas(functionName, variableName, functionParams)
{
	showWait();
    var urlFunction = urlBaseFunction + functionName + '.php';

    if (functionParams != '')
        functionParams = 'variable=' + variableName + '&' + unescape(functionParams);
    else
        functionParams = 'variable=' + variableName;
    
    $.ajax({  url: urlFunction, 
              type: 'POST', 
              processData: false,
              data: functionParams, 
              async: false,
    error: function(){
        			alert('Problème de connexion au serveur... Il vaut mieux partir...');
		},
		success: function(data){
        			eval(data);
					hideWait();
		}	
	});
}

var alternate = 1;
var currentItem = '';
var isNew = false;
var ordreParticipant = 1;
var ordreGoodiesEmission = 1;
var currentPage = 'home';

function display(page)
{
	if (admin != '' && page != 'playlists' && page != 'playlist')
		page = 'playlists';
	
	currentPage = page;
		
	document.getElementById('playlists').style.display = 'none';
	document.getElementById('playlist').style.display = 'none';
	document.getElementById('news').style.display = 'none';
	document.getElementById('newsletter').style.display = 'none';
	document.getElementById('users').style.display = 'none';
	document.getElementById('artistesLabels').style.display = 'none';
	document.getElementById('bonus').style.display = 'none';
	document.getElementById('contenuPageSite').style.display = 'none';
	document.getElementById('home').style.display = 'none';
	document.getElementById('editeurContenu').style.display = 'none';
	
	document.getElementById(page).style.display = 'block';
	
	if (admin == '')
	{
		document.getElementById('buttonMenuhome').style.color = 'black';
		document.getElementById('buttonMenuplaylists').style.color = 'black';
		document.getElementById('buttonMenunews').style.color = 'black';
		document.getElementById('buttonMenunewsletter').style.color = 'black';
		document.getElementById('buttonMenuusers').style.color = 'black';
		document.getElementById('buttonMenuartistesLabels').style.color = 'black';
		document.getElementById('buttonMenubonus').style.color = 'black';
		document.getElementById('buttonMenucontenuPageSite').style.color = 'black';
		
		document.getElementById('texteChef').style.display = 'none';
		document.getElementById('mailAdmin').style.display = 'none';
		
		if (!siteHaveParticipants)
			document.getElementById('buttonMenuusers').style.display = 'none';
			
		if (!siteHaveBonus)
			document.getElementById('buttonMenubonus').style.display = 'none';
			
		if (!siteHaveNews)
			document.getElementById('buttonMenunews').style.display = 'none';
			
		if (!siteHaveNewsletter)
			document.getElementById('buttonMenunewsletter').style.display = 'none';
			
		if (!siteHaveContenuPages)
			document.getElementById('buttonMenucontenuPageSite').style.display = 'none';
			
		if (!siteHaveLabel)
			document.getElementById('buttonMenuartistesLabels').value = document.getElementById('buttonMenuartistesLabels').value.replace(' / Labels', '');
	}
	else
	{
		document.getElementById('buttonMenuhome').style.display = 'none';
		document.getElementById('buttonMenuplaylists').style.display = 'none';
		document.getElementById('buttonMenuusers').style.display = 'none';
		document.getElementById('buttonMenucontenuPageSite').style.display = 'none';
		document.getElementById('buttonMenubonus').style.display = 'none';
		document.getElementById('buttonMenunews').style.display = 'none';
		document.getElementById('buttonMenunewsletter').style.display = 'none';
		document.getElementById('buttonMenuartistesLabels').style.display = 'none';
		
		document.getElementById('ajoutEmission').style.display = 'none';
		document.getElementById('txtEnvoiMail').value = '';
		document.getElementById('boutonEnvoiMail').disabled = true;
	}

	if (page != 'playlist' && page != 'editeurContenu')
	{
		document.getElementById('buttonMenu' + page).style.color = 'red';
	}
	
	if (page == 'home')
	{
		document.getElementById('home').style.display = 'block';
	}

	if (page == 'playlists')
	{
		if (admin == '')
			getDatas('dbListeAllEmission', 'listeEmissions', 'id_site=' + id_site);
		else
		{
			if (siteHaveStatutAnnounced)
				getDatas('dbListeAllEmissionForChef', 'listeEmissions', 'id_site=' + id_site + '&admin=' + encode(admin));
			else
				getDatas('dbListeAllEmissionForChefSansAnnonce', 'listeEmissions', 'id_site=' + id_site + '&admin=' + encode(admin));
		}
		if (listeEmissions.length == 0)
			document.getElementById('spanChefNoEmission').style.display = 'block';
		else
			document.getElementById('spanChefNoEmission').style.display = 'none';
		
		alternate = 1;
		
		while (document.getElementById('listeEmissions').hasChildNodes())
			document.getElementById('listeEmissions').removeChild(document.getElementById('listeEmissions').firstChild);

		for(var i=0; i<listeEmissions.length; i++)
			document.getElementById('listeEmissions').appendChild(createLigneEmission(listeEmissions[i]));			
	}

	if (page == 'playlist')
	{
		document.getElementById('txtNumeroEmission').value = currentItem.numero;
		document.getElementById('txtNumeroEmission').disabled = (!isNew || currentItem.etat == 3);
		document.getElementById('txtNumeroEmissionError').innerHTML = '';
		
		document.getElementById('txtTitreEmission').value = decode(currentItem.titre);
		document.getElementById('txtTitreEmissionError').innerHTML = '';
		document.getElementById('txtDateEmission').value = currentItem.date_sortie;
		document.getElementById('txtDateEmission').disabled = (currentItem.etat == 3);
		document.getElementById('lblDateEmission').style.display = 'none';
		document.getElementById('lblDateEmissionPublie').style.display = 'none';
		document.getElementById('txtDateEmissionError').innerHTML = '';
		document.getElementById('boutonUpdateZipEmission').style.display = 'none';
				
		if (currentItem.titre != '' || !siteHaveTitre)
			document.getElementById('emission').className = 'etat32';
		else
			document.getElementById('emission').className = 'etat42';
		
		if (currentItem.etat == 3)
			document.getElementById('lblDateEmissionPublie').style.display = 'block';
		else
			document.getElementById('lblDateEmission').style.display = 'block';

		if (!siteHaveTitre && !siteHaveStatutAnnounced)
		{
			document.getElementById('formEnregistrerAnnuler').style.display = 'none';
			document.getElementById('formEnregistrer').style.display = 'none';
		}
		else
		{
			document.getElementById('formEnregistrerAnnuler').style.display = 'block';
			document.getElementById('formEnregistrer').style.display = 'block';
		}
		
		if (siteHaveZip && currentItem.etat == 3)
			document.getElementById('boutonUpdateZipEmission').style.display = 'block';

		if (admin != '')
		{
			document.getElementById('txtNumeroEmission').disabled = true;
			document.getElementById('txtTitreEmission').disabled = true;
			document.getElementById('trDateEmission').style.display = 'none';
			document.getElementById('trBoutonsEmission').style.display = 'none';
			document.getElementById('boutonAddParticipant').style.display = 'none';
		}

		if (!siteHaveStatutAnnounced)
			document.getElementById('trDateEmission').style.display = 'none';

		if (!siteHaveTitre)
			document.getElementById('trTitreEmission').style.display = 'none';
				
		refreshTextePresentation();
		refreshImageFormZone();
		refreshImageToPrintFormZone();
		refreshImageGifFormZone();
		refreshMp3FormZone();
		refreshMp3TeaserFormZone();
		refreshVideoTeaserFormZone();
		refreshGoodiesEmission();
		refreshParticipants();
	}
	else 
	{
		if (page != 'editeurContenu')
		{
			isNew = false;
			currentItem = '';
		}
	}	
	
	if (page == "contenuPageSite")
		refreshContenuPageSite();		
	
	if (page == "news")
		refreshNews();		
	
	if (page == "newsletter")
		refreshNewsletter();		
	
	if (page == "bonus")
		refreshBonus();		
	
	if (page == "artistesLabels")
		refreshArtistesLabel();		
	
	if (page == 'users')
	{
		//On masque le formulaire de création d'un user :
		while (document.getElementById('editUser').hasChildNodes())
			document.getElementById('editUser').removeChild(document.getElementById('editUser').firstChild);
	
		//Vidage + Affichage de la liste des utilisateurs.
		refreshUtilisateurs();		
	}

	hideWait();
	window.location.href = "#top";
}

function envoiPlaylistAdmin()
{
	showWait();
	var txtToSend = document.getElementById('txtEnvoiMail').value.replace(/\n/g, '\n<br />');
	envoiMailAdmin(currentItem.numero, txtToSend, 'playlist');
	document.getElementById('txtEnvoiMail').value = '';
	hideWait();
	alert('Votre playlist a été envoyée !');
}

function envoiMailAdmin(numero, action, objet)
{
	if (admin != '')
		getDatas('sendMailAdmin', '', 'login=' + encode(admin) + '&action=' + encode(action) + '&numero=' + encode(numero) + '&objet=' + encode(objet));
}

function showAddParticipant()
{
	document.getElementById('addParticipant').style.display = 'block';
	document.getElementById('formAddParticipant').disabled = (!Verif_NonVide(document.getElementById('txtNomParticipant')));
	
	while (document.getElementById('listeAllUsersAndGroupes').hasChildNodes())
		document.getElementById('listeAllUsersAndGroupes').removeChild(document.getElementById('listeAllUsersAndGroupes').firstChild);

	getDatas('dbGetListeAllParticipantsAndUsers', 'allUsersAndGroupes', 'id_site=' + id_site);
	document.getElementById('listeAllUsersAndGroupes').appendChild(createBlankOptionParticipant());
	for(var i=0; i<allUsersAndGroupes.length; i++)
		document.getElementById('listeAllUsersAndGroupes').appendChild(createOptionParticipant(allUsersAndGroupes[i]));			
}

function createBlankOptionParticipant()
{
	option = document.createElement('option');
	option.value = '';
	option.innerHTML = 'Choisir qqun qui est déjà rentré...';
	return option;
}

function createOptionParticipant(participant)
{
	option = document.createElement('option');
	option.value = participant.nom;
	option.innerHTML = participant.nom;
	return option;
}

function hideAddParticipant()
{
	document.getElementById('addParticipant').style.display = 'none';
	document.getElementById('txtNomParticipantError').innerHTML = '';
	document.getElementById('txtNomParticipant').value = '';
	document.getElementById('listeAllUsersAndGroupes').value = '';
}

function refreshUtilisateurs()
{
	document.getElementById('listeUsers').style.display = 'block';
		
	while (document.getElementById('listeUsers').hasChildNodes())
		document.getElementById('listeUsers').removeChild(document.getElementById('listeUsers').firstChild);

	getDatas('dbListeAllUtilisateurs', 'listeAllUsers', 'id_site=' + id_site);
	alternate = 1;
		
	for(var i=0; i<listeAllUsers.length; i++)
	{
		document.getElementById('listeUsers').appendChild(createLigneUtilisateur(listeAllUsers[i]));			
	}
}

function refreshNews()
{
	var boutonAddNews = document.getElementById('boutonAddNews');				
	boutonAddNews.onclick = function () {
		
		getDatas('dbInsertAndGetNews', 'newNews', "id_site=" + id_site + "&titre=&id_utilisateur=" + id_utilisateur);

		var postAction = function() {
			//Retour à la page de l'émission :
			getDatas('dbUpdateTitreNews', '', 'id=' + newNews.id + '&titre=' + encode(document.getElementById('txtTitreNewsContenu' + newNews.id).value));
			videAdditionnalContenu();
			display('news');
		}
		var postActionCancel = function() {
			//Retour à la page de l'émission :
			getDatas('dbDeleteNews', '', 'id=' + newNews.id);
			videAdditionnalContenu();
			display('news');
			window.location.href = "#top";
		}
		
		var txtTitreNewsContenu = document.createElement('input');
		txtTitreNewsContenu.id = 'txtTitreNewsContenu' + newNews.id;
		txtTitreNewsContenu.type = 'text';
		txtTitreNewsContenu.style.width = '100%';
		txtTitreNewsContenu.value = newNews.titre;
		var brTitreNewsContenu = document.createElement('br');
		var spanTitreNewsContenuError = document.createElement('span');
		spanTitreNewsContenuError.id = 'txtTitreNewsContenu' + newNews.id + 'Error';
		spanTitreNewsContenuError.style.color = 'red';
		
		txtTitreNewsContenu.onchange = function () {
			document.getElementById('boutonValiderContenu').disabled = (!Verif_NonVide(this))
		}
		document.getElementById('contenuAdditionnal').appendChild(txtTitreNewsContenu);
		document.getElementById('contenuAdditionnal').appendChild(brTitreNewsContenu);
		document.getElementById('contenuAdditionnal').appendChild(spanTitreNewsContenuError);
		displayFormEditContenu(newNews, postAction, postActionCancel, true);
		document.getElementById('boutonValiderContenu').disabled = (!Verif_NonVide(document.getElementById('txtTitreNewsContenu' + newNews.id)));
	}
		
	while (document.getElementById('listeNews').hasChildNodes())
		document.getElementById('listeNews').removeChild(document.getElementById('listeNews').firstChild);

	//Récupération et affichage de la liste des contenus existants :
	getDatas('dbGetListeNews', 'listeNews', "id_site=" + id_site);
	alternate = 1;
				
	for(var i=0; i<listeNews.length; i++)
	{
		document.getElementById('listeNews').appendChild(createLigneNews(listeNews[i]));			
	}
}

function videAdditionnalContenu()
{
	while (document.getElementById('contenuAdditionnal').hasChildNodes())
		document.getElementById('contenuAdditionnal').removeChild(document.getElementById('contenuAdditionnal').firstChild);
}

function createLigneNews(newsData)
{
	var tr = document.createElement('tr');
	
	var td1 = document.createElement('td');
	td1.className = 'padded';
	if (newsData.date == '0000-00-00 00:00:00')
	{
		tr.className = 'etat11';
		td1.innerHTML = "<i>Non publiée</i><br />";
		
		if (newsData.titre != '' && (newsData.contenu_fr != '' || newsData.contenu_en != ''))
		{
			tr.className = 'etat22';
			
			var boutonPublier = document.createElement('input');
			boutonPublier.type = 'button';
			boutonPublier.className = 'button';
			boutonPublier.value = 'Publier';
			boutonPublier.onclick = function () {			
				if (confirm('Etes-vous certain de vouloir publier cette news ?'))
				{
					getDatas('dbPublishNews', '', 'id=' + newsData.id);
					refreshNews();
				}
			}
			td1.appendChild(boutonPublier);
		}
	}
	else
	{
		tr.className = 'etat32';
		td1.innerHTML = newsData.date;
	}
	
	var td2 = document.createElement('td');
	td2.className = 'padded';
	if (newsData.titre == '')
		td2.innerHTML = "<font color='red'><b>Pas de titre !</b></font>";
	else
		td2.innerHTML = "<b><u>" + newsData.titre + "</u></b>";
	var br = document.createElement('br');
	td2.appendChild(br);
	var br2 = document.createElement('br');
	td2.appendChild(br2);
	var previewNews = getPreviewContenu(newsData);
	td2.appendChild(previewNews);
	var br3 = document.createElement('br');
	td2.appendChild(br3);
	
	var td4 = document.createElement('td');
	td4.className = 'actionEmission';
	
	var td5 = document.createElement('td');	
	td5.className = 'actionEmission';

	var boutonModifier = document.createElement('input');
	boutonModifier.type = "button";
	boutonModifier.className = "button";
	boutonModifier.value = "Modifier";	
	boutonModifier.onclick = function () {
		var postAction = function() {
			getDatas('dbUpdateTitreNews', '', 'id=' + newsData.id + '&titre=' + encode(document.getElementById('txtTitreNewsContenu' + newsData.id).value));
			videAdditionnalContenu();
			display('news');
		}
		var postActionCancel = function() {
			//Retour à la page de l'émission :
			videAdditionnalContenu();
			display('news');
			window.location.href = "#top";
		}
		
		var txtTitreNewsContenu = document.createElement('input');
		txtTitreNewsContenu.id = 'txtTitreNewsContenu' + newsData.id;
		txtTitreNewsContenu.type = 'text';
		txtTitreNewsContenu.style.width = '100%';
		txtTitreNewsContenu.value = newsData.titre;
		var brTitreNewsContenu = document.createElement('br');
		var spanTitreNewsContenuError = document.createElement('span');
		spanTitreNewsContenuError.id = 'txtTitreNewsContenu' + newsData.id + 'Error';
		spanTitreNewsContenuError.style.color = 'red';
		
		txtTitreNewsContenu.onchange = function () {
			document.getElementById('boutonValiderContenu').disabled = (!Verif_NonVide(this))
		}

		document.getElementById('contenuAdditionnal').appendChild(txtTitreNewsContenu);
		document.getElementById('contenuAdditionnal').appendChild(brTitreNewsContenu);
		document.getElementById('contenuAdditionnal').appendChild(spanTitreNewsContenuError);
		displayFormEditContenu(newsData, postAction, postActionCancel, true);
		document.getElementById('boutonValiderContenu').disabled = (!Verif_NonVide(document.getElementById('txtTitreNewsContenu' + newsData.id)));
	}
	
	td4.appendChild(boutonModifier);

	var boutonSupprimer = document.createElement('input');
	boutonSupprimer.value = "Supprimer";
	boutonSupprimer.type = "button";
	boutonSupprimer.className = "button";
	boutonSupprimer.style.color = "red";
	boutonSupprimer.onclick = function () {
		if (confirm('Etes-vous certain de vouloir supprimer ce contenu ?'))
		{
			getDatas('dbDeleteNews', '', 'id=' + newsData.id);
			refreshNews();
		}
	}
	td5.appendChild(boutonSupprimer);
		
	tr.appendChild(td1);
	tr.appendChild(td2);
	//tr.appendChild(td3);	
	tr.appendChild(td4);		
	tr.appendChild(td5);
	
	return tr;
}

function refreshNewsletter()
{
	refreshMailNewsletter();
	
	
}

function createLigneNewsletter(newsletterData)
{

}

function refreshMailNewsletter()
{

}

function createLigneMailNewsletter(newsletterData)
{
	
}

function refreshBonus()
{

}

function createLigneBonus(bonusData)
{

}

function refreshArtistesLabels()
{
	//Gestion des artistes :
	
	
	//Gestion des labels :
	if (!siteHaveLabel)
	{
		document.getElementById('labels').style.display = 'none';
	}
	else
	{
	
	}
}

function createLigneArtiste(artisteData)
{

}

function createLigneLabel(labelData)
{

}

function refreshGoodiesEmission()
{
	if (isNew || !siteHaveGoodies || admin != '')
	{
		document.getElementById('goodiesEmission').style.display = 'none';
	}
	else
	{
		document.getElementById('goodiesEmission').style.display = 'block';
				
		var boutonAddGoodiesEmission = document.getElementById('boutonAddGoodiesEmission');				
		boutonAddGoodiesEmission.onclick = function () {
		
			getDatas('dbInsertAndGetGoodiesEmission', 'newGoodiesEmission', "id_emission=" + currentItem.id);
					
			var postAction = function() {
				//Retour à la page de l'émission :
				updateZipEmission();
				display('playlist');
			}
			var postActionCancel = function() {
				//Retour à la page de l'émission :
				getDatas('dbDeleteGoodiesEmission', '', 'id_emission=' + currentItem.id + '&id_contenu=' + newGoodiesEmission.id_contenu);
				display('playlist');
				window.location.href = "#top";
			}
			displayFormEditContenu(newGoodiesEmission, postAction, postActionCancel, true);
		}

		while (document.getElementById('listeGoodiesEmission').hasChildNodes())
			document.getElementById('listeGoodiesEmission').removeChild(document.getElementById('listeGoodiesEmission').firstChild);

		//Récupération et affichage de la liste des contenus existants :
		getDatas('dbGetListeGoodiesEmission', 'listeGoodiesEmission', "id_emission=" + currentItem.id);
		alternate = 1;
		ordreGoodiesEmission = 1;
					
		for(var j=0; j<listeGoodiesEmission.length; j++)
		{
			document.getElementById('listeGoodiesEmission').appendChild(createLigneGoodiesEmission(listeGoodiesEmission[j]));			
		}
	}
}

function getPreviewContenu(contenuData)
{	
	if (contenuData.id_contenu == undefined && contenuData.id != undefined)
		contenuData.id_contenu = contenuData.id;
		
	if (contenuData.id_type_contenu != 0)
	{
		if (contenuData.id_type_contenu == 1)
		{
			var retour = document.createElement('span');
			retour.style.width = '100%';
			retour.className = 'padded';
			
			var spanTexteFrancais = document.createElement('span');
			spanTexteFrancais.innerHTML = "<u>Texte en français :</u> <br /><br />"
			
			var divFrancais = document.createElement('div');
			divFrancais.style.width = '100%';
			divFrancais.className = 'padded';
			if (contenuData.contenu_fr == '')
				divFrancais.innerHTML = "<font color='red'><i>Pas de texte</i></font>";
			else
				divFrancais.innerHTML = contenuData.contenu_fr;

			var spanTexteAnglais = document.createElement('span');
			spanTexteAnglais.innerHTML = "<br /><u>Texte en anglais :</u> <br /><br />"
			
			var divAnglais = document.createElement('div');
			divAnglais.style.width = '100%';
			divAnglais.className = 'padded';
			if (contenuData.contenu_en == '')
				divAnglais.innerHTML = "<font color='red'><i>Pas de texte</i></font>";
			else
				divAnglais.innerHTML = contenuData.contenu_en;

			retour.appendChild(spanTexteFrancais);
			retour.appendChild(divFrancais);
			retour.appendChild(spanTexteAnglais);
			retour.appendChild(divAnglais);
		}
		if (contenuData.id_type_contenu == 2)
		{
			
		}
		if (contenuData.id_type_contenu == 3)
		{
			
		}
		if (contenuData.id_type_contenu == 4)
		{
			
		}
		if (contenuData.id_type_contenu == 5)
		{
			
		}
		if (contenuData.id_type_contenu == 6)
		{
			var retour = document.createElement('object');
			retour.width = '265';
			retour.height = '200';
			var param1 = document.createElement('param');
			param1.id = 'linkVideoGoodiesEmission_' + contenuData.id_contenu;
			param1.value = contenuData.url;
			param1.name = 'movie';
			var param2 = document.createElement('param');
			param2.name = 'allowFullScreen';
			param2.value = 'true';
			var param3 = document.createElement('param');
			param3.name = 'allowscriptaccess';
			param3.value = 'always';
			var embed = document.createElement('embed');
			embed.id = 'linkVideoGoodiesEmission_' + contenuData.id_contenu + 'src';
			embed.src = contenuData.url;
			embed.type = 'application/x-shockwave-flash';
			embed.allowscriptaccess = 'always';
			embed.allowfullscreen = 'true';
			embed.width = '265';
			embed.height = '200';

			retour.appendChild(param1);
			retour.appendChild(param2);
			retour.appendChild(param3);
			retour.appendChild(embed);
		}
	}
	else
	{
		var retour = document.createElement('span');
		retour.style.color = 'red';
		retour.innerHTML = 'Pas de contenu !';
	}
	
	return retour;
}

function createLigneGoodiesEmission(goodiesEmissionData)
{
	var tr = document.createElement('tr');
	tr.className = 'etat32';
	
	goodiesEmissionData.ordre = ordreGoodiesEmission;
	
	var td1 = document.createElement('td');
	td1.className = 'padded';
	td1.innerHTML = goodiesEmissionData.ordre;

	var td2 = document.createElement('td');
	td2.style.width = '80px';

	var linkMonterGoodies = document.createElement('input');
	linkMonterGoodies.type = 'button';
	linkMonterGoodies.className = 'button';
	linkMonterGoodies.value = '+';
	linkMonterGoodies.disabled = (goodiesEmissionData.ordre == 1);
	linkMonterGoodies.onclick = function () {
		getDatas('dbUpdateOrdreGoodiesEmission', 'result', 'id_emission=' + currentItem.id + '&ordre=' + goodiesEmissionData.ordre + '&newvalue=' + (parseInt(goodiesEmissionData.ordre)-1));
		refreshGoodiesEmission();
	}
	td2.appendChild(linkMonterGoodies);
	
	var linkDescendreGoodies = document.createElement('input');
	linkDescendreGoodies.type = 'button';
	linkDescendreGoodies.className = 'button';
	linkDescendreGoodies.value = '-';
	linkDescendreGoodies.disabled = (goodiesEmissionData.ordre == listeGoodiesEmission.length);
	linkDescendreGoodies.onclick = function () {
		getDatas('dbUpdateOrdreGoodiesEmission', 'result', 'id_emission=' + currentItem.id + '&ordre=' + goodiesEmissionData.ordre + '&newvalue=' + (parseInt(goodiesEmissionData.ordre)+1));
		refreshGoodiesEmission();
	}
	td2.appendChild(linkDescendreGoodies);
	
	var td3 = document.createElement('td');
	td3.className = 'padded';
	var previewGoodies = getPreviewContenu(goodiesEmissionData);
	td3.appendChild(previewGoodies);

	var td4 = document.createElement('td');
	td4.className = 'actionEmission';
	
	var td5 = document.createElement('td');	
	td5.className = 'actionEmission';

	var boutonModifier = document.createElement('input');
	boutonModifier.type = "button";
	boutonModifier.className = "button";
	boutonModifier.value = "Modifier";	
	boutonModifier.onclick = function () {
		var postAction = function() {
			display('playlist');
		}
		var postActionCancel = function() {
			//Retour à la page de l'émission :
			display('playlist');
			window.location.href = "#top";
		}
		displayFormEditContenu(goodiesEmissionData, postAction, postActionCancel, true);
	}
	
	td4.appendChild(boutonModifier);
	
	var boutonSupprimer = document.createElement('input');
	boutonSupprimer.value = "Supprimer";
	boutonSupprimer.type = "button";
	boutonSupprimer.className = "button";
	boutonSupprimer.style.color = "red";
	boutonSupprimer.onclick = function () {
		if (confirm('Etes-vous certain de vouloir supprimer ce contenu ?'))
		{
			getDatas('dbDeleteGoodiesEmission', '', 'id_emission=' + goodiesEmissionData.id_emission + '&id_contenu=' + goodiesEmissionData.id_contenu + '&ordre=' + goodiesEmissionData.ordre);
			refreshGoodiesEmission();
		}
	}
	td5.appendChild(boutonSupprimer);
		
	tr.appendChild(td1);
	tr.appendChild(td2);
	tr.appendChild(td3);	
	tr.appendChild(td4);		
	tr.appendChild(td5);

	ordreGoodiesEmission++;
	
	return tr;
}

function refreshContenuPageSite()
{
	document.getElementById('listeContenuPageSite').style.display = 'block';
		
	while (document.getElementById('listeContenuPageSite').hasChildNodes())
		document.getElementById('listeContenuPageSite').removeChild(document.getElementById('listeContenuPageSite').firstChild);

	getDatas('getListePagesSite', 'listePagesSite', '');
	alternate = 1;
		
	for(var i=0; i<listePagesSite.length; i++)
	{	
		//Récupération et affichage de la liste des contenus existants :
		getDatas('dbGetListeContenuPageSite', 'listeContenuPageSite', "id_site=" + id_site + "&page=" + encode(listePagesSite[i]));
		alternate = 1;
		
		document.getElementById('listeContenuPageSite').appendChild(createLignePageSite(listePagesSite[i], (listeContenuPageSite.length != 0)));			
			
		for(var j=0; j<listeContenuPageSite.length; j++)
		{
			document.getElementById('listeContenuPageSite').appendChild(createLigneContenuPageSite(listeContenuPageSite[j]));			
		}
	}
}

function createLignePageSite(pageSite, haveContenu)
{
	var tr1 = document.createElement('tr');
	tr1.id = "trLignePageSiteVide_" + pageSite;
		
	var td1 = document.createElement('td');
	td1.className = 'padded';
	td1.innerHTML = "<b><u>Page \"" + pageSite + "\" :</u></b>";
	
	if (superAdmin)
	{
		var spanAjouter1 = document.createElement('span');
		spanAjouter1.innerHTML = "&nbsp;(";
		var spanAjouter2 = document.createElement('span');
		spanAjouter2.innerHTML = ")&nbsp;";
		var btnAjouter = document.createElement('a');
		btnAjouter.type = "button";
		btnAjouter.innerHTML = "Ajouter un contenu";
		btnAjouter.href = "#";
		btnAjouter.className = "button";
		btnAjouter.onclick = function () {
			document.getElementById("trLignePageSiteVide_" + pageSite).parentNode.insertBefore(createLigneContenuPageSite('', pageSite), document.getElementById("trLignePageSiteVide_" + pageSite).nextSibling);
			this.onclick = function () { return false };
			//this.disabled = true;
		}
		td1.appendChild(spanAjouter1);
		td1.appendChild(btnAjouter);
		td1.appendChild(spanAjouter2);
	}
	
	var td2 = document.createElement('td');
	td2.colSpan = "4";
	td2.className = 'padded';
	if (!haveContenu)
	{
		td2.innerHTML = "<font style='color:gray;'><i>Pas de contenu pour cette page...</i></font>";
		tr1.className = 'etat22';
	}
	else
		tr1.className = 'etat21';

		
	tr1.appendChild(td1);
	tr1.appendChild(td2);

	return tr1;
}

function refreshTextePresentation()
{
	if (isNew || !siteHaveTexte || admin != '')
	{
		document.getElementById('textePresentationEmission').style.display = 'none';
	}
	else
	{
		document.getElementById('textePresentationEmission').style.display = 'block';

		getDatas('dbGetContenu', 'contenuTextePresentation', 'id=' + currentItem.id_contenu_texte);
		
		if (contenuTextePresentation == 0)
		{
			alert('Texte de présentation manquant ! Il faut le dire à Divag !');
		}
		else
		{
			while (document.getElementById('previewPresentationEmission').hasChildNodes())
				document.getElementById('previewPresentationEmission').removeChild(document.getElementById('previewPresentationEmission').firstChild);

			document.getElementById('previewPresentationEmission').appendChild(getPreviewContenu(contenuTextePresentation));
			
			boutonModifierTextePresentation = document.getElementById('boutonTextePresentationEmission');			
			boutonModifierTextePresentation.onclick = function () {
				var postAction = function() {
					//Retour à la page de l'émission :
					updateZipEmission();
					display('playlist');
				}
				var postActionCancel = function() {
					//Retour à la page de l'émission :
					display('playlist');
					window.location.href = "#top";
				}
				displayFormEditContenu(contenuTextePresentation, postAction, postActionCancel, true);
			}

		}
	}
}

function initialiseFormEditFormEditContenu(id_contenu, id_type_contenu, url, contenu_fr, contenu_en, contenu_txt_fr, contenu_txt_en)
{
	document.getElementById('fileContenuImageId').value = id_contenu;
	document.getElementById('fileContenuImageUrl').value = url;

	document.getElementById('formContenuUrl').value = url;
	document.getElementById('formContenuContenuFr').value = contenu_fr;
	document.getElementById('formContenuContenuEn').value = contenu_en;
	document.getElementById('formContenuContenuTxtFr').value = contenu_txt_fr;
	document.getElementById('formContenuContenuTxtEn').value = contenu_txt_en;
}

function refreshTypeContenu(id_contenu, id_type_contenu, bouton_valider, forced_type)
{
	var typeContenu;
	var forcedType;
	
	if (id_type_contenu == undefined)
		typeContenu = ddlTypeContenu.value;
	else
		typeContenu = id_type_contenu;
	
	if (bouton_valider == undefined)
		var bouton_valider = boutonValiderContenu;
	
	if (forced_type == undefined)
		forcedType = false;
	else
		forcedType = forced_type;
	
	
	if (forcedType)
	{
		ddlTypeContenu.style.display = 'none';
		document.getElementById('spanContenuType').style.display = 'none';
	}
	else
	{
		ddlTypeContenu.style.display = 'block';
		document.getElementById('spanContenuType').style.display = 'block';
	}
	
	//Affichage du formulaire correspondant au type de contenu :
	//==========================================================
	
	bouton_valider.style.display = 'none';
	document.getElementById('fileContenuImageButton').style.display = 'none';
	
	document.getElementById('formContenuType_0').style.display = 'none';
	document.getElementById('formContenuType_1').style.display = 'none';
	document.getElementById('formContenuType_2').style.display = 'none';
	document.getElementById('formContenuType_3').style.display = 'none';
	document.getElementById('formContenuType_3_Preview').style.display = 'none';
	document.getElementById('formContenuType_4').style.display = 'none';
	document.getElementById('formContenuType_5').style.display = 'none';
	document.getElementById('formContenuType_6').style.display = 'none';
	
	document.getElementById('formContenuType_' + typeContenu).style.display = 'block';
	if (document.getElementById('formContenuType_' + typeContenu + '_Preview') != null)
		document.getElementById('formContenuType_' + typeContenu + '_Preview').style.display = 'block';
	
	//Actions d'initialisation spécifique au type de contenu
	//Et on renvoie la fonction à exécuter avant la mise à jour du contenu 
	//====================================================================
	
	if (typeContenu == 0)
	{
		bouton_valider.style.display = 'none';
		return function () {return true;};
	}
	//Texte enrichi :
	if (typeContenu == 1)
	{
		bouton_valider.style.display = 'block';
		return function () {
			//l'Url n'est pas utilisée pour ce type :
			document.getElementById('formContenuUrl').value = '';
			return true;
		};
	}
	//Lien :
	if (typeContenu == 2)
	{
		bouton_valider.style.display = 'block';
		if (document.getElementById('fileContenuImageUrl').value == document.getElementById('formContenuUrl').value)
			document.getElementById('formContenuUrl').value = '';
		
		return function () { 
			//les contenu textes ne sont pas utilisés pour ce type :
			document.getElementById('formContenuContenuFr').value = '';
			document.getElementById('formContenuContenuEn').value = '';
			document.getElementById('formContenuContenuTxtFr').value = '';
			document.getElementById('formContenuContenuTxtEn').value = '';
		};
	}
	//Image :
	if (typeContenu == 3)
	{
		document.getElementById('fileContenuImageButton').style.display = 'block';

		//l'id du contenu doit être chargé dans le formulaire d'upload :
		document.getElementById('fileContenuImageId').value = id_contenu;
		document.getElementById('formContenuUrl').value = document.getElementById('fileContenuImageUrl').value;
		
		//on initialise le formulaire d'upload avec son preview :
		refreshContenuImageFormZone();		
		
		//Pour ce type, l'URL est utilisée pour stocker le nom du fichier sur le serveur :
		return function () {
			document.getElementById('formContenuUrl').value = document.getElementById('fileContenuImageFolder').value + document.getElementById('fileContenuImageId').value + document.getElementById('fileContenuImage').value.substring(document.getElementById('fileContenuImage').value.lastIndexOf('.'));
			document.getElementById('fileContenuImageUrl').value = document.getElementById('fileContenuImageFolder').value + document.getElementById('fileContenuImageId').value + document.getElementById('fileContenuImage').value.substring(document.getElementById('fileContenuImage').value.lastIndexOf('.'));
			//On doit également renseigner l'extension du fichier dans la zone du formulaire d'upload :
			document.getElementById('fileContenuImageExtension').value = document.getElementById('fileContenuImage').value.substring(document.getElementById('fileContenuImage').value.lastIndexOf('.'));
			
			//Les contenus textes ne sont pas utilisés pour ce type :
			document.getElementById('formContenuContenuFr').value = '';
			document.getElementById('formContenuContenuEn').value = '';
			document.getElementById('formContenuContenuTxtFr').value = '';
			document.getElementById('formContenuContenuTxtEn').value = '';
		};
	}
	//Mp3 :
	if (typeContenu == 4)
	{
		bouton_valider.style.display = 'block';
		return function () {return true;};
	}
	//Flash :
	if (typeContenu == 5)
	{
		bouton_valider.style.display = 'block';
		return function () {return true;};
	}
	//Lien youtube :
	if (typeContenu == 6)
	{
		document.getElementById('formContenuLienVideo').value = document.getElementById('formContenuUrl').value;
		document.getElementById('formContenuLienVideo').onkeyup = function () {
			return validateAdresseYoutube(document.getElementById('formContenuLienVideo'), bouton_valider);
		}
		
		bouton_valider.style.display = 'block';
		
		return function () {
			document.getElementById('formContenuUrl').value = document.getElementById('formContenuLienVideo').value.replace('http://www.youtube.com/watch?v=', 'http://www.youtube.com/v/');
			//les contenu textes ne sont pas utilisés pour ce type :
			document.getElementById('formContenuContenuFr').value = '';
			document.getElementById('formContenuContenuEn').value = '';
			document.getElementById('formContenuContenuTxtFr').value = '';
			document.getElementById('formContenuContenuTxtEn').value = '';
		};
	}
}

function displayFormEditContenu(contenuData, postAction, postActionCancel, forcedType)
{
	window.location.href = "#top";
	showWait();
	
	if (contenuData.id_contenu == undefined && contenuData.id != undefined)
		contenuData.id_contenu = contenuData.id;
	
	var fieldsetContenu = document.getElementById('formContenuFieldset');
	fieldsetContenu.className = 'etat42';

	var legend = document.getElementById('formContenuLegend');
	
	if (contenuData.id_type_contenu == 0)
		legend.innerHTML = "Création d'un contenu :";
	else
		legend.innerHTML = "Modification d'un contenu :";
	
	ddlTypeContenu.value = contenuData.id_type_contenu;		
	ddlTypeContenu.disabled = forcedType;
	
	initialiseFormEditFormEditContenu(contenuData.id_contenu, contenuData.id_type_contenu, contenuData.url, contenuData.contenu_fr, contenuData.contenu_en, contenuData.contenu_txt_fr, contenuData.contenu_txt_en);
	
	var actionsBeforeValidate = refreshTypeContenu(contenuData.id_contenu, contenuData.id_type_contenu, boutonValiderContenu, forcedType);	
	
	var validateFunction = function () {
		actionsBeforeValidate();
		getDatas('dbUpdateContenu', '', 'id=' + contenuData.id_contenu + '&id_type_contenu=' + ddlTypeContenu.value + '&url=' + encode(document.getElementById('formContenuUrl').value) + '&contenu_fr=' + encode(document.getElementById('formContenuContenuFr').value) + '&contenu_en=' + encode(document.getElementById('formContenuContenuEn').value) + '&contenu_txt_fr=' + encode(document.getElementById('formContenuContenuTxtFr').value) + '&contenu_txt_en=' + encode(document.getElementById('formContenuContenuTxtEn').value));
		postAction();
	}
	
	ddlTypeContenu.onchange = function() {
		actionsBeforeValidate = refreshTypeContenu(contenuData.id_contenu);
		validateFunction = function () {
			actionsBeforeValidate();
			getDatas('dbUpdateContenu', '', 'id=' + contenuData.id_contenu + '&id_type_contenu=' + ddlTypeContenu.value + '&url=' + encode(document.getElementById('formContenuUrl').value) + '&contenu_fr=' + encode(document.getElementById('formContenuContenuFr').value) + '&contenu_en=' + encode(document.getElementById('formContenuContenuEn').value) + '&contenu_txt_fr=' + encode(document.getElementById('formContenuContenuTxtFr').value) + '&contenu_txt_en=' + encode(document.getElementById('formContenuContenuTxtEn').value));
			postAction();
		}
	}
	boutonValiderContenu.onclick = validateFunction;
	
	//On initialise l'action des boutons des formulaires extérieurs :
	document.getElementById('fileContenuImageButton').onclick = function () {
		validateFunction();
	}
	boutonAnnulerContenu.onclick = postActionCancel;
	
	display('editeurContenu');
	hideWait();
}

function createLigneContenuPageSite(contenuPageSiteData, nomPage)
{
	var creation = false;
	if (contenuPageSiteData == undefined || contenuPageSiteData.id_contenu == undefined)
		creation = true;
		
	var tr = document.createElement('tr');
	tr.className = 'etat32';

	
	var td1 = document.createElement('td');
	td1.className = 'padded';
	td1.style.paddingLeft = '15px';
	td1.style.textAlign = 'right';
	var spanType = document.createElement('span');
	if (!creation)
	{
		if (contenuPageSiteData.id_type_contenu != 0)
			spanType.innerHTML = "<u>" + contenuPageSiteData.libelle + " :</u> ";
		else
		{
			//spanType.innerHTML = "<font style='color:red;'><u>A compléter :</u></font> ";
			spanType.innerHTML = "<u>A compléter :</u> ";
			tr.className = 'etat42';
		}
	}
	else
	{
		if (nomPage != undefined)
			spanType.innerHTML = "<u>Saisissez une référence :</u> ";
		else
			spanType.style.display = "none";
	}
	td1.appendChild(spanType);
	
	var ddlListePagesSite = document.createElement("select");	
	
	if (!creation || nomPage != undefined)
		ddlListePagesSite.style.display = "none";
		
	if (creation)
	{
		while (ddlListePagesSite.hasChildNodes())
			ddlListePagesSite.removeChild(ddlListePagesSite.firstChild);
		getDatas('getListePagesSite', 'listePagesSite', '');
		for(var i=0; i<listePagesSite.length; i++)
		{
			var optionListePagesSite = document.createElement("option");
			optionListePagesSite.value = listePagesSite[i];
			optionListePagesSite.text = listePagesSite[i];
			ddlListePagesSite.appendChild(optionListePagesSite);
		}
	
		//On initialise les zones de saisies :
		if (nomPage != undefined)
			ddlListePagesSite.value = nomPage;
	}
	td1.appendChild(ddlListePagesSite);
	
	tr.appendChild(td1);
	
	var td2 = document.createElement('td');
	td2.className = 'padded';
	var spanZone = document.createElement('span');
	if (creation)
		spanZone.style.display = "none";
	else
		spanZone.innerHTML = "<b>" + contenuPageSiteData.zone + "</b>";
	td2.appendChild(spanZone);
	var txtZonePage = document.createElement('input');
	txtZonePage.type = "text";
	if (!creation)
		txtZonePage.style.display = "none";
	td2.appendChild(txtZonePage);

	tr.appendChild(td2);

	var td4 = document.createElement('td');
	td4.className = 'actionEmission';
	
	var td5 = document.createElement('td');	
	td5.className = 'actionEmission';
	if (!creation)
	{
		var boutonModifier = document.createElement('input');
		boutonModifier.type = "button";
		boutonModifier.className = "button";
		if (contenuPageSiteData.id_type_contenu == 0)
		{
			boutonModifier.value = "Compléter";
			boutonModifier.style.fontWeight = "bold";
		}
		else
			boutonModifier.value = "Modifier";
			
		boutonModifier.onclick = function () {
			var postAction = function() {
				//Pas d'action après mise à jour.
			}
			var postActionCancel = function() {
				//Retour à la page des contenus :
				display('contenuPageSite');
				window.location.href = "#top";
			}
			displayFormEditContenu(contenuPageSiteData, postAction, postActionCancel, false);
		}
		
		td4.appendChild(boutonModifier);
		
		var boutonSupprimer = document.createElement('input');
		boutonSupprimer.value = "Supprimer";
		boutonSupprimer.type = "button";
		boutonSupprimer.className = "button";
		boutonSupprimer.style.color = "red";
		boutonSupprimer.onclick = function () {
			if (confirm('Etes-vous certain de vouloir supprimer ce contenu ?'))
			{
				getDatas('dbDeleteContenuPageSite', '', 'id=' + contenuPageSiteData.id);
				refreshContenuPageSite();
			}
		}
		td5.appendChild(boutonSupprimer);
	}

	if (superAdmin)
	{
		var td3 = document.createElement('td');	
		td3.className = 'actionEmission';
		
		var boutonDeplacerOk = document.createElement('input');
		boutonDeplacerOk.value = "Valider";
		boutonDeplacerOk.type = "button";
		boutonDeplacerOk.className = "button";
		if (!creation)
			boutonDeplacerOk.style.display = "none";
			
		boutonDeplacerOk.onclick = function () {
			if (ddlListePagesSite.value == '')
			{
				alert('Vous devez choisir une page !!');
				return false;
			}
			
			if (txtZonePage.value == '')
			{
				alert('Vous devez saisir une référence !!');
				return false;
			}
			
			getDatas('dbGetContenuPageSite', 'testContenuPageSite', 'id_site=' + id_site + '&page=' + encode(ddlListePagesSite.value) + '&zone=' + encode(txtZonePage.value));
			
			if (testContenuPageSite != 0)
			{
				alert('Désolé, il existe déjà un contenu avec la même référence pour la même page.\nMerci de corriger votre saisie.');
				return false;
			}
			else
			{
				if (creation)
					getDatas('dbInsertContenuPageSite', '', 'id_site=' + id_site + '&page=' + encode(ddlListePagesSite.value) + '&zone=' + encode(txtZonePage.value));
				else
					getDatas('dbUpdateContenuPageSite', '', 'id=' + contenuPageSiteData.id + '&page=' + encode(ddlListePagesSite.value) + '&zone=' + encode(txtZonePage.value));
			}
			
			refreshContenuPageSite();	
		}
		td3.appendChild(boutonDeplacerOk);

		var boutonDeplacerAnnuler = document.createElement('input');
		boutonDeplacerAnnuler.value = "Annuler";
		boutonDeplacerAnnuler.type = "button";
		boutonDeplacerAnnuler.className = "button";
		if (!creation)
			boutonDeplacerAnnuler.style.display = "none";
		boutonDeplacerAnnuler.onclick = function () {
		
		if (creation)
			refreshContenuPageSite();
		else
		{
			while (ddlListePagesSite.hasChildNodes())
				ddlListePagesSite.removeChild(ddlListePagesSite.firstChild);
			getDatas('getListePagesSite', 'listePagesSite', '');
			for(var i=0; i<listePagesSite.length; i++)
			{
				var optionListePagesSite = document.createElement("option");
				optionListePagesSite.value = listePagesSite[i];
				optionListePagesSite.text = listePagesSite[i];
				ddlListePagesSite.appendChild(optionListePagesSite);
			}
		
			//On initialise les zones de saisies :
			ddlListePagesSite.value = contenuPageSiteData.page;
			txtZonePage.value = contenuPageSiteData.zone;
			
			//On remplace l'affichage de la ligne par celle d'édition :
			ddlListePagesSite.style.display = "none";
			txtZonePage.style.display = "none";
			spanType.style.display = "block";
			spanZone.style.display = "block";
			
			//On remplace ce bouton par celui de validation et d'annulation :
			boutonDeplacerOk.style.display = "none";
			this.style.display = "none";
			boutonDeplacer.style.display = "block";
			
			//On désactive les boutons de modification et de suppression :
			boutonModifier.disabled = false;
			boutonSupprimer.disabled = false;
			}
		}
		td3.appendChild(boutonDeplacerAnnuler);

		if (!creation)
		{
			var boutonDeplacer = document.createElement('input');
			boutonDeplacer.value = "<< Déplacer";
			boutonDeplacer.type = "button";
			boutonDeplacer.className = "button";
			boutonDeplacer.onclick = function () {
			
				while (ddlListePagesSite.hasChildNodes())
					ddlListePagesSite.removeChild(ddlListePagesSite.firstChild);
				getDatas('getListePagesSite', 'listePagesSite', '');
				for(var i=0; i<listePagesSite.length; i++)
				{
					var optionListePagesSite = document.createElement("option");
					optionListePagesSite.value = listePagesSite[i];
					optionListePagesSite.text = listePagesSite[i];
					ddlListePagesSite.appendChild(optionListePagesSite);
				}
			
				//On initialise les zones de saisies :
				ddlListePagesSite.value = contenuPageSiteData.page;
				txtZonePage.value = contenuPageSiteData.zone;

				//On remplace l'affichage de la ligne par celle d'édition :
				spanType.style.display = "none";
				spanZone.style.display = "none";
				ddlListePagesSite.style.display = "block";
				txtZonePage.style.display = "block";
				
				//On remplace ce bouton par celui de validation et d'annulation :
				this.style.display = "none";
				boutonDeplacerOk.style.display = "block";
				boutonDeplacerAnnuler.style.display = "block";
				
				//On désactive les boutons de modification et de suppression :
				boutonModifier.disabled = true;
				boutonSupprimer.disabled = true;
			}
			td3.appendChild(boutonDeplacer);
		}
		
		tr.appendChild(td3);
	}
	
	tr.appendChild(td4);		
	if (superAdmin)
		tr.appendChild(td5);

	return tr;
}


var listeParticipantsEmissionDatas = new Array();
function refreshParticipants()
{
	hideAddParticipant();
	//if (isNew || !siteHaveParticipants || admin != '')
	if (isNew || !siteHaveParticipants)
	{
		document.getElementById('participants').style.display = 'none';
	}
	else
	{
		document.getElementById('participants').style.display = 'block';
		document.getElementById('noParticipants').style.display = 'none';
		document.getElementById('listeParticipants').style.display = 'none';
		if (!verifParticipants(currentItem.id))
		{
			document.getElementById('noParticipants').style.display = 'block';
			document.getElementById('participants').className = 'etat42';
		}
		else
		{
			document.getElementById('listeParticipants').style.display = 'block';
			document.getElementById('participants').className = 'etat32';
			
			while (document.getElementById('listeParticipants').hasChildNodes())
				document.getElementById('listeParticipants').removeChild(document.getElementById('listeParticipants').firstChild);

			getDatas('dbGetListeParticipantsEmission', 'participantsEmission', 'id=' + currentItem.id);
			alternate = 1;
			ordreParticipant = 1;
			
			document.getElementById('listeParticipants').appendChild(createEnteteParticipantEmission());			
			
			listeParticipantsEmissionDatas = new Array();
			
			for(var i=0; i<participantsEmission.length; i++)
			{
				document.getElementById('listeParticipants').appendChild(createLigneParticipantEmission(participantsEmission[i]));			
				listeParticipantsEmissionDatas[participantsEmission[i].nom_utilisateur] = participantsEmission[i];
			}
			
			if (participantsEmission.length == 1 && admin != '')
				document.getElementById('participants').style.display = 'none';

		}
	}
	
	refreshMorceaux();
}

function createEnteteParticipantEmission()
{
	var col1 = document.createElement('td');
	col1.innerHTML = 'Chef';
	var col2 = document.createElement('td');
	col2.innerHTML = 'Nom du participant';
	var col3 = document.createElement('td');
	col3.innerHTML = 'Ordre';
	var col4 = document.createElement('td');

	var participant = document.createElement('tr');	
	participant.className = 'entete';
	participant.appendChild(col3);
	participant.appendChild(col1);
	participant.appendChild(col2);
	participant.appendChild(col4);
		
	return participant;
}

function showCompleteParticipant(nomParticipant)
{
	if (document.getElementById('formUser' + nomParticipant) != undefined)
		document.getElementById('formUser' + nomParticipant).parentNode.removeChild(document.getElementById('formUser' + nomParticipant));

	document.getElementById('ligneParticipant' + nomParticipant).parentNode.insertBefore(createLigneEditUser(listeParticipantsEmissionDatas[nomParticipant], nomParticipant), document.getElementById('ligneParticipant' + nomParticipant).nextSibling);
	checkFormUserValidate(nomParticipant);
}

function showModifieParticipant(nomParticipant)
{
	if (document.getElementById('formUser' + nomParticipant) != undefined)
		document.getElementById('formUser' + nomParticipant).parentNode.removeChild(document.getElementById('formUser' + nomParticipant));

	getDatas('dbGetUtilisateur', 'userDataToEdit', 'nom=' + encode(nomParticipant));
	document.getElementById('ligneParticipant' + nomParticipant).parentNode.insertBefore(createLigneEditUser(userDataToEdit, ''), document.getElementById('ligneParticipant' + nomParticipant).nextSibling);
	checkFormUserValidate(nomParticipant);
}

function showModifieUtilisateur(nomUtilisateur)
{
	if (document.getElementById('formUser' + nomUtilisateur) != undefined)
		document.getElementById('formUser' + nomUtilisateur).parentNode.removeChild(document.getElementById('formUser' + nomUtilisateur));

	getDatas('dbGetUtilisateur', 'userDataToEdit', 'nom=' + encode(nomUtilisateur));
	document.getElementById('ligneUtilisateur' + nomUtilisateur).parentNode.insertBefore(createLigneEditUser(userDataToEdit, ''), document.getElementById('ligneUtilisateur' + nomUtilisateur).nextSibling);
	checkFormUserValidate(nomUtilisateur);
}

function hideCompleteParticipant(nomParticipant)
{
	document.getElementById('formUser' + nomParticipant).parentNode.removeChild(document.getElementById('formUser' + nomParticipant));
}

function createLigneParticipantEmission(participantData)
{
	var col1 = document.createElement('td');
	if (admin == '')
		col1.style.width = '40px';
	else
		col1.style.width = '20px';
	
	col1.style.textAlign = 'left';
	
	if (admin == '')
	{
		
		var radio = document.createElement('input');
		radio.type = 'radio';
		radio.style.color = 'yellow';
		radio.checked = (participantData.est_chef == 1);
		radio.onclick = function () {
			getDatas('dbUpdateChefEmission', '', 'id=' + currentItem.id + '&nom=' + encode(participantData.nom_utilisateur));
			refreshParticipants();
		}
		col1.appendChild(radio);
	}	
	
	var col2 = document.createElement('td');
	col2.innerHTML = participantData.nom_utilisateur;

	participantData.ordre = ordreParticipant;
	
	var col3 = document.createElement('td');
	col3.innerHTML = ' ' + participantData.ordre + ' ';
	col3.style.width = '80px';
	
	var linkMonter = document.createElement('input');
	linkMonter.type = 'button';
	linkMonter.className = 'button';
	linkMonter.value = '+';
	linkMonter.disabled = (participantData.ordre == 1);
	linkMonter.onclick = function () {
		getDatas('dbUpdateOrdreParticipant', 'result', 'id=' + currentItem.id + '&ordre=' + participantData.ordre + '&newvalue=' + (parseInt(participantData.ordre)-1));
		refreshParticipants();
	}
	col3.appendChild(linkMonter);
	
	var linkDescendre = document.createElement('input');
	linkDescendre.type = 'button';
	linkDescendre.className = 'button';
	linkDescendre.value = '-';
	linkDescendre.disabled = (participantData.ordre == participantsEmission.length);
	linkDescendre.onclick = function () {
		getDatas('dbUpdateOrdreParticipant', 'result', 'id=' + currentItem.id + '&ordre=' + participantData.ordre + '&newvalue=' + (parseInt(participantData.ordre)+1));
		refreshParticipants();
	}
	col3.appendChild(linkDescendre);

	if (admin == '')
	{
		var col4 = document.createElement('td');
		col4.style.width = '190px';
		col4.style.textAlign = 'right';
		
		var deleteParticipant = document.createElement('input');
		deleteParticipant.type = 'button';
		deleteParticipant.className = 'button';
		deleteParticipant.value = 'Supprimer';
		deleteParticipant.onclick = function() {
			if (confirm('Etes-vous certain de vouloir supprimer ce participant ?'))
			{
				getDatas('dbDeleteParticipant', '', 'id=' + currentItem.id + '&nom=' + encode(participantData.nom_utilisateur));
				refreshParticipants();
			}
		}
		col4.appendChild(deleteParticipant);
		
		var completeParticipant = document.createElement('input');
		completeParticipant.type = 'button';
		completeParticipant.className = 'button';
		
		if (participantData.existe == 0)
		{
			completeParticipant.value = 'Compléter';
			completeParticipant.style.color = 'green';
			completeParticipant.style.fontWeight = 'bold';
			completeParticipant.onclick = function() {
				showCompleteParticipant(participantData.nom_utilisateur);
			}
		}
		else
		{
			if (participantData.est_utilisateur == 1)
			{
				completeParticipant.value = 'Modifier';
				completeParticipant.style.color = 'red';
				completeParticipant.onclick = function() {
					showModifieParticipant(participantData.nom_utilisateur);
				}
			}
		}

		col4.appendChild(completeParticipant);
		
		if (participantData.est_chef_complet == 1)
		{
			var envoyerInfosChef = document.createElement('input');
			envoyerInfosChef.type = 'button';	
			envoyerInfosChef.className = 'button';	
			envoyerInfosChef.value = 'Envoyer les infos CHEF';
			envoyerInfosChef.onclick = function() {
				showWait();
				getDatas('sendMailAjax', '', 'nom=' + encode(participantData.nom_utilisateur));
				hideWait();
			}
			
			if (participantData.est_chef == 1)
				col4.appendChild(envoyerInfosChef);
		}
	}
	
	var participant = document.createElement('tr');
	participant.id='ligneParticipant' + participantData.nom_utilisateur;
	participant.style.width = '100%';

	if (participantData.existe == 0)
		participant.className = 'etat41';
	else
		participant.className = 'etat31';
		
	if (participantData.est_chef == 1)
	{
		if (participantData.est_chef_complet == 1)
		{
			col1.style.backgroundImage = 'url(css/chef_ok.gif)';
			col1.style.backgroundPosition = 'right';
			col1.style.backgroundRepeat = 'no-repeat';
			//col1.className = 'etat21';
		}
		else
		{
			col1.style.backgroundImage = 'url(css/chef_ko.gif)';
			col1.style.backgroundPosition = 'right';
			col1.style.backgroundRepeat = 'no-repeat';
			//col1.className = 'etat22';
		}
	}
	
	participant.appendChild(col3);
	participant.appendChild(col1);
	participant.appendChild(col2);
	if (admin == '')
		participant.appendChild(col4);
		
	if (alternate == 1)
		alternate = 2;
	else
		alternate = 1;

	ordreParticipant++;
	
	return participant;
}

function createLigneUtilisateur(userData)
{
	var col0 = document.createElement('td');
	if (userData.est_chef == 1 || (userData.mail != '' && userData.password != ''))
	{
		var iconeChef = document.createElement('img');
		
		if (userData.mail != '' && userData.password != '')
			iconeChef.src = "css/chef_ok.gif";
		else
			iconeChef.src = "css/chef_ko.gif";
		
		col0.appendChild(iconeChef);
	}
	
	var col1 = document.createElement('td');
	col1.className = 'padded';
	col1.innerHTML = userData.nom;
	
	var col3 = document.createElement('td');
	var iconeMail = document.createElement('img');
	
	if (userData.mail != '')
		iconeMail.src = 'css/mail_ok.gif';
	else
		iconeMail.src = 'css/mail_ko.gif';
	
	col3.appendChild(iconeMail);
	
	var col2 = document.createElement('td');
		
	var modifieUser = document.createElement('input');
	modifieUser.type = 'button';
	modifieUser.className = 'button';
	modifieUser.value = 'Modifier';
	modifieUser.onclick = function() {
		showModifieUtilisateur(userData.nom);
	}
	col2.appendChild(modifieUser);
	
	var envoyerInfosChef = document.createElement('input');
	envoyerInfosChef.type = 'button';	
	envoyerInfosChef.className = 'button';	
	envoyerInfosChef.value = 'Envoyer les infos CHEF';
	envoyerInfosChef.onclick = function() {
		showWait();
		getDatas('sendMailAjax', '', 'nom=' + encode(userData.nom));
		hideWait();
	}
	
	if (userData.mail != '' && userData.password != '')
		col2.appendChild(envoyerInfosChef);

	var utilisateur = document.createElement('tr');
	utilisateur.id='ligneUtilisateur' + userData.nom;
	
	if (userData.est_inutile == 1)
		utilisateur.className = 'etat41';
	else
		utilisateur.className = 'etat31';

	if (userData.est_chef_encours == 1)
		utilisateur.className = 'etat21';
	
	utilisateur.appendChild(col1);
	utilisateur.appendChild(col0);
	utilisateur.appendChild(col3);
	utilisateur.appendChild(col2);
		
	return utilisateur;
}

function newUser()
{

	while (document.getElementById('editUser').hasChildNodes())
		document.getElementById('editUser').removeChild(document.getElementById('editUser').firstChild);

	document.getElementById('editUser').appendChild(createLigneEditUser('', ''));
	
	checkFormUserValidate('');
}

function checkFormUserValidate(nom)
{
	document.getElementById('formUserValidate' + nom).disabled = !(Verif_NonVide(document.getElementById('formUserNom' + nom)) && Verif_NonVide(document.getElementById('formUserLogin' + nom)) && Verif_NonVide(document.getElementById('formUserSite' + nom)) && Verif_MailValide(document.getElementById('formUserMail' + nom)));
}

function createLigneEditUser(userData, nomParticipant)
{
	
	var nomUser;
	if (nomParticipant != '')
		nomUser = userData.nom_utilisateur;
	else
	{
		if (userData.nom == undefined)
			nomUser = '';
		else
			nomUser = userData.nom;
	}
	var fieldset = document.createElement('fieldset');
	fieldset.className = 'etat42';
	fieldset.width = '100%';
	var legend = document.createElement('legend');
	
	if (nomUser == '' || nomParticipant != '')
		legend.innerHTML = "Création d'un utilisateur :";
	else
		legend.innerHTML = "Modification d'un utilisateur :";
	
	fieldset.appendChild(legend);

	var table = document.createElement('table');
	table.width = '100%';
	var trNom = document.createElement('tr');
	var tdNom1 = document.createElement('td');
	tdNom1.width = '50%';
	tdNom1.innerHTML = "<b><u>Nom :</u></b>";
	var tdNom2 = document.createElement('td');
	tdNom2.width = '50%';
	
	var txtNom = document.createElement('input');
	txtNom.type = "text";
	txtNom.id = 'formUserNom' + nomUser;
	txtNom.value = nomUser;	
	
	txtNom.onchange = function() {
		checkFormUserValidate(nomUser);
	}

	var brNomError = document.createElement('br');
	var txtNomError = document.createElement('span');
	txtNomError.style.color = 'red';
	txtNomError.id = 'formUserNom' + nomUser + 'Error';
	
	tdNom2.appendChild(txtNom);	
	tdNom2.appendChild(brNomError);	
	tdNom2.appendChild(txtNomError);	
	trNom.appendChild(tdNom1);
	trNom.appendChild(tdNom2);
	table.appendChild(trNom);
	
	var trLogin = document.createElement('tr');
	var tdLogin1 = document.createElement('td');
	tdLogin1.innerHTML = "Pseudo : ";
	var tdLogin2 = document.createElement('td');
	
	var txtLogin = document.createElement('input');
	txtLogin.type = "text";
	txtLogin.id = 'formUserLogin' + nomUser;

	if (userData.login_forum == '' || userData.login_forum == undefined)
		txtLogin.value = nomUser;
	else
		txtLogin.value = userData.login_forum;

	txtLogin.onchange = function() {
		checkFormUserValidate(nomUser);
	}
	
	var brLoginError = document.createElement('br');
	var txtLoginError = document.createElement('span');
	txtLoginError.style.color = 'red';
	txtLoginError.id = 'formUserLogin' + nomUser + 'Error';

	tdLogin2.appendChild(txtLogin);	
	tdLogin2.appendChild(brLoginError);	
	tdLogin2.appendChild(txtLoginError);	
	trLogin.appendChild(tdLogin1);
	trLogin.appendChild(tdLogin2);
	table.appendChild(trLogin);
	
	var trSite = document.createElement('tr');
	var tdSite1 = document.createElement('td');
	tdSite1.innerHTML = "Site web : ";
	var tdSite2 = document.createElement('td');
	
	var txtSite = document.createElement('input');
	txtSite.type = "text";
	txtSite.id = 'formUserSite' + nomUser;
	
	if (userData.url_site == '' || userData.url_site == undefined)
		txtSite.value = 'http://';
	else
		txtSite.value = userData.url_site;
	
	txtSite.onchange = function() {
		checkFormUserValidate(nomUser);
	}
	
	var brSiteError = document.createElement('br');
	var txtSiteError = document.createElement('span');
	txtSiteError.style.color = 'red';
	txtSiteError.id = 'formUserSite' + nomUser + 'Error';

	tdSite2.appendChild(txtSite);	
	tdSite2.appendChild(brSiteError);	
	tdSite2.appendChild(txtSiteError);	
	trSite.appendChild(tdSite1);
	trSite.appendChild(tdSite2);
	table.appendChild(trSite);

	var trMail = document.createElement('tr');
	var tdMail1 = document.createElement('td');
	if (userData.est_chef == 1)
		tdMail1.innerHTML = "<b><u>Mail :</u></b>";
	else
		tdMail1.innerHTML = "Mail : ";
	var tdMail2 = document.createElement('td');
	
	var txtMail = document.createElement('input');
	txtMail.type = "text";
	txtMail.id = 'formUserMail' + nomUser;
	
	if (userData.mail == '' || userData.mail == undefined)
		txtMail.value = '';
	else
		txtMail.value = userData.mail;
	
	txtMail.onchange = function() {
		checkFormUserValidate(nomUser);
	}
	
	var brMailError = document.createElement('br');
	var txtMailError = document.createElement('span');
	txtMailError.style.color = 'red';
	txtMailError.id = 'formUserMail' + nomUser + 'Error';

	tdMail2.appendChild(txtMail);	
	tdMail2.appendChild(brMailError);	
	tdMail2.appendChild(txtMailError);	
	trMail.appendChild(tdMail1);
	trMail.appendChild(tdMail2);
	table.appendChild(trMail);
	
	var trPassword = document.createElement('tr');

	var tdPassword2 = document.createElement('td');
	
	var txtPassword = document.createElement('input');
	txtPassword.type = "text";
	txtPassword.id = 'formUserPassword' + nomUser;
	
	if (userData.password == '' || userData.password == undefined)
		txtPassword.value = '';
	else
		txtPassword.value = userData.password;
		
	txtPassword.onchange = function() {
		document.getElementById('formUserPassword' + nomUser + 'Error').style.display = 'block';
		if (document.getElementById('formUserPassword' + nomUser).value != '')
			document.getElementById('formUserPassword' + nomUser + 'Error').style.display = 'none';
	}
	
	var tdPassword1 = document.createElement('td');
	tdPassword1.innerHTML = "<b><u>Mot de passe \"CHEF\" : </u></b>";
	
	var brPasswordError = document.createElement('br');
	var txtPasswordError = document.createElement('span');
	txtPasswordError.style.display = 'none';
	if (txtPassword.value == '')
		txtPasswordError.style.display = 'block';
	
	txtPasswordError.style.color = 'red';
	txtPasswordError.id = 'formUserPassword' + nomUser + 'Error';
	txtPasswordError.innerHTML = 'Doit être <u>non vide</u> !';


	//if (userData.est_chef != 1)
	//	trPassword.style.visibility = 'collapse';
	
	tdPassword2.appendChild(txtPassword);	
	tdPassword2.appendChild(brPasswordError);	
	tdPassword2.appendChild(txtPasswordError);	
	trPassword.appendChild(tdPassword1);
	trPassword.appendChild(tdPassword2);
	table.appendChild(trPassword);
		
	var trBouton = document.createElement('tr');
	var tdBouton1 = document.createElement('td');
	var tdBouton2 = document.createElement('td');

	var cancelButton = document.createElement('input');
	cancelButton.type = "button";
	cancelButton.className = "button";
	cancelButton.value = "Annuler";
	cancelButton.onclick = function() {
		hideCompleteParticipant(nomUser);
	}

	var validateButton = document.createElement('input');
	validateButton.id = "formUserValidate" + nomUser;
	validateButton.type = "button";
	validateButton.className = "button";
	if (nomParticipant != '' || nomUser == '')
		validateButton.value = "Créer";
	else
	{
		validateButton.value = "Modifier";
		validateButton.style.color = "red";
	}
	validateButton.onclick = function() {
		if (nomParticipant != '' || nomUser == '' || confirm("La modification de l'utilisateur va se répertorier sur tout le site... Confirmez-vous l'opération ?"))
		{	
			var nom = document.getElementById('formUserNom' + nomUser).value;
			var login_forum = document.getElementById('formUserLogin' + nomUser).value;
			var site = document.getElementById('formUserSite' + nomUser).value;
			var mail = document.getElementById('formUserMail' + nomUser).value;
			var password = document.getElementById('formUserPassword' + nomUser).value;
			
			if (nomParticipant != '' || nomUser == '')
			{
				getDatas('dbInsertUtilisateur', '', 'nom=' + encode(nom) + '&login_forum=' + encode(login_forum) + '&url_site=' + encode(site) + '&mail=' + encode(mail) + '&password=' + encode(password));
				if (nomUser != nom)
					getDatas('dbUpdateNomParticipant', '', 'nom=' + encode(nomUser) + '&newvalue=' + encode(nom));
			}
			else
			{	
				getDatas('dbUpdateUtilisateur', '', 'nomWhere=' + encode(nomUser) + '&nom=' + encode(nom) + '&login_forum=' + encode(login_forum) + '&url_site=' + encode(site) + '&mail=' + encode(mail) + '&password=' + encode(password));
			}
			
			if (nomParticipant != '')
				refreshParticipants();
			else
				display(currentPage);
		}
	}

	var deleteButton = document.createElement('input');
	deleteButton.type = "button";
	deleteButton.className = "button";
	deleteButton.value = "Supprimer";
	deleteButton.style.color = "red";
	deleteButton.style.display = "none";
	deleteButton.onclick = function() {
		if (confirm("Etes-vous certain de vouloir supprimer cet utilisateur ?\nRemarque : Il ne sert à rien pour le moment..."))
		{
			getDatas('dbDeleteUtilisateur', '', 'nom=' + encode(nomUser));
			display('users');
		}
	}

	tdBouton1.appendChild(deleteButton);
	tdBouton2.appendChild(cancelButton);
	tdBouton2.appendChild(validateButton);
	trBouton.appendChild(tdBouton1);
	trBouton.appendChild(tdBouton2);
	table.appendChild(trBouton);
	
	fieldset.appendChild(table);
	
	var col = document.createElement('td');
	col.colSpan = '4';
	col.width = '400px';
	col.appendChild(fieldset);

	var userLine = document.createElement('tr');
	userLine.id = 'formUser' + nomUser;

	userLine.className = 'etat42';
		
	if (nomParticipant == '' && nomUser != '')
	{
		if (userData.est_inutile == 0)
		{
			fieldset.className = 'etat22';
			if (userData.est_chef == 1)
				fieldset.className = 'etat21';
		}
		else
		{
			deleteButton.style.display = "block";
		}
	}

	userLine.style.width = '400px';
	userLine.appendChild(col);
		
	return userLine;
}

function refreshContenuImageFormZoneAfterUpload(reponse, statut)
{
	initialiseWaitMessage();
	refreshContenuImageFormZone();
	hideWait();
}

function refreshImageFormZoneAfterUpload(reponse, statut)
{
	initialiseWaitMessage();
	document.getElementById('imgPochetteEmissionThumb').src = '../pochettes/comingsoon.jpg';
	refreshImageFormZone();
	envoiMailAdmin(currentItem.numero, 'uploadé', 'Pochette JPG');
	updateZipEmission();
}

function refreshImageToPrintFormZoneAfterUpload(reponse, statut)
{
	initialiseWaitMessage();
	document.getElementById('imgPochetteEmissionThumbToPrint').src = '../pochettes/comingsoon.jpg';
	refreshImageToPrintFormZone();
	updateZipEmission();
}

function refreshImageGifFormZoneAfterUpload(reponse, statut)
{
	initialiseWaitMessage();
	document.getElementById('imgPochetteEmissionThumbGif').src = '../pochettes/comingsoon.jpg';
	refreshImageGifFormZone();
	envoiMailAdmin(currentItem.numero, 'uploadé', 'Pochette GIF');
	updateZipEmission();
}

function refreshContenuImageFormZone()
{
	ImageThumb= new Image();
	ImageThumb.src = '../' + document.getElementById('fileContenuImageUrl').value + '?' + (new Date()).getTime();
	//ImageThumb.src = '../css/news.gif?' + (new Date()).getTime();
	document.getElementById('imgContenuImageThumb').src = ImageThumb.src;
	document.getElementById('imgContenuImage').className = 'etat32';

	document.getElementById('imgContenuImage').href = document.getElementById('imgContenuImageThumb').src;
	document.getElementById('fileContenuImage').value = '';
	document.getElementById('fileContenuImageError').innerHTML = '';
	document.getElementById('fileContenuImageButton').disabled = true; 
}

function refreshImageFormZone()
{
	if (isNew || !siteHaveImageJpg)
	{
		document.getElementById('pochetteEmission').style.display = 'none';
	}
	else
	{
		document.getElementById('pochetteEmission').style.display = 'block';

		getDatas('getImageEmissionFlag', 'emissionHaveImage', 'numero=' + currentItem.numero);
		if (emissionHaveImage)
		{
			ImageThumb= new Image();
			ImageThumb.src = '../pochettes/' + currentItem.nom_fichier + '.jpg?' + (new Date()).getTime();
			document.getElementById('imgPochetteEmissionThumb').src = ImageThumb.src;
			document.getElementById('pochetteEmission').className = 'etat32';
			
			if (currentItem.etat == '3')
				document.getElementById('filePochetteEmissionDeleteButton').disabled = true; 
			else
				document.getElementById('filePochetteEmissionDeleteButton').disabled = false; 			
		}
		else
		{
			document.getElementById('imgPochetteEmissionThumb').src = '../pochettes/comingsoon.jpg';
			document.getElementById('pochetteEmission').className = 'etat42';
			document.getElementById('filePochetteEmissionDeleteButton').disabled = true; 
		}
		document.getElementById('imgPochetteEmission').href = document.getElementById('imgPochetteEmissionThumb').src;
		document.getElementById('numeroEmissionForUploadPochette').value = currentItem.numero;
		document.getElementById('filePochetteEmission').value = '';
		document.getElementById('filePochetteEmissionError').innerHTML = '';
		document.getElementById('filePochetteEmissionButton').disabled = true; 
	}
}

function refreshImageToPrintFormZone()
{
	if (isNew || !siteHaveImageJpgToPrint)
	{
		document.getElementById('pochetteEmissionToPrint').style.display = 'none';
	}
	else
	{
		document.getElementById('pochetteEmissionToPrint').style.display = 'block';

		getDatas('getImageEmissionToPrintFlag', 'emissionHaveImageToPrint', 'numero=' + currentItem.numero);
		
		if (emissionHaveImageToPrint)
		{
			ImageThumb= new Image();
			ImageThumb.src = '../pochettes/' + currentItem.nom_fichier + '-toPrint.jpg?' + (new Date()).getTime();
			document.getElementById('imgPochetteEmissionThumbToPrint').src = ImageThumb.src;
			document.getElementById('pochetteEmissionToPrint').className = 'etat32';
			document.getElementById('imgPochetteEmissionToPrint').href = document.getElementById('imgPochetteEmissionThumbToPrint').src;
			document.getElementById('imgPochetteEmissionToPrint').style.display = 'block';
			document.getElementById('filePochetteEmissionToPrintDeleteButton').disabled = false; 			
		}
		else
		{
			document.getElementById('imgPochetteEmissionThumbToPrint').src = '../pochettes/comingsoon.jpg';
			document.getElementById('pochetteEmissionToPrint').className = 'etat22';
			document.getElementById('imgPochetteEmissionToPrint').style.display = 'none';
			document.getElementById('filePochetteEmissionToPrintDeleteButton').disabled = true;
		}
		document.getElementById('numeroEmissionForUploadPochetteToPrint').value = currentItem.numero + '-toPrint';
		document.getElementById('filePochetteEmissionToPrint').value = '';
		document.getElementById('filePochetteEmissionToPrintError').innerHTML = '';
		document.getElementById('filePochetteEmissionToPrintButton').disabled = true; 
	}
}

function deleteFile(typeFichier)
{
	var objet = '';

	if (typeFichier == 'pochette')
	{
		getDatas('deleteFile', '', 'file=' + '../pochettes/' + currentItem.nom_fichier + '.jpg');
		objet = 'Pochette JPG';
		refreshImageFormZone();
	}		

	if (typeFichier == 'pochetteToPrint')
	{
		getDatas('deleteFile', '', 'file=' + '../pochettes/' + currentItem.nom_fichier + '-toPrint.jpg');
		objet = 'Pochette à imprimer';
		refreshImageToPrintFormZone();
	}		

	if (typeFichier == 'pochetteGif')
	{
		getDatas('deleteFile', '', 'file=' + '../pochettes/' + currentItem.nom_fichier + '.gif');
		objet = 'Pochette GIF';
		refreshImageGifFormZone();
	}	
	
	if (typeFichier == 'mp3')
	{
		getDatas('deleteFile', '', 'file=' + '../mp3/' + currentItem.nom_fichier + '.mp3');
		objet = 'Fichier MP3';
		refreshMp3FormZone();
	}		
	
	if (typeFichier == 'teaserMp3')
	{
		getDatas('deleteFile', '', 'file=' + '../mp3/' + currentItem.nom_fichier + '-teaser.mp3');
		objet = 'Teaser MP3';
		refreshMp3TeaserFormZone();
	}		
		
	envoiMailAdmin(currentItem.numero, 'supprimé', objet);
	updateZipEmission();
}

function refreshImageGifFormZone()
{
	if (isNew || !siteHaveImageGif)
	{
		document.getElementById('pochetteEmissionGif').style.display = 'none';
	}
	else
	{
		document.getElementById('pochetteEmissionGif').style.display = 'block';

		getDatas('getImageEmissionGifFlag', 'emissionHaveImageGif', 'numero=' + currentItem.numero);
		
		document.getElementById('imgPochetteEmissionGif').style.display = 'none';

		if (emissionHaveImageGif)
		{
			ImageThumbGif= new Image();
			ImageThumbGif.src = '../pochettes/' + currentItem.nom_fichier + '.gif?' + (new Date()).getTime();
			document.getElementById('imgPochetteEmissionThumbGif').src = ImageThumbGif.src;
			document.getElementById('pochetteEmissionGif').className = 'etat32';
			document.getElementById('imgPochetteEmissionGif').href = document.getElementById('imgPochetteEmissionThumbGif').src;
			document.getElementById('imgPochetteEmissionGif').style.display = 'block';
			document.getElementById('filePochetteEmissionGifDeleteButton').disabled = false; 
		}
		else
		{
			document.getElementById('pochetteEmissionGif').className = 'etat22';
			document.getElementById('filePochetteEmissionGifDeleteButton').disabled = true; 
		}
		document.getElementById('numeroEmissionForUploadPochetteGif').value = currentItem.numero;
		document.getElementById('filePochetteEmissionGif').value = '';
		document.getElementById('filePochetteEmissionGifError').innerHTML = '';
		document.getElementById('filePochetteEmissionGifButton').disabled = true; 
	}
}

function refreshMp3FormZoneAfterUpload(reponse, statut)
{
	initialiseWaitMessage();
	refreshMp3FormZone();
	getDatas('dbUpdateTimeEmission', 'result', 'id=' + currentItem.id + '&time_min=' + currentItem.time_min + '&time_sec=' + currentItem.time_sec);
	envoiMailAdmin(currentItem.numero, 'uploadé', 'Fichier MP3');
	updateZipEmission();
}

function refreshMp3TeaserFormZoneAfterUpload(reponse, statut)
{
	initialiseWaitMessage();
	refreshMp3TeaserFormZone();
	envoiMailAdmin(currentItem.numero, 'uploadé', 'Teaser MP3');
	updateZipEmission();
}

function refreshMp3FormZone()
{
	if (isNew)
	{
		document.getElementById('mp3Emission').style.display = 'none';
	}
	else
	{
		document.getElementById('mp3Emission').style.display = 'block';
		
		document.getElementById('yesMp3').style.display = 'none';
		document.getElementById('noMp3').style.display = 'none';

		getDatas('getTimeEmission', 'emissionHaveMp3', 'numero=' + currentItem.numero);
		if (emissionHaveMp3 != 0)
		{
			document.getElementById('mp3Emission').className = 'etat32';
			document.getElementById('yesMp3').style.display = 'block';
			document.getElementById('linkMp3Emission').href = '../mp3/' + currentItem.nom_fichier + '.mp3';
			document.getElementById('linkMp3Emission').innerHTML = 'Emission n°' + currentItem.numero;
			document.getElementById('timeMp3Emission').innerHTML = emissionHaveMp3;
			var times = emissionHaveMp3.split(':');
			currentItem.time_min = times[0];
			currentItem.time_sec = times[1];
			
			if (currentItem.etat == '3')
				document.getElementById('fileMp3DeleteButton').disabled = true; 
			else
				document.getElementById('fileMp3DeleteButton').disabled = false; 
		}
		else
		{
			document.getElementById('mp3Emission').className = 'etat42';
			document.getElementById('noMp3').style.display = 'block';
			currentItem.time_min = 0;
			currentItem.time_sec = 0;
			document.getElementById('fileMp3DeleteButton').disabled = true; 
		}
		
		document.getElementById('fileMp3Emission').value = '';
		document.getElementById('fileMp3EmissionError').innerHTML = '';
		document.getElementById('fileMp3EmissionButton').disabled = true; 
		document.getElementById('numeroEmissionForUploadMp3').value = currentItem.numero;
	}
}

function refreshMp3TeaserFormZone()
{
	if (isNew || !siteHaveTeaserMp3)
	{
		document.getElementById('mp3Teaser').style.display = 'none';
	}
	else
	{
		document.getElementById('mp3Teaser').style.display = 'block';
		
		document.getElementById('yesMp3Teaser').style.display = 'none';
		document.getElementById('noMp3Teaser').style.display = 'none';

		getDatas('getTeaserEmissionFlag', 'emissionHaveMp3Teaser', 'numero=' + currentItem.numero);
		if (emissionHaveMp3Teaser != 0)
		{
			document.getElementById('mp3Teaser').className = 'etat32';
			document.getElementById('yesMp3Teaser').style.display = 'block';
			document.getElementById('linkMp3Teaser').href = '../mp3/' + currentItem.nom_fichier + '-teaser.mp3';
			document.getElementById('linkMp3Teaser').innerHTML = 'Teaser de l\'émission';
			document.getElementById('fileMp3TeaserDeleteButton').disabled = false; 
		}
		else
		{
			document.getElementById('mp3Teaser').className = 'etat22';
			document.getElementById('noMp3Teaser').style.display = 'block';
			document.getElementById('fileMp3TeaserDeleteButton').disabled = true; 
		}
		
		document.getElementById('fileMp3Teaser').value = '';
		document.getElementById('fileMp3TeaserError').innerHTML = '';
		document.getElementById('fileMp3TeaserButton').disabled = true; 
		document.getElementById('numeroTeaserForUploadMp3').value = currentItem.numero + '-teaser';
	}
}

function updateVideoTeaser()
{
	showWait();
	var urlTeaserVideo = document.getElementById('txtVideoTeaser').value;
	urlTeaserVideo = urlTeaserVideo.replace('http://www.youtube.com/watch?v=', 'http://www.youtube.com/v/');
	getDatas('dbUpdateTeaserVideoEmission', 'result', 'id=' + currentItem.id + '&teaser_video=' + encode(urlTeaserVideo));
	getDatas('dbGetEmission', 'currentEmissionDatas', 'id=' + currentItem.id);
	currentItem.teaser_video = currentEmissionDatas.teaser_video;
	refreshVideoTeaserFormZone();
	
	updateZipEmission();
}

function updateZipEmission()
{
	initialiseWaitMessage();
	if (siteHaveZip && currentItem.etat == 3)
	{
		changeWaitMessage("<b>Regénération du ZIP de l'émission...</b><br />Parce que les données ont changées alors que l'émission déjà publiée !!");
		getDatas('createZipEmission', 'result', 'id=' + currentItem.id);
		initialiseWaitMessage();
	}
	hideWait();
}

function refreshVideoTeaserFormZone()
{
	document.getElementById('txtVideoTeaser').value = '';
	document.getElementById('linkVideoTeaserValue').value = '';
	document.getElementById('linkVideoTeaserSrc').src = '';

	if (isNew || !siteHaveTeaserVideo)
	{
		document.getElementById('videoTeaser').style.display = 'none';
	}
	else
	{
		document.getElementById('videoTeaser').style.display = 'block';
		
		document.getElementById('yesVideoTeaser').style.display = 'none';
		document.getElementById('noVideoTeaser').style.display = 'none';
		
		if (currentItem.teaser_video != '')
		{
			document.getElementById('videoTeaser').className = 'etat32';
			document.getElementById('yesVideoTeaser').style.display = 'block';
			document.getElementById('linkVideoTeaserValue').value = currentItem.teaser_video;
			document.getElementById('linkVideoTeaserSrc').src = currentItem.teaser_video;
			document.getElementById('txtVideoTeaser').value = currentItem.teaser_video;
		}
		else
		{
			document.getElementById('videoTeaser').className = 'etat22';
			document.getElementById('noVideoTeaser').style.display = 'block';
		}
		
		document.getElementById('txtVideoTeaserError').innerHTML = '';
		document.getElementById('txtVideoTeaserButton').disabled = true; 
	}
}

function verifEmission(idEmission)
{
	getDatas('dbGetEmissionCompleteFlag', 'isComplete', 'id=' + idEmission);
	if (!isComplete)
	{	
		return false;
	}
		
	return verifMorceaux(idEmission);
}

function verifParticipants(idEmission)
{
	getDatas('dbGetParticipantsEmissionFlag', 'emissionHaveParticipants', 'id=' + idEmission);
	return emissionHaveParticipants;
}

function verifMorceaux(idEmission)
{
	getDatas('dbGetMorceauxEmissionFlag', 'emissionHaveMorceaux', 'id=' + idEmission);
	return emissionHaveMorceaux;
}

function createLigneEmission(emissionData)
{
	var col1 = document.createElement('td');
	col1.className = 'thumbEmission';
	var thumb = document.createElement('img');
	thumb.src = '../pochettes/' + emissionData.nom_fichier + '.jpg?' + (new Date()).getTime();
	thumb.className = 'thumbEmission';
	col1.appendChild(thumb);
	var col2 = document.createElement('td');
	col2.className = 'titreEmission';
	col2.className = 'padded';
	if (siteHaveTitre)
		col2.innerHTML = emissionData.numero + ' - ' + emissionData.titre;
	else
		col2.innerHTML = 'Emission n°' + emissionData.numero;
		
	var col3 = document.createElement('td');
	col3.className = 'padded, dateEmission';
	
	if (emissionData.etat == 1)
		col3.innerHTML = emissionData.libelle;

	if (emissionData.etat == 2)
		col3.innerHTML = emissionData.libelle + ' pour le : ' + emissionData.date_sortie;
		
	if (emissionData.etat == 3)
		col3.innerHTML = emissionData.libelle + ' le : ' + emissionData.date_sortie;
		
	var col5 = document.createElement('td');
	col5.className = 'actionEmission';
	var col6 = document.createElement('td');
	col6.className = 'actionEmission';
	var col7 = document.createElement('td');
	col7.className = 'actionEmission';
	//var linkModifier = document.createElement('a');
	var linkModifier = document.createElement('input');
	linkModifier.type = 'button';
	if (admin == '')
		//linkModifier.innerHTML = 'Modifier';
		linkModifier.value = 'Modifier';
	else
	{
		if (siteHaveTeaserMp3 || siteHaveTeaserVideo)
			//linkModifier.innerHTML = "Uploader le teaser, la pochette, ou le mp3 / Envoyer votre playlist à l'administrateur";
			linkModifier.value = "Uploader le teaser, la pochette, ou le mp3 / Envoyer votre playlist à l'administrateur";
		else
			//linkModifier.innerHTML = "Uploader la pochette ou le mp3 / Envoyer votre playlist à l'administrateur";
			linkModifier.value = "Uploader la pochette ou le mp3 / Envoyer votre playlist à l'administrateur";
	}
	
	//linkModifier.href = '#';
	linkModifier.onclick = function () {
		currentItem = emissionData;
		display('playlist');
		}
	col5.appendChild(linkModifier);
	
	//Pour une émission cachée :
	if (emissionData.etat == 1)
	{
		if (siteHaveStatutAnnounced && (emissionData.titre != '' || !siteHaveTitre))
		{
			//var saut1 = document.createElement('span');
			//saut1.innerHTML = " / ";	
			//col5.appendChild(saut1);
			//var linkAnnonce = document.createElement('a');
			var linkAnnonce = document.createElement('input');
			linkAnnonce.type = 'button';
			//linkAnnonce.innerHTML = 'Annoncer';
			linkAnnonce.value = 'Annoncer';
			//linkAnnonce.href = '#';
			linkAnnonce.onclick = function () {
				if (verifParticipants(emissionData.id))
				{
					if (confirm('Certain de vouloir annoncer cette émission ?\n\nCelle-ci apparaitra alors dans la page des news...'))
					{
						getDatas('dbUpdateEtatEmission', 'result', 'id=' + emissionData.id + '&etat=2');
						display('playlists');
					}
				}
				else
				{
					alert('Merci de rentrer les participants de l\'émission pour pouvoir l\'annoncer.');
					currentItem = emissionData;
					display('playlist');
				}
			}
			col6.appendChild(linkAnnonce);
		}
		
		if (siteHaveStatutAnnounced || admin == '')
		{
			//var saut2 = document.createElement('span');
			//saut2.innerHTML = " / ";	
			//col5.appendChild(saut2);
			//var linkDelete = document.createElement('a');
			var linkDelete = document.createElement('input');
			linkDelete.type = 'button';
			//linkDelete.innerHTML = 'Supprimer';
			linkDelete.value = 'Supprimer';
			//linkDelete.href = '#';
			linkDelete.onclick = function () {
					if (confirm('Certain de vouloir supprimer cette émission ?'))
					{
						if (confirm('Pas de regrets ?'))
						{
							getDatas('dbDeleteCascadeEmission', 'result', 'id=' + emissionData.id);
							display('playlists');
						}
					}
				}
			col7.appendChild(linkDelete);
		}
	}
	
	//Pour une émission annoncée :
	if (admin == '' && (emissionData.etat == 2 || (!siteHaveStatutAnnounced && emissionData.etat == 1)))
	{
		//var saut3 = document.createElement('span');
		//saut3.innerHTML = " / ";	
		//col5.appendChild(saut3);

		//var linkPreview = document.createElement('a');
		var linkPreview = document.createElement('input');
		linkPreview.type = 'button';
		//linkPreview.innerHTML = 'Preview';
		linkPreview.value = 'Preview';
		//linkPreview.href = urlPreview.replace("{numero}", emissionData.id);
		linkPreview.onclick = function () { window.open(urlPreview.replace("{numero}", emissionData.numero)); };
		//linkPreview.target = 'blank';
		col6.appendChild(linkPreview);
	
		//var saut4 = document.createElement('span');
		//saut4.innerHTML = " / ";	
		//col5.appendChild(saut4);
		//var linkPublish = document.createElement('a');
		var linkPublish = document.createElement('input');
		linkPublish.type = 'button';
		//linkPublish.innerHTML = 'Publier';
		linkPublish.value = 'Publier';
		//linkPublish.href = '#';
		linkPublish.onclick = function () {
			if (verifParticipants(emissionData.id) && verifEmission(emissionData.id))
			{
				if (confirm('Certain de vouloir publier cette émission ? Go ?'))
				{
					getDatas('dbUpdateEtatEmission', 'result', 'id=' + emissionData.id + '&etat=3');
					
					if (siteHaveZip)
						getDatas('createZipEmission', 'result', 'id=' + emissionData.id);
					
					display('playlists');
					alert('Yeah ;)');
				}
			}
			else
			{
				alert('Pas possible de publier cette émission pour le moment... Il faut la compléter avant !!');
				currentItem = emissionData;
				display('playlist');
			}
			}
		col7.appendChild(linkPublish);
	}
	
	var emission = document.createElement('tr');
	emission.className = 'etat' + emissionData.etat + alternate;
	emission.appendChild(col1);
	emission.appendChild(col2);
	if (admin == '')
	{
		emission.appendChild(col3);
		//emission.appendChild(col4);
	}
	emission.appendChild(col5);
	emission.appendChild(col6);
	emission.appendChild(col7);
		
	if (alternate == 1)
		alternate = 2;
	else
		alternate = 1;

	return emission;
}

function dateForDB(date)
{
	if (date == '??/??/????')
		return '0000-00-00 00:00:00';
	else
		return date.substring(6,10) + '-' + date.substring(3,5) + '-' + date.substring(0,2) + ' 00:00:00';
}

function formAddParticipant()
{
	var enreg = new Array();
	enreg['id'] = currentItem.id;
	enreg['nom'] = document.getElementById('txtNomParticipant').value;
	enreg['ordre'] = 0;
	enreg['est_chef'] = 0;
	
	getDatas('dbInsertParticipant', 'result', 'id=' + enreg.id + '&nom=' + encode(enreg.nom) + '&ordre=' + enreg.ordre + '&est_chef=' + enreg.est_chef);
	
	refreshParticipants();
}

function addDefaultParticipantEmission(numero_emission)
{
	getDatas('dbGetEmissionByNumero', 'emissionToGet', 'id_site=' + id_site + '&numero=' + numero_emission);

	var enreg = new Array();
	enreg['id'] = emissionToGet.id;
	enreg['nom'] = siteDefaultParticipant;
	enreg['ordre'] = 0;
	enreg['est_chef'] = 1;
	
	getDatas('dbInsertParticipant', 'result', 'id=' + enreg.id + '&nom=' + encode(enreg.nom) + '&ordre=' + enreg.ordre + '&est_chef=' + enreg.est_chef);
}

function formEnregistrer()
{
	var enreg = new Array();
	enreg['id'] = currentItem.id;
	enreg['numero'] = document.getElementById('txtNumeroEmission').value;
	enreg['titre'] = document.getElementById('txtTitreEmission').value;
	enreg['date_sortie'] = dateForDB(document.getElementById('txtDateEmission').value);
	enreg['etat'] = currentItem.etat;
	enreg['time_min'] = currentItem.time_min;
	enreg['time_sec'] = currentItem.time_sec;

	//alert('numero=' + enreg.numero + '&titre=' + encode(enreg.titre) + '&date_sortie=' + enreg.date_sortie + '&etat=' + enreg.etat + '&time_min=' + enreg.time_min + '&time_sec=' + enreg.time_sec);
	if (isNew)
	{
		getDatas('dbInsertEmission', 'result', 'id_site=' + id_site + '&numero=' + enreg.numero + '&titre=' + encode(enreg.titre) + '&date_sortie=' + enreg.date_sortie + '&etat=' + enreg.etat + '&time_min=' + enreg.time_min + '&time_sec=' + enreg.time_sec);
		if (!siteHaveParticipants)
			addDefaultParticipantEmission(enreg['numero']);
	}
	else
		getDatas('dbUpdateEmission', 'result', 'id=' + enreg.id + '&id_site=' + id_site + '&numero=' + enreg.numero + '&titre=' + encode(enreg.titre) + '&date_sortie=' + enreg.date_sortie + '&etat=' + enreg.etat + '&time_min=' + enreg.time_min + '&time_sec=' + enreg.time_sec);

	isNew = false;
	alert('Enregistrement réussi !');
	updateZipEmission();
	display('playlists');
}

function newEmission()
{
	isNew = true;
	getDatas('dbGetNewNumeroEmission', 'newNumber', 'id_site=' + id_site);
	currentItem = new Array();
	currentItem['id_site'] = id_site;
	currentItem['numero'] = newNumber;
	currentItem['nom_fichier'] = 'no_file';
	currentItem['titre'] = '';
	currentItem['date_sortie'] = '??/??/????';
	currentItem['etat'] = 1;
	currentItem['time_min'] = 0;
	currentItem['time_sec'] = 0;
	display('playlist');
	document.getElementById('formEnregistrer').style.display = 'block';
	document.getElementById('formEnregistrerAnnuler').style.display = 'block';
	document.getElementById('formEnregistrer').disabled = (siteHaveTitre && !Verif_NonVide(document.getElementById('txtTitreEmission')));
}

function validateExtension(control, extension, extension2)
{
	document.getElementById(control.id + 'Error').innerHTML = '';

	if (extension2 == undefined)
		extension2 = extension;
	
	var updateExtension = false;
	if (control.id == 'fileContenuImage')
		updateExtension = true;
		
	if (control.value.substring(control.value.lastIndexOf('.') + 1).toUpperCase() != extension.toUpperCase() && control.value.substring(control.value.lastIndexOf('.') + 1).toUpperCase() != extension2.toUpperCase())
	{
		control.value = '';
		document.getElementById(control.id + 'Button').disabled = true; 
		document.getElementById(control.id + 'Error').innerHTML = 'Le type de fichier est incorrect, il faut du ' + extension;
	}	
	else
	{
		document.getElementById(control.id + 'Button').disabled = false; 
		if (updateExtension)
			document.getElementById(control.id + 'Extension').value = "." + extension; 
	}
}

function validateAdresseYoutube(control, bouton)
{
	if (bouton == undefined)
		bouton = document.getElementById(control.id + 'Button');
		
	document.getElementById(control.id + 'Error').innerHTML = '';
	if (control.value != '' && control.value.indexOf('http://www.youtube.com/watch?v=') != 0)
	{
		bouton.disabled = true; 
		document.getElementById(control.id + 'Error').innerHTML = 'L\'adresse YouTube est incorrecte, il faut qu\'elle commence par "http://www.youtube.com/watch?v="';
	}	
	else
		bouton.disabled = false; 
}

function refreshMorceaux()
{
	//if (isNew || admin != '')		
	if (isNew)		
	{
		document.getElementById('morceaux').style.display = 'none';
	}
	else
	{
		document.getElementById('morceaux').style.display = 'block';
		document.getElementById('haveMorceaux').style.display = 'block';
		document.getElementById('noMorceaux').style.display = 'none';
		document.getElementById('listeMorceaux').style.display = 'none';
		
		getDatas('dbGetListeParticipantsEmission', 'participantsEmission', 'id=' + currentItem.id);
		
		if (participantsEmission.length == 0)
		{
			document.getElementById('haveMorceaux').style.display = 'none';
			document.getElementById('noMorceaux').style.display = 'block';
			document.getElementById('morceaux').className = 'etat42';
		}
		else
		{
			document.getElementById('listeMorceaux').style.display = 'block';
			document.getElementById('morceaux').className = 'etat32';
			
			while (document.getElementById('listeMorceaux').hasChildNodes())
				document.getElementById('listeMorceaux').removeChild(document.getElementById('listeMorceaux').firstChild);

			alternate = 1;
			ordreParticipant = 1;
									
			for(var i=0; i<participantsEmission.length; i++)
			{
				document.getElementById('listeMorceaux').appendChild(createLigneParticipantPlaylist(participantsEmission[i]));			
			}
		}
	}
}

//Formatage d'une durée :
function toTime(entier)
{
    if (entier.length == 1)
	   return '0' + entier;
	else
		return entier;
}

function createLigneParticipantPlaylist(participantData)
{
	var txtMorceaux = document.createElement('textarea');
	txtMorceaux.id = 'txtMorceauPlaylist' + participantData.nom_utilisateur;
	txtMorceaux.style.width = '100%';
	if (siteHaveParticipants)
		txtMorceaux.style.height = '150px';
	else
		txtMorceaux.style.height = '350px';
	
	var spnError = document.createElement('span');
	spnError.id = 'spnErrorPlaylist' + participantData.nom_utilisateur;	
	spnError.style.color = 'red';
	
	var btnValider = document.createElement('input');
	btnValider.type = 'button';
	btnValider.className = 'button';
	btnValider.value = 'Valider';
	btnValider.id = 'btnValiderPlaylist' + participantData.nom_utilisateur;
	btnValider.onclick = function() {
		document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).innerHTML = '';
		var morceaux = document.getElementById('txtMorceauPlaylist' + participantData.nom_utilisateur).value.split('\n');
		var nbMorceaux = 0;
		var erreur = false;
		
		var newPlaylist = new Array();
			
		for (var i=0; i<morceaux.length; i++)
		{
			var morceau = morceaux[i].trim();
			var newMorceau = new Array();
			newMorceau['time_min'] = '';
			newMorceau['time_sec'] = '';
			newMorceau['nom_artiste'] = '';
			newMorceau['nom_morceau'] = '';
			newMorceau['nom_label'] = '';
			newMorceau['annee'] = '';
			
			if (morceau != '')
			{
				nbMorceaux++;
				if (morceau.indexOf(':') == -1)
				{
					erreur = true;
					break;
				}
				if (morceau.indexOf(' ') == -1)
				{
					erreur = true;
					break;
				}
				if (morceau.indexOf(' - ') == -1)
				{
					erreur = true;
					break;
				}
				
				newMorceau['time_min'] = morceau.substring(0, morceau.indexOf(':'));
				newMorceau['time_sec'] = morceau.substring(morceau.indexOf(':') + 1, morceau.indexOf(' '));
				newMorceau['nom_artiste'] = morceau.substring(morceau.indexOf(' ') + 1, morceau.indexOf(' - '));
				newMorceau['nom_morceau'] = morceau.substring(morceau.indexOf(' - ') + 3);				

				newPlaylist.push(newMorceau);
			}
		}
		if (erreur)
		{
			document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).style.color = 'red';
			document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).innerHTML = 'Erreur sur le morceau n°' + (nbMorceaux) + ' ! Allé... cherche ! :)';
		}
		else
		{
			document.getElementById('btnEnregistrerPlaylist' + participantData.nom_utilisateur).datas = newPlaylist;
		
			document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).style.color = 'blue';
			
			document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).innerHTML = '<br /><u><b>' + newPlaylist.length + ' morceaux trouvés :</b></u>';
			document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).innerHTML += '<table width="100%">';
			document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).innerHTML += '<tr><td width="10%"><b><u>Minutes</u></b> </td><td width="10%"><b><u>Secondes</u></b> </td><td width="40%"><b><u>Nom artiste</u></b> </td><td width="40%"><b><u>Nom morceaux</u></b> </td></tr>';
			
			for (var i=0; i<newPlaylist.length; i++)
				document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).innerHTML += '<tr><td>' + newPlaylist[i]['time_min'] + '</td><td>' + newPlaylist[i]['time_sec'] + '</td><td>' + newPlaylist[i]['nom_artiste'] + '</td><td>' + newPlaylist[i]['nom_morceau'] + "</td></tr>";

			document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).innerHTML += '</table>';
			document.getElementById('txtMorceauPlaylist' + participantData.nom_utilisateur).style.display = 'none';
			document.getElementById('btnValiderPlaylist' + participantData.nom_utilisateur).style.display = 'none';
			document.getElementById('btnEnregistrerPlaylist' + participantData.nom_utilisateur).style.display = 'block';
			document.getElementById('btnCorrigerPlaylist' + participantData.nom_utilisateur).style.display = 'block';
		}
	}
	
	var btnCorriger = document.createElement('input');
	btnCorriger.type = 'button';
	btnCorriger.className = 'button';
	btnCorriger.value = '<< Corriger';
	btnCorriger.style.display = 'none';
	btnCorriger.id = 'btnCorrigerPlaylist' + participantData.nom_utilisateur;
	btnCorriger.onclick = function() {
		document.getElementById('txtMorceauPlaylist' + participantData.nom_utilisateur).style.display = 'block';
		document.getElementById('btnValiderPlaylist' + participantData.nom_utilisateur).style.display = 'block';
		document.getElementById('btnEnregistrerPlaylist' + participantData.nom_utilisateur).style.display = 'none';
		document.getElementById('btnCorrigerPlaylist' + participantData.nom_utilisateur).style.display = 'none';
		document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).style.color = 'red';
		document.getElementById('spnErrorPlaylist' + participantData.nom_utilisateur).innerHTML = '';
	}
	
	var btnEnregistrer = document.createElement('input');
	btnEnregistrer.type = 'button';
	btnEnregistrer.className = 'button';
	btnEnregistrer.value = '>> Enregistrer !';
	btnEnregistrer.datas = new Array();
	btnEnregistrer.style.display = 'none';
	btnEnregistrer.id = 'btnEnregistrerPlaylist' + participantData.nom_utilisateur;
	btnEnregistrer.onclick = function() {
		getDatas('dbDeletePlaylistParticipant', '', 'id=' + currentItem.id + '&nom=' + encode(participantData.nom_utilisateur));
		//on les recrée à partir de this.datas[i].time_min, ...
		for (var i=0; i<this.datas.length; i++)
			getDatas('dbInsertMorceau', '', 'id=' + currentItem.id + '&nom=' + encode(participantData.nom_utilisateur) + '&time_min=' + this.datas[i].time_min + '&time_sec=' + this.datas[i].time_sec + '&nom_artiste=' + encode(this.datas[i].nom_artiste) + '&nom_morceau=' + encode(this.datas[i].nom_morceau) + '&nom_label=' + encode(this.datas[i].nom_label) + '&annee=' + encode(this.datas[i].annee));
		
		refreshParticipants();
		
		updateZipEmission();
	}
	
	
	getDatas('dbGetPlaylistParticipant', 'listeMorceauxParticipant', 'id=' + currentItem.id + '&nom=' + encode(participantData.nom_utilisateur));

	txtMorceaux.value = '';
	
	for (var j=0; j<listeMorceauxParticipant.length; j++)
	{
		var data = listeMorceauxParticipant[j];
		txtMorceaux.value = txtMorceaux.value + '\n' + toTime(data.time_min) + ':' + toTime(data.time_sec) + ' ' + data.nom_artiste + ' - ' + data.nom_morceau;
	}

	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	
	var liParticipant = document.createElement('li');
	
	if (siteHaveParticipants)
	{
		liParticipant.innerHTML = "<b><u>Playlist de " + participantData.nom_utilisateur + " :</u></b><br />";
		liParticipant.appendChild(br1);
	}
	
	liParticipant.appendChild(txtMorceaux);
	liParticipant.appendChild(spnError);
	liParticipant.appendChild(br2);
	liParticipant.appendChild(btnValider);
	liParticipant.appendChild(btnCorriger);
	liParticipant.appendChild(btnEnregistrer);
	liParticipant.appendChild(br3);
	
	return liParticipant;
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function ltrim(stringToTrim) {
	return stringToTrim.replace(/^\s+/,"");
}
function rtrim(stringToTrim) {
	return stringToTrim.replace(/\s+$/,"");
}

function Verif_NonVide(control)
{
	control.value = trim(control.value);
	var titre = control.value;
	var erreur = document.getElementById(control.id + 'Error');
	erreur.innerHTML = '';

	if (titre == '')
	{
		if (control.id == 'txtNomParticipant')
		{
			erreur.innerHTML = "Un participant doit avoir un nom !";
			return false;
		}
		if (control.id.indexOf('formUserNom') == 0)
		{
			erreur.innerHTML = "Le nom doit être renseigné";
			return false;
		}
		if (control.id.indexOf('formUserLogin') == 0)
		{
			erreur.innerHTML = "Le login doit être renseigné";
			return false;
		}
		if (control.id.indexOf('formUserSite') == 0)
		{
			erreur.innerHTML = "Le site doit être renseigné";
			return false;
		}
		if (control.id.indexOf('formUserMail') == 0)
		{
			erreur.innerHTML = "Le mail doit être renseigné";
			return false;
		}
		if (control.id.indexOf('txtZonePage') == 0)
		{
			erreur.innerHTML = "La référence doit être renseignée";
			return false;
		}
		if (control.id.indexOf('ddlListePageSite') == 0)
		{
			erreur.innerHTML = "La page doit être renseignée";
			return false;
		}
		
		if (control.id.indexOf('txtTitreEmission') == 0)
		{
			erreur.innerHTML = "Une émission doit avoir un titre !";
			return false;
		}
		
		if (control.id.indexOf('txtTitre') == 0)
		{
			erreur.innerHTML = "Vous devez obligatoirement saisir un titre !";
			return false;
		}		
	}
	else
		return true;
}

function Verif_MailValide(control)
{
	control.value = trim(control.value);
	var titre = control.value;
	var erreur = document.getElementById(control.id + 'Error');
	erreur.innerHTML = '';

	if (titre == '')
		return true;
	else
	{
		if (titre.indexOf('@') == -1 || titre.indexOf('.') == -1)
		{
			erreur.innerHTML = "Le mail doit être valide !";
			return false;
		}
		else
		{
			return true;
		}
	}
}

function Verif_Numero(control)
{
	control.value = trim(control.value);
	var numero = control.value;
	var erreur = document.getElementById(control.id + 'Error');
	erreur.innerHTML = '';

	if (numero == currentItem.numero)
		return true;
		
	if (numero == '' || !(!/\D/.test(numero)))
	{
		erreur.innerHTML = "Ceci n'est pas un numéro correct, voyons...!";
		return false;
	}
	else
	{
		getDatas('dbGetEmissionByNumero', 'emissionToCheck', 'id_site=' + id_site + '&numero=' + numero);
		if (emissionToCheck != 0)
		{
			erreur.innerHTML = "Ce numéro est déjà pris par une autre émission...";
			return false;
		}
		else
			return true;
	}	
}

function encode(texte)
{
	//return texte;
	return escape( encodeURIComponent( texte ) );
	//return escape(texte);
}

function decode(s)
{
  return unescape(s);
}

function encode_utf8( s )
{
  return escape( encodeURIComponent( s ) );
  //return unescape( encodeURIComponent( s ) );
}

function decode_utf8( s )
{
  return decodeURIComponent( escape( s ) );
}

// Enleve le '0' des nb < 10
function ConvNum(tabDeDate) {
	for (i=0; i<tabDeDate.length; i++)
		tabDeDate[i] = (tabDeDate[i].charAt(0)=='0')?tabDeDate[i].charAt(1):tabDeDate[i];
	return tabDeDate;
}

// Vérifie le format d une date saisie
function Verif_Date(control)
{ 
	control.value = trim(control.value);
	var valeur_date = control.value;
	var erreur = document.getElementById(control.id + 'Error');
	erreur.innerHTML = '';

	if (valeur_date == '??/??/????')
		return true;
	
	var tabDate = valeur_date.split('/');
	tabDate = ConvNum(tabDate);
	var datTest_Date = new Date(parseInt(tabDate[2]), parseInt(tabDate[1])-1, parseInt(tabDate[0]));
	if (valeur_date.length>10)
	{ 
		erreur.innerHTML = 'Ne dois pas dépasser 10 caractères.';
		return false;
	}
	
	for (i=0; i<valeur_date.length; i++)
	{ 
		if (valeur_date.charAt(i) == ' ')
		{ 
			erreur.innerHTML = "La date ne doit pas contenir d'espaces.";
			return false;
		}
	}

	if (valeur_date.length > 0)
	{ 
		if ((parseInt(tabDate[0]) != datTest_Date.getDate()) || (parseInt(tabDate[1]) != parseInt(datTest_Date.getMonth())+1))
		{ 
			erreur.innerHTML = "Veuillez saisir la date au format JJ/MM/AAAA. (ex : 31/01/2010)";
			return false;
		}

		if ((tabDate[2].length != 4) || (parseInt(tabDate[2]) < 1980) || (parseInt(tabDate[2]) > 2099))
		{ 
			erreur.innerHTML = "Veuillez saisir l'année sur 4 chiffres. Elle doit être comprise entre 1980 et 2099.";
			return false;
		}
	}
	return true;
}


