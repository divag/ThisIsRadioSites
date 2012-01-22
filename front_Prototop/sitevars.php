<?php

//=====================
//Chargement du site :
//=====================
// 1 = ThisIsRadioclash
// 2 = Prototop
// 3 = The Brain
// 4 = Prototop
//=====================
$id_site = 4;
define('ID_SITE',$id_site);

//Attention, le fichier dbFunctions doit �tre charg� !
$site = dbGetSite($id_site);
$config = dbGetParametresSite($id_site);
$defaultParticipant = dbGetUtilisateurById($config['id_default_participant']);

//===============================
//Proprit�t�s g�n�rales du site :
//===============================
$radioclashHome = $site['url'];
define('RADIOCLASH_HOME',$radioclashHome);
$mailAdmin = $config['mail_admin'];
define('MAIL_ADMIN',$mailAdmin);

//=================
//Options du site :
//=================
$nomSite = $site['nom'];
$siteHaveTitre = $config['have_titre'];							//ok
$siteHaveTexte = $config['have_texte'];							//ok
$siteHaveParticipants = $config['have_participants'];			//ok
$siteDefaultParticipant = $defaultParticipant['nom'];			//ok
$siteHaveImageJpg = $config['have_image_jpg']; 					//ok
$siteHaveImageJpgToPrint = $config['have_image_jpg_toprint'];	//ok
$siteHaveImageGif = $config['have_image_gif']; 					//ok
$siteHaveTeaserMp3 = $config['have_teaser_mp3']; 				//ok
$siteHaveTeaserVideo = $config['have_teaser_video'];			//ok
$siteHaveGoodies = $config['have_goodies'];						//ok
$siteHaveBonus = $config['have_bonus'];							//� faire
$siteHaveNews = $config['have_news'];							//ok
$siteHaveNewsletter = $config['have_newsletter'];				//� faire
$siteHaveZip = $config['have_zip'];								//ok
$siteHaveContenuPages = $config['have_contenu_pages'];			//ok
$siteHaveStatutAnnounced = $config['have_statut_announced'];	//ok
//Templates :
$templateReferenceEmission = $config['template_reference_emission'];
$templateNommageFichiersEmission = $config['template_nommage_fichiers_emission'];
$templateNommageMorceauxEmission = $config['template_nommage_morceaux_emission'];
define('TEMPLATE_REF_EMISSION',$templateReferenceEmission);
define('TEMPLATE_NOM_FICHIER_EMISSION',$templateNommageFichiersEmission);
define('TEMPLATE_NOM_MORCEAU_EMISSION',$templateNommageMorceauxEmission);

//=========================
//Pages/Liens du site web :
//=========================

$pageNews = 'news';
$pageHowto = 'howto';
$pageListen = 'listen';
$pageEpisode = 'playlist';
$pageEmission = '';
$lienPodcast = 'http://feeds.feedburner.com/Prototop';
$rssFeed = 'http://feeds.feedburner.com/Prototop';
$lienForum = "http://www.musiques-incongrues.net/";
$lienFacebook = "http://fr-fr.facebook.com/pages/Prototop/170953249591801";
$lienTwitter = "https://www.twitter.com/Prototop_Radio";

//=========
//Modules :
//=========

//Dossier du module "SoundManager 2.0" :
$soundmanager = "modules/soundmanager/";
//Dossier du module "zip" :
$zipModule = "modules/Zip/createzip.inc.php";
//Dossier du module "lightbox" :
$lightbox = "modules/lightbox/";
//Dossier CSS des modules :
$css = "modules/css/";
//Dossier JS des modules :
$js = "modules/js/";
//Envoi de mails :
$urlSendMail = 'http://int-musicdestock.fr/radioclashMailing/sendMail.php';
define('URL_SEND_MAIL',$urlSendMail);

//==========
//Dossiers :
//==========

//Dossier des fichiers de contenus :
$contenu = 'contenu/';
define('CONTENU',$contenu);
//Dossier des pochettes :
$pics = 'pochettes/';
define('PICS',$pics);
//Dossier des mp3s :
$mp3s = 'mp3/';
define('MP3S',$mp3s);
//Dossier des zips :
$zips = 'zip/';
define('ZIPS',$zips);
//Dossier des mails :
define('PATH_MAIL',"mails/");

?>
