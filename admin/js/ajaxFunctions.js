  // ------------- AVEC JQUERY -------------
  // Fonction lancer une fois la page chargée
   $(document).ready(function(){
    
     // Une fois la page prête (DOM ready), on prépare le formulaire d'Upload
      var optionsPochette = { 
        //target:        '#formUploadPochette #message',   // target element(s) to be updated with server response 
        beforeSubmit:  fonctionAvantUL,      // pre-submit callback 
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
        beforeSubmit:  fonctionAvantUL,      // pre-submit callback 
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
        beforeSubmit:  fonctionAvantUL,      // pre-submit callback 
        success:       refreshImageGifFormZoneAfterUpload,      // post-submit callback 
 
        // other available options: 
		//upload_image.php
		async: false,
        url:  '../dbFunctions/imageReceptor.php',         // override for form's 'action' attribute 
        type: 'POST',                     // 'get' or 'post', override for form's 'method' attribute 
        contentType: 'multipart/form-data'
    }; 
      var optionsNews = { 
        //target:        '#formUploadPochette #message',   // target element(s) to be updated with server response 
        beforeSubmit:  fonctionAvantUL,      // pre-submit callback 
        success:       refreshNewsFormZoneAfterUpload,      // post-submit callback 
 
        // other available options: 
		//upload_image.php
		async: false,
        url:  '../dbFunctions/imageReceptor.php',         // override for form's 'action' attribute 
        type: 'POST',                     // 'get' or 'post', override for form's 'method' attribute 
        contentType: 'multipart/form-data'
    }; 
      var optionsMp3 = { 
        //target:        '#upload #message',   // target element(s) to be updated with server response 
        beforeSubmit:  fonctionAvantUL,      // pre-submit callback 
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
        beforeSubmit:  fonctionAvantUL,      // pre-submit callback 
        success:       refreshMp3TeaserFormZoneAfterUpload,      // post-submit callback 
 
        // other available options: 
		//upload_image.php
		async: false,
        url:  '../dbFunctions/imageReceptor.php',         // override for form's 'action' attribute 
        type: 'POST',                     // 'get' or 'post', override for form's 'method' attribute 
        contentType: 'multipart/form-data'
    }; 
 
    // bind form using 'ajaxForm' 
    $('#formUploadNews').ajaxForm(optionsNews); 
    $('#formUploadPochette').ajaxForm(optionsPochette); 
    $('#formUploadPochetteToPrint').ajaxForm(optionsPochetteToPrint); 
    $('#formUploadPochetteGif').ajaxForm(optionsPochetteGif); 
    $('#formUploadMp3').ajaxForm(optionsMp3); 
    $('#formUploadMp3Teaser').ajaxForm(optionsMp3Teaser); 
     
    
 });   
