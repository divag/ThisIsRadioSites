<?php
echo '<?xml version="1.0" encoding="UTF-8" ?>';

include('../dbFunctions/dbFunctions.php');
include('../sitevars.php');

$listeEmissions = dbListeEmissionsForFeed();

echo '<rss version="2.0">';
echo '  <channel>';
echo '    <title>ThisIsRadioclash</title>';
echo '    <link>'.$radioclashHome.'feed/rssGenerate.php</link>';
echo '    <description>This is Radioclash\'s Podcast !</description>';
echo '    <image>';
echo '      <url>'.$radioclashHome.'css/bandeau.gif</url>';
echo '      <link>'.$radioclashHome.'</link>';
echo '    </image>';
echo '    <language>en-us</language>';

while($emission=mysql_fetch_array($listeEmissions))
{
	$numeroEmission = $emission['numero'];
	$titreEmission = "This is Radioclash ".$numeroEmission." : ".$emission['titre'];
	$imageEmission = $radioclashHome.$pics."thisisradioclash-episode".$numeroEmission.".jpg";
	$mp3Emission = $radioclashHome.$mp3s."thisisradioclash-episode".$numeroEmission.".mp3";
	$linkEmission = $radioclashHome."playlist.php?episode=".$numeroEmission;
	$lengthEmission = getBytesLengthEmission($numeroEmission);
	$dateEmission = date('D, d M Y H:i:s O', strtotime($emission['date_sortie']));
	
	echo '    <item>';
	echo '      <title>'.$titreEmission.'</title>';
	echo '      <link>'.$linkEmission.'</link>';
	echo '      <description><![CDATA[';
	echo '        <img src="'.$imageEmission.'" alt="cover" width="346" height="346" /><br />';
	echo '        00:00 This is radioclash - Introduction Jingle<br />';

	
		$playlist = dbGetPlaylist($numeroEmission);
		$nomUtilisateurEnCours = "";
		$chef = dbGetChefEmission($numeroEmission);
		$i = 1;
		while($array=mysql_fetch_array($playlist))
		{
			if ($nomUtilisateurEnCours != strtoupper($array['nom_utilisateur']))
			{
				$utilisateurEnCours = dbGetUtilisateur(urlencode(addslashes($array['nom_utilisateur'])));
				$nomUtilisateurEnCours = strtoupper($array['nom_utilisateur']);
				
				if ($utilisateurEnCours['url_site'] != "http://" && $utilisateurEnCours['url_site'] != "")
					echo "<a href=\"".$utilisateurEnCours['url_site']."\"><b><u>".$nomUtilisateurEnCours."</u></b></a><br />";
				else
					echo "<b><u>".$nomUtilisateurEnCours."</u></b><br />";
			}
			echo "<span>".toTime($array['time_min']).":".toTime($array['time_sec'])." ".$array['nom_artiste']." - ".$array['nom_morceau']."<br />";
			$i++;
		}

		echo "<br />";
		if ($chef != '')
		{
			echo utf8_encode("<p style=\"color:gray;\">Une �mission pr�sid�e par ").$chef.".</p>";
			echo "<br />";
		}

	echo '      ]]></description>';
	echo '      <enclosure url="'.$mp3Emission.'" type="audio/mpeg" length="'.$lengthEmission.'"/>';
	echo '      <pubDate>'.$dateEmission.'</pubDate>';
	echo '    </item>';
}

echo '  </channel>';
echo '</rss>';
?>