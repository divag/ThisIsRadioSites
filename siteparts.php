<?php

function writeHead()
{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n";
	
	echo "<meta name=\"author\" content=\"Puyo Puyo &amp; Divag\" />\n";
	echo "<meta name=\"keywords\" content=\"radioclash, radio, clash, music, musique, émission, radioshow, mix, free mp3, musiques incongrues\" />\n";
	echo "<meta name=\"description\" content=\"Projet d'émissions de radio collaboratives.\" />\n";
	echo "<meta name=\"robots\" content=\"all\" />\n";
	echo "<title>This is Radioclash from Incongru satellite</title>\n";
	echo "<link rel=\"shortcut icon\" type=\"image/png\" href=\"css/favicon.png\" />\n";
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"http://feeds.feedburner.com/thisisradioclash\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/thisisradioclash.css\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mailing.css\" />\n";
}

function writeEntete($page){

	include('sitevars.php');

	$tailleEntete = '';
	if ($page != "")
		$tailleEntete = 'Small';

	/**********/
	/* ENTETE */
	/**********/
	echo "<div class=\"entete\">\n";
	echo "  <h1 class=\"entete\">\n";
	echo " <a href=\"".$radioclashHome."\" title=\"This is radioclash !\"> \n";
	echo "    <img class=\"entete".$tailleEntete."\" src=\"css/bandeau.gif\" alt=\"This is Radioclash banner\"/><br />\n";
	echo "	  <span>This is radioclash !</span>\n";
	echo "  </a>\n";
	echo "  </h1>\n";
	echo "</div>\n";

	if ($page == "")
	{
		/****************/
		/* MAILING-LIST */
		/****************/
		
		/*
		echo "<div class=\"links\">\n";
		echo "	<a id=\"linkMail\" class=\"mailLink\" onclick=\"initialiseEmail();\"><span>S'inscrire à la NewsLetter</span></a>\n";
		echo "	<span>\n";
		echo "	    <form id=\"spanMail\" style=\"display:none;\" onsubmit=\"if (validateEmail()) saveEmail(); return false;\">\n";
		echo "	        <input id=\"mail-text\" type=\"text\" class=\"comment-txt-login\" name=\"email\" style=\"width:200px;\" onfocus=\"if (this.value == 'Saisissez votre email') this.value = '';\" onblur=\"validateEmail()\" value=\"Saisissez votre email\" />\n";
		echo "	        <input type=\"button\" value=\"OK\" class=\"buttonMail\" style=\"width:50px;margin-left:1px;\" onclick=\"if (validateEmail()) saveEmail();\" />\n";
		echo "	    </form>\n";
		echo "	</span>\n";
		echo "	<span id=\"spanMailOk\" style=\"display:none;\">\n";
		echo "	    Adresse enregistrée : <span id=\"spanMailAdresse\"></span><br />\n";
		echo "		<a class=\"mailLink\" onclick=\"initialiseEmail();\"><span>Enregistrer une autre adresse email</span></a>\n";
		echo "	</span>\n";
		echo "</div>\n";
		*/
	}
	
	/********/
	/* MENU */
	/********/
	echo "<div class=\"clear menu\">\n";
	echo "  <ul class=\"menu".$tailleEntete."\">\n";
	
	//Lien vers la page de news :
	//if ($page != $pageNews)
	//{
	echo "    <li><a href=\"".$radioclashHome."\" title=\"News !\">\n";
	echo "      <img alt=\"News\" src=\"css/".$pageNews.".jpg\" /><span>News !</span>\n";
	echo "    </a></li>\n";
	//}
	
	//Lien vers les playlists :
	//if ($page != $pageListen)
	//{
		echo "    <li><a href=\"".$pageListen.".php\" title=\"Listen !\">\n";
		echo "      <img alt=\"Listen\" src=\"css/".$pageListen.".jpg\" /><span>Listen !</span>\n";
		echo "    </a></li>\n";
	//}
	
	//Lien vers le mode d'emploi :
	
	echo "    <li><a href=\"".$pageHowto.".php\" title=\"How does it works ?\">\n";
	echo "      <img alt=\"HOW TO\" src=\"css/".$pageHowto.".jpg\" /><span>How does it works ?</span>\n";
	echo "    </a></li>\n";
	
	//Lien vers le podcast :
	
	echo "    <li><a href=\"".$lienPodcast."\" title=\"Podcast !\">\n";		
	echo "      <img alt=\"Podcast\" src=\"css/podcast.jpg\" /><span>Podcast !</span>\n";
	echo "    </a></li>\n";
	
	//Lien vers le forum :
	echo "    <li><a href=\"".$lienForum."\" title=\"Forum !\">\n";
	echo "      <img alt=\"Forum\" src=\"css/forum.jpg\" /><span>Forum !</span>\n";
	echo "    </a></li>\n";

	//Lien vers le facebook :
	echo "    <li><a href=\"".$lienFacebook."\" title=\"Page facebook !\">\n";
	echo "      <img alt=\"Facebook\" src=\"css/facebook.jpg\" /><span>Page facebook !</span>\n";
	echo "    </a></li>\n";
	
	echo "  </ul>\n";
	echo "</div>\n";
	echo "<br clear=\"all\" />\n";
}

function writePiedDePage($page)
{
	include('sitevars.php');
	
	$lienContact = "Contact : <a href=\"mailto:".$mailAdmin."\"  title=\"Contact\"><span>".$mailAdmin."</span></a> - ";

	if ($page == '')
	{
		echo "  <br />";
		echo "  <br />";
		echo "<div class=\"footerHosting\">";
		echo "	<span>".$lienContact."Mise en page / Admin : <a href=\"http://puyopuyo.lautre.net\" title=\"puyopuyo\" onclick=\"window.open(this.href); return false;\"><span>Puyo Puyo</span></a> - Code : <a href=\"http://divag.parishq.net\" onclick=\"window.open(this.href); return false;\" title=\"divag\"><span>Divag</span></a> &amp; <a href=\"http://www.musicdestock.fr\" onclick=\"window.open(this.href); return false;\" title=\"daYmo\"><span>daYmo</span></a> - H&eacute;berg&eacute; par <a href=\"http://www.pastis-hosting.net\" title=\"pastis hosting\" onclick=\"window.open(this.href); return false;\"><span>Pastis Hosting</span></a></span>";
		echo "</div>";
	}
	echo "  <br clear=\"all\" />";
	echo "  <br />";
	echo "  <br />";
}

?>