// --------------    UPLOAD
// pre-submit callback 
function fonctionAvantUL(formData, jqForm, options) { 
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
var currentPage = 'home';

function display(page)
{
	if (admin != '' && page != 'playlists' && page != 'playlist')
		page = 'playlists';
	
	currentPage = page;
	
	document.getElementById('playlists').style.display = 'none';
	document.getElementById('playlist').style.display = 'none';
	document.getElementById('users').style.display = 'none';
	document.getElementById('news').style.display = 'none';
	document.getElementById('home').style.display = 'none';
	
	document.getElementById(page).style.display = 'block';
	
	if (admin == '')
	{
		document.getElementById('buttonMenuhome').style.color = 'black';
		document.getElementById('buttonMenuplaylists').style.color = 'black';
		document.getElementById('buttonMenuusers').style.color = 'black';
		document.getElementById('buttonMenunews').style.color = 'black';
		
		document.getElementById('texteChef').style.display = 'none';
		document.getElementById('mailAdmin').style.display = 'none';
		
		if (!haveParticipants)
			document.getElementById('buttonMenuusers').style.display = 'none';
			
		if (!haveContenuPages)
			document.getElementById('buttonMenunews').style.display = 'none';
	}
	else
	{
		document.getElementById('buttonMenuhome').style.display = 'none';
		document.getElementById('buttonMenuplaylists').style.display = 'none';
		document.getElementById('buttonMenuusers').style.display = 'none';
		document.getElementById('buttonMenunews').style.display = 'none';
		
		document.getElementById('ajoutEmission').style.display = 'none';
		document.getElementById('txtEnvoiMail').value = '';
		document.getElementById('boutonEnvoiMail').disabled = true;
	}
	
	if (page != 'playlist')
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
			getDatas('dbListeAllEmission', 'listeEmissions', '');
		else
			getDatas('dbListeAllEmissionForChef', 'listeEmissions', 'admin=' + encode(admin));
		
		if (listeEmissions.length == 0)
			document.getElementById('spanChefNoEmission').style.display = 'block';
		
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
		
		if (currentItem.titre != '')
			document.getElementById('emission').className = 'etat32';
		else
			document.getElementById('emission').className = 'etat42';
		
		if (currentItem.etat == 3)
			document.getElementById('lblDateEmissionPublie').style.display = 'block';
		else
			document.getElementById('lblDateEmission').style.display = 'block';
		
		if (haveZip && admin == '' && currentItem.etat == 3)
			document.getElementById('boutonUpdateZipEmission').style.display = 'block';

		if (admin != '')
		{
			document.getElementById('txtNumeroEmission').disabled = true;
			document.getElementById('txtTitreEmission').disabled = true;
			document.getElementById('trDateEmission').style.display = 'none';
			document.getElementById('trBoutonsEmission').style.display = 'none';
		}

		refreshImageFormZone();
		refreshImageToPrintFormZone();
		refreshImageGifFormZone();
		refreshMp3FormZone();
		refreshMp3TeaserFormZone();
		refreshVideoTeaserFormZone();
		refreshParticipants();
	}
	else 
	{
		isNew = false;
		currentItem = '';
	}	
	
	if (page == "news")
	{
		refreshNewsFormZone();
	}
	
	if (page == 'users')
	{
		//On masque le formulaire de création d'un user :
		while (document.getElementById('editUser').hasChildNodes())
			document.getElementById('editUser').removeChild(document.getElementById('editUser').firstChild);
	
		//Vidage + Affichage de la liste des utilisateurs.
		refreshUtilisateurs();		
	}
	
	hideWait();
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

	getDatas('dbGetListeAllParticipantsUsersAndGroupes', 'allUsersAndGroupes', '');
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

	getDatas('dbListeAllUtilisateurs', 'listeAllUsers', '');
	alternate = 1;
		
	for(var i=0; i<listeAllUsers.length; i++)
	{
		document.getElementById('listeUsers').appendChild(createLigneUtilisateur(listeAllUsers[i]));			
	}
}


