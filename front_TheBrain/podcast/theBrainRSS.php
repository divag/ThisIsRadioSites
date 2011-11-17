<?php
	echo '<?xml version="1.0" encoding="UTF-8" ?>';

	$firstEmission = 28;
	$lastEmission = 102;

	echo '<rss version="2.0">';
	echo '  <channel>';
	echo '    <title>The Brain RadioShow</title>';
	echo '    <link>http://www.thisisradioclash.org/theBrain/podcast/theBrainRSS.php</link>';
	echo '    <description>The Brain RadioShow\'s Podcast !</description>';
	echo '    <image>';
	echo '      <url>http://thebrain.lautre.net/logothebrainfond.jpg</url>';
	echo '      <link>http://thebrain.lautre.net</link>';
	echo '    </image>';
	echo '    <language>en-us</language>';

	/****/
	
	//$listeFichiers = file_get_contents("ftp://ftp.duckcorp.org/thebrain/");
	// set up basic connection
$conn_id = ftp_connect('ftp.duckcorp.org');

// login with username and password
$login_result = ftp_login($conn_id, 'anonymous', 'anonymous');

// get the file list for /
$buff = ftp_rawlist($conn_id, '/thebrain/');

// close the connection
ftp_close($conn_id);

$sizeEmission = array();

// traitement du buffer
for ($i=1; $i<count($buff); $i++)
{
	$tempLine = explode(" ", $buff[$i]);
	
	$j=0;
	$item=0;
	while ($item != 5)
	{
		if ($tempLine[$j] != "")
			$item++;
		$j++;
	}
	$j--;
	
	$sizeEmission[$tempLine[count($tempLine) -1]] = $tempLine[$j];
}

// output the buffer
//var_dump($sizeEmission);
	
	echo $listeFichiers;
	
	for ($i=$lastEmission; $i > $firstEmission-1; $i--)
	{
		$numeroEmission = $i;
		$titreEmission = "The Brain # ".$numeroEmission;
		$imageEmission = "http://thebrain.lautre.net/archiveplaylist/".$numeroEmission;
		
		if (@file_get_contents($imageEmission."gd.jpg"))
			$imageEmission .= "gd.jpg";
		else
		{
			if (@file_get_contents($imageEmission."gd.gif"))
				$imageEmission .= "gd.gif";
			else
			{
				if (@file_get_contents($imageEmission.".jpg"))
					$imageEmission .= ".jpg";
				else
				{
					if (@file_get_contents($imageEmission.".gif"))
						$imageEmission .= ".gif";
				}
			}
		}
		
		$mp3Emission = "ftp://ftp.duckcorp.org/thebrain/thebrain".$numeroEmission.".mp3";
		$lengthEmission = $sizeEmission["thebrain".$numeroEmission.".mp3"];
		$linkEmission = "http://thebrain.lautre.net/playlists/playlist".$numeroEmission.".html";
		
		echo '    <item>';
		echo '      <title>The Brain #'.$numeroEmission.'</title>';
		echo '      <link>'.$linkEmission.'</link>';
		echo '      <description><![CDATA[';
		echo '        <img src="'.$imageEmission.'" alt="cover" width="346" height="346" /><br />';
		echo '        Playlist here : <a href="'.$linkEmission.'" title="visit the playlist page">'.$linkEmission.'</a><br />';
		echo '      ]]></description>';
		echo '      <enclosure url="'.$mp3Emission.'" type="audio/mpeg" length="'.$lengthEmission.'"/>';
		echo '      <pubDate>'.$dateEmission.'</pubDate>';
		echo '    </item>';
	}

	echo '  </channel>';
	echo '</rss>';
?>