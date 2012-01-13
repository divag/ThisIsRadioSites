<?php
echo '<?xml version="1.0" encoding="UTF-8" ?>';

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$listeEmissions = dbListeEmissionsForFeed($id_site);

if ($siteHaveNews)
	$listeNews = dbGetListeNewsActives($id_site);
	
echo '<rss version="2.0">';
echo '  <channel>';
echo '    <title>'.$nomSite.'</title>';
echo '    <link>'.$radioclashHome.'feed/rssGenerate.php</link>';
echo '    <description>'.$nomSite.'\'s Podcast !</description>';
echo '    <image>';
echo '      <url>'.$radioclashHome.'css/bandeau.gif</url>';
echo '      <link>'.$radioclashHome.'</link>';
echo '    </image>';
echo '    <language>en-us</language>';

$haveNewsForFeed = false;

if($siteHaveNews && $news=mysql_fetch_array($listeNews))
{	
	$haveNewsForFeed = true;
	$dateNewsToCompare = strtotime($news['date']);
}

$haveEmissionsForFeed = false;

while($emission=mysql_fetch_array($listeEmissions))
{
	$haveEmissionsForFeed = true;

	$idEmission = $emission['id'];
	$dateEmissionToCompare = strtotime($emission['date_sortie']);
	
	if ($siteHaveNews)
	{
		while ($haveNewsForFeed && $dateEmissionToCompare < $dateNewsToCompare)
		{
			$dateNews = date('D, d M Y H:i:s O', strtotime($news['date']));	
			echo '    <item>';
			echo '      <title>News : '.$news['titre'].'</title>';
			echo '      <link>'.$radioclashHome.'</link>';
			echo '      <description><![CDATA[';	
			echo '          <span>'.$news['contenu_fr'].'</span>';
			echo '      ]]></description>';
			echo '      <pubDate>'.$dateNews.'</pubDate>';
			echo '    </item>';
			
			if ($news=mysql_fetch_array($listeNews))
				$dateNewsToCompare = strtotime($news['date']);
			else
				$haveNewsForFeed = false;				
		}
	}
	
	$numeroEmission = $emission['numero'];
	$nomParticipants = listeParticipantsEmission($idEmission);
	
	if ($emission['id_site'] != $id_site)
	{
		$nomFichier = getNomFichierEmissionSite($emission['id_site'], $numeroEmission, $emission['titre'], $nomParticipants);
		$titreEmission = htmlencode(getReferenceEmissionSite($emission['id_site'], $numeroEmission, $emission['titre'], $nomParticipants));
		$imageEmission = $radioclashHome."amix/".$pics.$nomFichier.".jpg";
		$lengthEmission = getBytesLengthEmissionSite($emission['id_site'], $numeroEmission);
		$mp3Emission = $radioclashHome."amix/".$mp3s.$nomFichier.".mp3";
		$linkEmission = $radioclashHome."amix/".$pageEmission.".php?episode=".$numeroEmission;
	}
	else
	{
		$nomFichier = getNomFichierEmission($numeroEmission, $emission['titre'], $nomParticipants);
		$titreEmission = htmlencode(getReferenceEmission($numeroEmission, $emission['titre'], $nomParticipants));
		$imageEmission = $radioclashHome.$pics.$nomFichier.".jpg";
		$lengthEmission = getBytesLengthEmission($numeroEmission);
		$mp3Emission = $radioclashHome.$mp3s.$nomFichier.".mp3";
		$linkEmission = $radioclashHome.$pageEmission.".php?episode=".$numeroEmission;
	}
	
	$dateEmission = date('D, d M Y H:i:s O', strtotime($emission['date_sortie']));
	
	echo '    <item>\n';
	echo '      <title>'.$nomSite.' '.$titreEmission.'</title>\n';
	echo '      <link>'.$linkEmission.'</link>\n';
	echo '      <description><![CDATA[';
	
	if ($emission['id_site'] != $id_site && $emission['id_contenu_texte'] != '')
	{
		$texte_presentation = dbGetContenu($emission['id_contenu_texte']);
		echo $texte_presentation['contenu_fr'].'<br />';
	}
	
	
	echo '        <img src="'.$imageEmission.'" alt="cover" width="346" height="346" /><br />';
	
	$playlist = dbGetPlaylist($idEmission);
	if ($siteHaveParticipants)
	{
		$nomUtilisateurEnCours = "";
		$chef = htmlencode(dbGetChefEmission($idEmission));
	}
	$i = 0;
	while($array=mysql_fetch_array($playlist))
	{
		if ($siteHaveParticipants)
		{
			if ($nomUtilisateurEnCours != strtoupper(htmlencode($array['nom_utilisateur'])))
			{
				$utilisateurEnCours = dbGetUtilisateur(urlencode(addslashes($array['nom_utilisateur'])));
				$nomUtilisateurEnCours = strtoupper(htmlencode($array['nom_utilisateur']));
				
				if ($utilisateurEnCours['url_site'] != "http://" && $utilisateurEnCours['url_site'] != "")
					echo "<a href=\"".$utilisateurEnCours['url_site']."\"><b><u>".$nomUtilisateurEnCours."</u></b></a><br />\n";
				else
					echo "<b><u>".$nomUtilisateurEnCours."</u></b><br />\n";
			}
		}			
		if ($i == 0 && (toTime($array['time_min']) != "00" || toTime($array['time_sec']) != "00"))
		{
			echo "00:00 Introduction<br />\n";
			$i++;
		}
		
		if ($emission['id_site'] != $id_site)
			echo "<span>".getNomMorceauEmissionSite($emission['id_site'], toTime($array['time_min']), toTime($array['time_sec']), $array['nom_artiste'], $array['nom_morceau'], $array['nom_label'], $array['annee'])."</span><br />\n";
		else
			echo "<span>".getNomMorceauEmission (toTime($array['time_min']), toTime($array['time_sec']), $array['nom_artiste'], $array['nom_morceau'], $array['nom_label'], $array['annee'])."</span><br />\n";
		$i++;
	}

	if ($siteHaveParticipants)
	{
		echo "<br />";
		if ($chef != '')
		{
			echo utf8_encode("<p style=\"color:gray;\">Une émission présidée par ").$chef.".</p>";
			echo "<br />";
		}
	}
	echo '      ]]></description>';
	
	echo '      <enclosure url="'.$mp3Emission.'" type="audio/mpeg" length="'.$lengthEmission.'"/>\n';	
	echo '      <pubDate>'.$dateEmission.'</pubDate>\n';
	echo '    </item>\n\n';
}

if ($siteHaveNews)
{
	while ($haveNewsForFeed)
	{
		$dateNews = date('D, d M Y H:i:s O', strtotime($news['date']));	
		echo '    <item>';
		echo '      <title>News : '.$news['titre'].'</title>';
		echo '      <link>'.$radioclashHome.'</link>';
		echo '      <description><![CDATA[';	
		echo '          <span>'.$news['contenu_fr'].'</span>';
		echo '      ]]></description>';
		echo '      <pubDate>'.$dateNews.'</pubDate>';
		echo '    </item>';
		
		if ($news=mysql_fetch_array($listeNews))
			$dateNewsToCompare = strtotime($news['date']);
		else
			$haveNewsForFeed = false;				
	}
}

function htmlencode($value)
{
	return str_replace("&", "&amp;", $value);
}

echo '  </channel>';
echo '</rss>';
?>