var listeParticipantsEmissionDatas = new Array();
function refreshParticipants()
{
	hideAddParticipant();
	if (isNew || admin != '')		
	{
		document.getElementById('participants').style.display = 'none';
	}
	else
	{
		document.getElementById('participants').style.display = 'block';
		document.getElementById('noParticipants').style.display = 'none';
		document.getElementById('listeParticipants').style.display = 'none';
		if (!verifParticipants(currentItem.numero))
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

			getDatas('dbGetListeParticipantsEmission', 'participantsEmission', 'numero=' + currentItem.numero);
			alternate = 1;
			ordreParticipant = 1;
			
			document.getElementById('listeParticipants').appendChild(createEnteteParticipantEmission());			
			
			listeParticipantsEmissionDatas = new Array();
			
			for(var i=0; i<participantsEmission.length; i++)
			{
				document.getElementById('listeParticipants').appendChild(createLigneParticipantEmission(participantsEmission[i]));			
				listeParticipantsEmissionDatas[participantsEmission[i].nom_utilisateur] = participantsEmission[i];
			}
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
	
	var radio = document.createElement('input');
	radio.type = 'radio';
	radio.style.textAlign = 'center';
	radio.checked = (participantData.est_chef == 1);
	radio.onclick = function () {
		getDatas('dbUpdateChefEmission', '', 'numero=' + currentItem.numero + '&nom=' + encode(participantData.nom_utilisateur));
		refreshParticipants();
	}
	col1.appendChild(radio);
	
	var col2 = document.createElement('td');
	col2.innerHTML = participantData.nom_utilisateur;

	participantData.ordre = ordreParticipant;
	
	var col3 = document.createElement('td');
	col3.innerHTML = ' ' + participantData.ordre + ' ';
	col3.style.width = '80px';
	
	var linkMonter = document.createElement('input');
	linkMonter.type = 'button';
	linkMonter.value = '+';
	linkMonter.disabled = (participantData.ordre == 1);
	linkMonter.onclick = function () {
		getDatas('dbUpdateOrdreParticipant', 'result', 'numero=' + currentItem.numero + '&ordre=' + participantData.ordre + '&newvalue=' + (parseInt(participantData.ordre)-1));
		refreshParticipants();
	}
	col3.appendChild(linkMonter);
	
	var linkDescendre = document.createElement('input');
	linkDescendre.type = 'button';
	linkDescendre.value = '-';
	linkDescendre.disabled = (participantData.ordre == participantsEmission.length);
	linkDescendre.onclick = function () {
		getDatas('dbUpdateOrdreParticipant', 'result', 'numero=' + currentItem.numero + '&ordre=' + participantData.ordre + '&newvalue=' + (parseInt(participantData.ordre)+1));
		refreshParticipants();
	}
	col3.appendChild(linkDescendre);

	var col4 = document.createElement('td');
	col4.style.width = '190px';
	col4.style.textAlign = 'right';
	
	var deleteParticipant = document.createElement('input');
	deleteParticipant.type = 'button';
	deleteParticipant.value = 'Supprimer';
	deleteParticipant.onclick = function() {
		if (confirm('Etes-vous certain de vouloir supprimer ce participant ?'))
		{
			getDatas('dbDeleteParticipant', '', 'numero=' + currentItem.numero + '&nom=' + encode(participantData.nom_utilisateur));
			refreshParticipants();
		}
	}
	col4.appendChild(deleteParticipant);
	
	var completeParticipant = document.createElement('input');
	completeParticipant.type = 'button';
	
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
		else
		{
			completeParticipant.value = 'Modifier';
			completeParticipant.style.color = 'gray';
			completeParticipant.onclick = function() {
				alert(participantData.nom_utilisateur + " est un groupe !\nPour le modifier, aller dans le menu 'Gérer les utilisateurs'.");
			}
		}
	}

	col4.appendChild(completeParticipant);
	
	if (participantData.est_chef_complet == 1)
	{
		var envoyerInfosChef = document.createElement('input');
		envoyerInfosChef.type = 'button';	
		envoyerInfosChef.value = 'Envoyer infos de connexion CHEF';
		envoyerInfosChef.onclick = function() {
			showWait();
			getDatas('sendMailAjax', '', 'nom=' + encode(participantData.nom_utilisateur));
			hideWait();
		}
		
		if (participantData.est_chef == 1)
			col4.appendChild(envoyerInfosChef);
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
			col3.style.backgroundImage = 'url(css/chef_ok.gif)';
			col3.style.backgroundPosition = 'center';
			col3.style.backgroundRepeat = 'repeat-x';
			col3.className = 'etat21';
		}
		else
		{
			col3.style.backgroundImage = 'url(css/chef_ko.gif)';
			col3.style.backgroundPosition = 'center';
			col3.style.backgroundRepeat = 'repeat-x';
			col3.className = 'etat22';
		}
	}
	
	participant.appendChild(col3);
	participant.appendChild(col1);
	participant.appendChild(col2);
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
	col1.innerHTML = userData.nom;
	
	var col2 = document.createElement('td');
		
	var modifieUser = document.createElement('input');
	modifieUser.type = 'button';
	modifieUser.value = 'Modifier';
	modifieUser.onclick = function() {
		showModifieUtilisateur(userData.nom);
	}
	col2.appendChild(modifieUser);
	
	var envoyerInfosChef = document.createElement('input');
	envoyerInfosChef.type = 'button';	
	envoyerInfosChef.value = 'Envoyer infos de connexion CHEF';
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
	
	utilisateur.appendChild(col0);
	utilisateur.appendChild(col1);
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
	tdNom1.innerHTML = "<b><u>Nom (<font style='color:red;'>PAS D'ACCENT!!</font>) :</u></b>";
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
	cancelButton.value = "Annuler";
	cancelButton.onclick = function() {
		hideCompleteParticipant(nomUser);
	}

	var validateButton = document.createElement('input');
	validateButton.id = "formUserValidate" + nomUser;
	validateButton.type = "button";
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

