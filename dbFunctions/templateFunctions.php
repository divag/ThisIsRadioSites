<?php

//=========================
// Fonctions de Templates :
//=========================

function wd_remove_accents($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);
    
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    
    return $str;
}

function clean($badstring)
{
    $pattern = Array("?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "'");
    $rep_pat = Array("e", "e", "e", "c", "a", "a", "i", "i", "u", "o", "-");
    $cleaned= str_replace($pattern, $rep_pat, $badstring);
    $cleaned= wd_remove_accents($cleaned);
	
    $file_bad = array("@-@", "@_@", "@[^A-Za-z0-9_\ ]@", "@\ +@");
    $file_good = array(" ", " ", "", " ");
    $cleaned= preg_replace($file_bad, $file_good, $cleaned);
    $cleaned= str_replace(" ", "-", trim($cleaned));
	
    return $cleaned;
}

function getReferenceEmission($numero, $titre, $nomParticipants)
{
	$replaceArray = array(
	  '{numero}' => str_pad($numero, 3, "0", STR_PAD_LEFT), 
	  '{titre}' => $titre, 
	  '{nom_participant}' => str_replace(", ", " & ", $nomParticipants)
	);
	
	$reference = str_replace(array_keys($replaceArray), array_values($replaceArray), TEMPLATE_REF_EMISSION);
	return $reference;
}

function getNomFichierEmission($numero, $titre, $nomParticipants)
{
	$replaceArray = array(
	  '{numero}' => str_pad($numero, 3, "0", STR_PAD_LEFT), 
	  '{titre}' => clean($titre), 
	  '{nom_participant}' => clean(str_replace(", ", " & ", $nomParticipants))
	);
	
	$nomFichier = str_replace(array_keys($replaceArray), array_values($replaceArray), TEMPLATE_NOM_FICHIER_EMISSION);
	return $nomFichier;
}

function getNomMorceauEmission ($time_min, $time_sec, $nom_artiste, $nom_morceau, $nom_label, $annee)
{
	$replaceArray = array(
	  '{time_min}' => $time_min,
	  '{time_sec}' => $time_sec,
	  '{nom_artiste}' => $nom_artiste,
	  '{nom_morceau}' => $nom_morceau,
	  '{nom_label}' => $nom_label,
	  '{annee}' => $annee
	);
	
	$nomMorceau = str_replace(array_keys($replaceArray), array_values($replaceArray), TEMPLATE_NOM_MORCEAU_EMISSION);
	return $nomMorceau;
}

function getReferenceEmissionSite($id_site, $numero, $titre, $nomParticipants)
{
	$replaceArray = array(
	  '{numero}' => str_pad($numero, 3, "0", STR_PAD_LEFT), 
	  '{titre}' => $titre, 
	  '{nom_participant}' => str_replace(", ", " & ", $nomParticipants)
	);
	
	$config_site = dbGetParametresSite($id_site);
	$templateReferenceEmission_site = $config_site['template_reference_emission'];

	$reference = str_replace(array_keys($replaceArray), array_values($replaceArray), $templateReferenceEmission_site);
	return $reference;
}

function getNomFichierEmissionSite($id_site, $numero, $titre, $nomParticipants)
{
	$replaceArray = array(
	  '{numero}' => str_pad($numero, 3, "0", STR_PAD_LEFT), 
	  '{titre}' => clean($titre), 
	  '{nom_participant}' => clean(str_replace(", ", " & ", $nomParticipants))
	);
	
	$config_site = dbGetParametresSite($id_site);
	$templateNommageFichiersEmission_site = $config_site['template_nommage_fichiers_emission'];

	$nomFichier = str_replace(array_keys($replaceArray), array_values($replaceArray), $templateNommageFichiersEmission_site);
	return $nomFichier;
}

function getNomMorceauEmissionSite($id_site, $time_min, $time_sec, $nom_artiste, $nom_morceau, $nom_label, $annee)
{
	$replaceArray = array(
	  '{time_min}' => $time_min,
	  '{time_sec}' => $time_sec,
	  '{nom_artiste}' => $nom_artiste,
	  '{nom_morceau}' => $nom_morceau,
	  '{nom_label}' => $nom_label,
	  '{annee}' => $annee
	);
	
	$config_site = dbGetParametresSite($id_site);
	$templateNommageMorceauxEmission_site = $config_site['template_nommage_morceaux_emission'];

	$nomMorceau = str_replace(array_keys($replaceArray), array_values($replaceArray), $templateNommageMorceauxEmission_site);
	return $nomMorceau;
}

?>