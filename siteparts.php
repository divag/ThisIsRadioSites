<?php

function writeHead()
{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
	
	echo "<meta name=\"author\" content=\"Puyo Puyo &amp; Divag\" />";
	echo "<meta name=\"keywords\" content=\"radioclash, radio, clash, music, musique, émission, radioshow, mix, free mp3, musiques incongrues\" />";
	echo "<meta name=\"description\" content=\"Projet d'émissions de radio collaboratives.\" />";
	echo "<meta name=\"robots\" content=\"all\" />";
	echo "<title>This is Radioclash from Incongru satellite</title>";
	echo "<link rel=\"shortcut icon\" type=\"image/png\" href=\"css/favicon.png\" />";
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"http://feeds.feedburner.com/thisisradioclash\" />";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/thisisradioclash.css\" />";
}

function writeEntete($page){

	include('sitevars.php');

	$tailleEntete = '';
	if ($page != "")
		$tailleEntete = 'Small';

	/**********/
	/* ENTETE */
	/**********/
	echo "<div>";
	echo "  <h1 class=\"entete\">";
	echo " <a href=\"".$radioclashHome."\" title=\"This is radioclash !\"> ";
	echo "    <img class=\"entete".$tailleEntete."\" src=\"css/bandeau.gif\" alt=\"This is Radioclash banner\"/><br />";
	echo "	  <span>This is radioclash !</span>";
	echo "  </a></h1>";
	echo "</div>";

	/********/
	/* MENU */
	/********/
	
	echo "<div class=\"menu\">";
	echo "  <ul class=\"menu".$tailleEntete."\">";
	
	//Lien vers la page de news :
	//if ($page != $pageNews)
	//{
	echo "    <li><a href=\"".$radioclashHome."\" title=\"News !\">";
	echo "      <img alt=\"News\" src=\"css/".$pageNews.".jpg\" /><span>News !</span>";
	echo "    </a></li>";
	//}
	
	//Lien vers les playlists :
	//if ($page != $pageListen)
	//{
		echo "    <li><a href=\"".$pageListen.".php\" title=\"Listen !\">";
		echo "      <img alt=\"Listen\" src=\"css/".$pageListen.".jpg\" /><span>Listen !</span>";
		echo "    </a></li>";
	//}
	
	//Lien vers le mode d'emploi :
	
	echo "    <li><a href=\"".$pageHowto.".php\" title=\"How does it works ?\">";
	echo "      <img alt=\"HOW TO\" src=\"css/".$pageHowto.".jpg\" /><span>How does it works ?</span>";
	echo "    </a></li>";
	
	//Lien vers le podcast :
	
	echo "    <li><a href=\"".$lienPodcast."\" title=\"Podcast !\">";		
	echo "      <img alt=\"Podcast\" src=\"css/podcast.jpg\" /><span>Podcast !</span>";
	echo "    </a></li>";
	
	//Lien vers le forum :
	echo "    <li><a href=\"".$lienForum."\" title=\"Forum !\">";
	echo "      <img alt=\"Forum\" src=\"css/forum.jpg\" /><span>Forum !</span>";
	echo "    </a></li>";

	//Lien vers le facebook :
	echo "    <li><a href=\"".$lienFacebook."\" title=\"Page facebook !\">";
	echo "      <img alt=\"Facebook\" src=\"css/facebook.jpg\" /><span>Page facebook !</span>";
	echo "    </a></li>";
	
	echo "  </ul>";
	echo "</div>";
	echo "<br clear=\"all\" />";
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