function refreshNewsFormZoneAfterUpload(reponse, statut)
{
	refreshNewsFormZone();
	hideWait();
}

function refreshImageFormZoneAfterUpload(reponse, statut)
{
	document.getElementById('imgPochetteEmissionThumb').src = '../pochettes/comingsoon.jpg';
	refreshImageFormZone();
	envoiMailAdmin(currentItem.numero, 'uploadé', 'Pochette JPG');
	hideWait();
	updateZipEmission();
}

function refreshImageToPrintFormZoneAfterUpload(reponse, statut)
{
	document.getElementById('imgPochetteEmissionThumbToPrint').src = '../pochettes/comingsoon.jpg';
	refreshImageToPrintFormZone();
	hideWait();
	updateZipEmission();
}

function refreshImageGifFormZoneAfterUpload(reponse, statut)
{
	document.getElementById('imgPochetteEmissionThumbGif').src = '../pochettes/comingsoon.jpg';
	refreshImageGifFormZone();
	envoiMailAdmin(currentItem.numero, 'uploadé', 'Pochette GIF');
	hideWait();
	updateZipEmission();
}

function refreshNewsFormZone()
{
	ImageThumb= new Image();
	ImageThumb.src = '../css/news.gif?' + (new Date()).getTime();
	document.getElementById('imgNewsThumb').src = ImageThumb.src;
	document.getElementById('imageNews').className = 'etat32';

	document.getElementById('imgNews').href = document.getElementById('imgNewsThumb').src;
	document.getElementById('fileNews').value = '';
	document.getElementById('fileNewsError').innerHTML = '';
	document.getElementById('fileNewsButton').disabled = true; 
}

