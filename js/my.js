function encode(texte)
{
	return escape( encodeURIComponent( texte ) );
}
function decode(s)
{
  return unescape( decodeURIComponent(s));
}

function htmlEncode(value){ 
  return $('<div/>').text(value).html(); 
} 

function htmlDecode(value){ 
  return $('<div/>').html(value).text(); 
}

function getDatas(functionName, variableName, functionParams)
{
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
		}	
	});
}

function initialiseEmail()
{
	$('#mail-text').val('Saisissez votre email');
	$('#linkMail').hide();
	$('#spanMail').fadeTo('slow', 1.0);
	$('#spanMailOk').hide();
}

function isValidEmailAddress(emailAddress) 
{
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}

function validateEmail()
{
	var result = true;
	$('#mail-text').removeClass('error');
	
	if ($('#mail-text').val() == '' || $('#mail-text').val() == 'Saisissez votre email')
	{
		$('#mail-text').addClass('error');
		result = false;
	}
	else
	{
		if (!isValidEmailAddress($('#mail-text').val()))
		{
			$('#mail-text').addClass('error');
			result = false;
		}
	}
	
	return result;
}

function saveEmail()
{
	//alert('Adresse à enregistrer : ' + $('#mail-text').val());
	//getDatas('addMail', 'resultAddMail', 'mail=' + encode($('#mail-text').val()));
	//alert(resultAddMail);
	
	$('#spanMailAdresse').html($('#mail-text').val());

	$('#spanMail').hide();
	
	//document.getElementById('spanMailOk').style.display = 'block';
	$('#spanMailOk').show();
	$('#spanMailOk').fadeTo('slow', 1.0);
	
}

