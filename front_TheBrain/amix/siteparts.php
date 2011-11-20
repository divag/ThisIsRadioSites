<?php

function writeHead()
{
	include('sitevars.php');
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n";
	
	echo "<meta name=\"author\" content=\"Puyo Puyo &amp; Divag\" />\n";
	echo "<meta name=\"keywords\" content=\"the brain, thebrain, freaky, radio, music, musique, émission, radioshow, mix, free mp3, musiques incongrues\" />\n";
	echo "<meta name=\"description\" content=\"The Brain radioshow\" />\n";
	echo "<meta name=\"robots\" content=\"all\" />\n";
	echo "<title>The Brain radioshow</title>\n";
	echo "<link rel=\"shortcut icon\" type=\"image/png\" href=\"css/favicon.png\" />\n";
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"".$lienPodcast."\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/thebrain.css\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mailing.css\" />\n";
}

function writeEntete($page){

	include('sitevars.php');

	/**********/
	/* ENTETE */
	/**********/
	if ($page == 'index')
	{
		echo "<div class=\"entete\">\n";
		echo "  <div class=\"logo\">\n";
		echo "  <a href=\"".$theBrainHome."\" title=\"The Brain radioshow\"> \n";
		echo "    <img class=\"entete\" src=\"css/logoSite.jpg\" alt=\"The Brain radioshow logo\"/><br />\n";
		echo "	  <span>The Brain radioshow home</span>\n";
		echo "  </a>\n";
		echo "  </div>\n";

		/********/
		/* MENU */
		/********/
		echo "<div class=\"menu\">\n";
		echo "  <ul class=\"menu\">\n";
		
		//Lien vers la home :
		echo "    <li class=\"first\"><a href=\"".$theBrainHome."\" title=\"Accueil\">\n";
		echo "      <span>HOME</span>\n";
		echo "    </a></li>\n";
		
		//Lien vers les playlists :
		echo "    <li><a href=\"".$theBrainHome."playlists.php\" title=\"Ecouter\">\n";
		echo "      <span>SHOWS</span>\n";
		echo "    </a></li>\n";
		
		//Lien vers la page de news :
		echo "    <li><a href=\"".$theBrainHome."news.php\" title=\"Actualit&eacute;\">\n";
		echo "      <span>NEWS</span>\n";
		echo "    </a></li>\n";
		
		//Lien vers les liens :
		echo "    <li><a href=\"".$theBrainHome."links.php\" title=\"Liens\">\n";
		echo "      <span>LIENS</span>\n";
		echo "    </a></li>\n";
		
		echo "  </ul>\n";
		
		$contenuGifPage = dbGetContenuPageSite($id_site, $page, "gif_entete");
		if ($contenuGifPage != 0)
		{
			echo "<br />";
			echo "<img src=\"".$contenuGifPage['url']."\" />\n";
		}
		
		echo "<br class=\"clear\" />";
		echo "</div>\n";
		echo "<br class=\"clear\" />";
		echo "</div>\n";
		echo "<br class=\"clear\" />";
	}
}

function writePiedDePage($page)
{
	include('sitevars.php');

	echo "  <br clear=\"all\" />";
	
	$contenuJpgPage = dbGetContenuPageSite($id_site, $page, "image_bas");
	if ($contenuJpgPage != 0)
	{
		echo "<br />";
		echo "<img src=\"".$contenuJpgPage['url']."\" />\n";
	}

	/*
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
	*/
}

function writeGoogleAnalyticsTag()
{
	echo "<script type=\"text/javascript\">";
	echo "  var _gaq = _gaq || [];";
	echo "  _gaq.push(['_setAccount', 'UA-26255175-1']);";
	echo "  _gaq.push(['_trackPageview']);";
	echo "  (function() {";
	echo "    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;";
	echo "    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';";
	echo "    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);";
	echo "  })();";
	echo "</script>";
}


?>