function refreshImageFormZone()
{
	if (isNew || !haveImageJpg)
	{
		document.getElementById('pochetteEmission').style.display = 'none';
	}
	else
	{
		document.getElementById('pochetteEmission').style.display = 'block';

		getDatas('getImageEmissionFlag', 'haveImage', 'numero=' + currentItem.numero);
		if (haveImage)
		{
			ImageThumb= new Image();
			ImageThumb.src = '../pochettes/thisisradioclash-episode' + currentItem.numero + '.jpg?' + (new Date()).getTime();
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
	if (isNew || admin != '' || !haveImageJpgToPrint)
	{
		document.getElementById('pochetteEmissionToPrint').style.display = 'none';
	}
	else
	{
		document.getElementById('pochetteEmissionToPrint').style.display = 'block';

		getDatas('getImageEmissionFlag', 'haveImageToPrint', 'numero=' + currentItem.numero + '-toPrint');
		if (haveImageToPrint)
		{
			ImageThumb= new Image();
			ImageThumb.src = '../pochettes/thisisradioclash-episode' + currentItem.numero + '-toPrint.jpg?' + (new Date()).getTime();
			document.getElementById('imgPochetteEmissionThumbToPrint').src = ImageThumb.src;
			document.getElementById('pochetteEmissionToPrint').className = 'etat32';
			document.getElementById('imgPochetteEmissionToPrint').href = document.getElementById('imgPochetteEmissionThumbToPrint').src;
			document.getElementById('imgPochetteEmissionToPrint').style.display = 'block';
			document.getElementById('filePochetteEmissionToPrintDeleteButton').disabled = false; 			
		}
		else
		{
			document.getElementById('imgPochetteEmissionThumbToPrint').src = '../pochettes/comingsoon.jpg';
			document.getElementById('pochetteEmissionToPrint').className = 'etat42';
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
		getDatas('deleteFile', '', 'file=' + '../pochettes/thisisradioclash-episode' + currentItem.numero + '.jpg');
		objet = 'Pochette JPG';
		refreshImageFormZone();
	}		

	if (typeFichier == 'pochetteToPrint')
	{
		getDatas('deleteFile', '', 'file=' + '../pochettes/thisisradioclash-episode' + currentItem.numero + '-toPrint.jpg');
		objet = 'Pochette à imprimer';
		refreshImageToPrintFormZone();
	}		

	if (typeFichier == 'pochetteGif')
	{
		getDatas('deleteFile', '', 'file=' + '../pochettes/thisisradioclash-episode' + currentItem.numero + '.gif');
		objet = 'Pochette GIF';
		refreshImageGifFormZone();
	}	
	
	if (typeFichier == 'mp3')
	{
		getDatas('deleteFile', '', 'file=' + '../mp3/thisisradioclash-episode' + currentItem.numero + '.mp3');
		objet = 'Fichier MP3';
		refreshMp3FormZone();
	}		
	
	if (typeFichier == 'teaserMp3')
	{
		getDatas('deleteFile', '', 'file=' + '../mp3/thisisradioclash-episode' + currentItem.numero + '-teaser.mp3');
		objet = 'Teaser MP3';
		refreshMp3TeaserFormZone();
	}		
		
	envoiMailAdmin(currentItem.numero, 'supprimé', objet);
	updateZipEmission();
}

function refreshImageGifFormZone()
{
	if (isNew || !haveImageGif)
	{
		document.getElementById('pochetteEmissionGif').style.display = 'none';
	}
	else
	{
		document.getElementById('pochetteEmissionGif').style.display = 'block';

		getDatas('getImageEmissionGifFlag', 'haveImageGif', 'numero=' + currentItem.numero);
		
		document.getElementById('imgPochetteEmissionGif').style.display = 'none';

		if (haveImageGif)
		{
			ImageThumbGif= new Image();
			ImageThumbGif.src = '../pochettes/thisisradioclash-episode' + currentItem.numero + '.gif?' + (new Date()).getTime();
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
	refreshMp3FormZone();
	getDatas('dbUpdateTimeEmission', 'result', 'numero=' + currentItem.numero + '&time_min=' + currentItem.time_min + '&time_sec=' + currentItem.time_sec);
	envoiMailAdmin(currentItem.numero, 'uploadé', 'Fichier MP3');
	hideWait();
	updateZipEmission();
}

function refreshMp3TeaserFormZoneAfterUpload(reponse, statut)
{
	refreshMp3TeaserFormZone();
	envoiMailAdmin(currentItem.numero, 'uploadé', 'Teaser MP3');
	hideWait();
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

		getDatas('getTimeEmission', 'haveMp3', 'numero=' + currentItem.numero);
		if (haveMp3 != 0)
		{
			document.getElementById('mp3Emission').className = 'etat32';
			document.getElementById('yesMp3').style.display = 'block';
			document.getElementById('linkMp3Emission').href = '../mp3/thisisradioclash-episode' + currentItem.numero + '.mp3';
			document.getElementById('linkMp3Emission').innerHTML = 'This is radioclash n°' + currentItem.numero;
			document.getElementById('timeMp3Emission').innerHTML = haveMp3;
			var times = haveMp3.split(':');
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
	if (isNew || !haveTeaserMp3)
	{
		document.getElementById('mp3Teaser').style.display = 'none';
	}
	else
	{
		document.getElementById('mp3Teaser').style.display = 'block';
		
		document.getElementById('yesMp3Teaser').style.display = 'none';
		document.getElementById('noMp3Teaser').style.display = 'none';

		getDatas('getTeaserEmissionFlag', 'haveMp3Teaser', 'numero=' + currentItem.numero);
		if (haveMp3Teaser != 0)
		{
			document.getElementById('mp3Teaser').className = 'etat32';
			document.getElementById('yesMp3Teaser').style.display = 'block';
			document.getElementById('linkMp3Teaser').href = '../mp3/thisisradioclash-episode' + currentItem.numero + '-teaser.mp3';
			document.getElementById('linkMp3Teaser').innerHTML = 'Teaser de this is radioclash n°' + currentItem.numero;
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
	getDatas('dbUpdateTeaserVideoEmission', 'result', 'numero=' + currentItem.numero + '&teaser_video=' + encode(urlTeaserVideo));
	getDatas('dbGetEmission', 'currentEmissionDatas', 'numero=' + currentItem.numero);
	currentItem.teaser_video = currentEmissionDatas.teaser_video;
	refreshVideoTeaserFormZone();
	hideWait();
	
	updateZipEmission();
}

function updateZipEmission()
{
	if (haveZip && currentItem.etat == 3)
	{
		changeWaitMessage("<b>Regénération du ZIP de l'émission...</b><br />Parce que les données ont changées alors que l'émission déjà publiée !!");
		getDatas('createZipEmission', 'result', 'numero=' + currentItem.numero);
		initialiseWaitMessage();
	}
}

function refreshVideoTeaserFormZone()
{
	document.getElementById('txtVideoTeaser').value = '';
	document.getElementById('linkVideoTeaserValue').value = '';
	document.getElementById('linkVideoTeaserSrc').src = '';

	if (isNew || !haveTeaserVideo)
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

function verifEmission(numeroEmission)
{
	getDatas('dbGetEmissionCompleteFlag', 'isComplete', 'numero=' + numeroEmission);
	if (!isComplete)
	{	
		return false;
	}
		
	return verifMorceaux(numeroEmission);
}

function verifParticipants(numeroEmission)
{
	getDatas('dbGetParticipantsEmissionFlag', 'haveParticipants', 'numero=' + numeroEmission);
	return haveParticipants;
}

function verifMorceaux(numeroEmission)
{
	getDatas('dbGetMorceauxEmissionFlag', 'haveMorceaux', 'numero=' + numeroEmission);
	return haveMorceaux;
}

function createLigneEmission(emissionData)
{
	var col1 = document.createElement('td');
	col1.className = 'thumbEmission';
	var thumb = document.createElement('img');
	thumb.src = '../pochettes/thisisradioclash-episode' + emissionData.numero + '.jpg?' + (new Date()).getTime();
	thumb.className = 'thumbEmission';
	col1.appendChild(thumb);
	var col2 = document.createElement('td');
	col2.className = 'titreEmission';
	col2.innerHTML = emissionData.numero + ' - ' + emissionData.titre;
	var col3 = document.createElement('td');
	col3.className = 'dateEmission';
	if (emissionData.etat == 2 && emissionData.date_sortie != '??/??/????')
		col3.innerHTML = 'Annoncée pour le : ' + emissionData.date_sortie;
	else
		col3.innerHTML = emissionData.date_sortie;
		
	var col4 = document.createElement('td');
	col4.className = 'etatEmission';
	col4.innerHTML = emissionData.libelle;
	var col5 = document.createElement('td');
	col5.className = 'actionEmission';
	var linkModifier = document.createElement('a');
	if (admin == '')
		linkModifier.innerHTML = 'Modifier';
	else
		linkModifier.innerHTML = 'Uploader le teaser, la pochette, ou le mp3';
	
	linkModifier.href = '#';
	linkModifier.onclick = function () {
		currentItem = emissionData;
		display('playlist');
		}
	col5.appendChild(linkModifier);
	
	//Pour une émission cachée :
	if (emissionData.etat == 1)
	{
		if (emissionData.titre != '')
		{
			var saut1 = document.createElement('span');
			saut1.innerHTML = " / ";	
			col5.appendChild(saut1);
			var linkAnnonce = document.createElement('a');
			linkAnnonce.innerHTML = 'Annoncer';
			linkAnnonce.href = '#';
			linkAnnonce.onclick = function () {
				if (verifParticipants(emissionData.numero))
				{
					if (confirm('Certain de vouloir annoncer cette émission ?\n\nCelle-ci apparaitra alors dans la page des news...'))
					{
						getDatas('dbUpdateEtatEmission', 'result', 'numero=' + emissionData.numero + '&etat=2');
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
			col5.appendChild(linkAnnonce);
		}
		
		var saut2 = document.createElement('span');
		saut2.innerHTML = " / ";	
		col5.appendChild(saut2);
		var linkDelete = document.createElement('a');
		linkDelete.innerHTML = 'Supprimer';
		linkDelete.href = '#';
		linkDelete.onclick = function () {
				if (confirm('Certain de vouloir supprimer cette émission ?'))
				{
					if (confirm('Pas de regrets ?'))
					{
						getDatas('dbDeleteCascadeEmission', 'result', 'numero=' + emissionData.numero);
						display('playlists');
					}
				}
			}
		col5.appendChild(linkDelete);
	}
	
	//Pour une émission annoncée :
	if (emissionData.etat == 2 && admin == '')
	{
		var saut3 = document.createElement('span');
		saut3.innerHTML = " / ";	
		col5.appendChild(saut3);
		var linkPublish = document.createElement('a');
		linkPublish.innerHTML = 'Publier';
		linkPublish.href = '#';
		linkPublish.onclick = function () {
			if (verifEmission(emissionData.numero))
			{
				if (confirm('Certain de vouloir publier cette émission ? Go ?'))
				{
					getDatas('dbUpdateEtatEmission', 'result', 'numero=' + emissionData.numero + '&etat=3');
					
					if (haveZip)
						getDatas('createZipEmission', 'result', 'numero=' + emissionData.numero);
					
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
		col5.appendChild(linkPublish);
	}
	
	var emission = document.createElement('tr');
	emission.className = 'etat' + emissionData.etat + alternate;
	emission.appendChild(col1);
	emission.appendChild(col2);
	if (admin == '')
	{
		emission.appendChild(col3);
		emission.appendChild(col4);
	}
	emission.appendChild(col5);
		
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
	enreg['numero'] = currentItem.numero;
	enreg['nom'] = document.getElementById('txtNomParticipant').value;
	enreg['ordre'] = 0;
	enreg['est_chef'] = 0;
	
	getDatas('dbInsertParticipant', 'result', 'numero=' + enreg.numero + '&nom=' + encode(enreg.nom) + '&ordre=' + enreg.ordre + '&est_chef=' + enreg.est_chef);
	
	refreshParticipants();
}

function formEnregistrer()
{
	var enreg = new Array();
	enreg['numero'] = document.getElementById('txtNumeroEmission').value;
	enreg['titre'] = document.getElementById('txtTitreEmission').value;
	enreg['date_sortie'] = dateForDB(document.getElementById('txtDateEmission').value);
	enreg['etat'] = currentItem.etat;
	enreg['time_min'] = currentItem.time_min;
	enreg['time_sec'] = currentItem.time_sec;

	//alert('numero=' + enreg.numero + '&titre=' + encode(enreg.titre) + '&date_sortie=' + enreg.date_sortie + '&etat=' + enreg.etat + '&time_min=' + enreg.time_min + '&time_sec=' + enreg.time_sec);
	if (isNew)
		getDatas('dbInsertEmission', 'result', 'numero=' + enreg.numero + '&titre=' + encode(enreg.titre) + '&date_sortie=' + enreg.date_sortie + '&etat=' + enreg.etat + '&time_min=' + enreg.time_min + '&time_sec=' + enreg.time_sec);
	else
		getDatas('dbUpdateEmission', 'result', 'numero=' + enreg.numero + '&titre=' + encode(enreg.titre) + '&date_sortie=' + enreg.date_sortie + '&etat=' + enreg.etat + '&time_min=' + enreg.time_min + '&time_sec=' + enreg.time_sec);

	isNew = false;
	alert('Enregistrement réussi !');
	updateZipEmission();
	display('playlists');
}

function newEmission()
{
	isNew = true;
	getDatas('dbGetNewNumeroEmission', 'newNumber', '');
	currentItem = new Array();
	currentItem['numero'] = newNumber;
	currentItem['titre'] = '';
	currentItem['date_sortie'] = '??/??/????';
	currentItem['etat'] = 1;
	currentItem['time_min'] = 0;
	currentItem['time_sec'] = 0;
	display('playlist');
	document.getElementById('formEnregistrer').disabled = (!Verif_NonVide(document.getElementById('txtTitreEmission')));
}

function validateExtension(control, extension)
{
	document.getElementById(control.id + 'Error').innerHTML = '';
	if (control.value.substring(control.value.lastIndexOf('.') + 1).toUpperCase() != extension.toUpperCase())
	{
		control.value = '';
		document.getElementById(control.id + 'Button').disabled = true; 
		document.getElementById(control.id + 'Error').innerHTML = 'Le type de fichier est incorrect, il faut du ' + extension;
	}	
	else
		document.getElementById(control.id + 'Button').disabled = false; 
}

function validateAdresseYoutube(control)
{
	document.getElementById(control.id + 'Error').innerHTML = '';
	if (control.value != '' && control.value.indexOf('http://www.youtube.com/watch?v=') != 0)
	{
		document.getElementById(control.id + 'Button').disabled = true; 
		document.getElementById(control.id + 'Error').innerHTML = 'L\'adresse YouTube est incorrecte, il faut qu\'elle commence par "http://www.youtube.com/watch?v="';
	}	
	else
		document.getElementById(control.id + 'Button').disabled = false; 
}

function refreshMorceaux()
{
	if (isNew || admin != '')		
	{
		document.getElementById('morceaux').style.display = 'none';
	}
	else
	{
		document.getElementById('morceaux').style.display = 'block';
		document.getElementById('noMorceaux').style.display = 'none';
		document.getElementById('listeMorceaux').style.display = 'none';
		
		getDatas('dbGetListeParticipantsEmission', 'participantsEmission', 'numero=' + currentItem.numero);
		
		if (participantsEmission.length == 0)
		{
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
	txtMorceaux.style.height = '150px';
	
	var spnError = document.createElement('span');
	spnError.id = 'spnErrorPlaylist' + participantData.nom_utilisateur;	
	spnError.style.color = 'red';
	
	var btnValider = document.createElement('input');
	btnValider.type = 'button';
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
	btnEnregistrer.value = '>> Enregistrer !';
	btnEnregistrer.datas = new Array();
	btnEnregistrer.style.display = 'none';
	btnEnregistrer.id = 'btnEnregistrerPlaylist' + participantData.nom_utilisateur;
	btnEnregistrer.onclick = function() {
		getDatas('dbDeletePlaylistParticipant', '', 'numero=' + currentItem.numero + '&nom=' + encode(participantData.nom_utilisateur));
		//on les recrée à partir de this.datas[i].time_min, ...
		for (var i=0; i<this.datas.length; i++)
			getDatas('dbInsertMorceau', '', 'numero=' + currentItem.numero + '&nom=' + encode(participantData.nom_utilisateur) + '&time_min=' + this.datas[i].time_min + '&time_sec=' + this.datas[i].time_sec + '&nom_artiste=' + encode(this.datas[i].nom_artiste) + '&nom_morceau=' + encode(this.datas[i].nom_morceau));
		
		refreshParticipants();
		
		updateZipEmission();
	}
	
	
	getDatas('dbGetPlaylistParticipant', 'listeMorceauxParticipant', 'numero=' + currentItem.numero + '&nom=' + encode(participantData.nom_utilisateur));

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
	liParticipant.innerHTML = participantData.nom_utilisateur;
	
	liParticipant.appendChild(br1);
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
		
		erreur.innerHTML = "Une émission doit avoir un titre !";
		return false;
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
		getDatas('dbGetEmission', 'emissionToCheck', 'numero=' + numero);
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


