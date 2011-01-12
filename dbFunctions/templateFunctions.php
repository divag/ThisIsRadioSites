<?php
include ("../sitevars.php");

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
    $pattern = Array("?", "?", "?", "?", "?", "?", "?", "?", "?", "?");
    $rep_pat = Array("e", "e", "e", "c", "a", "a", "i", "i", "u", "o");
    $cleaned= str_replace($pattern, $rep_pat, $badstring);
    $cleaned= wd_remove_accents($cleaned);
	
    $file_bad = array("@-@", "@_@", "@[^A-Za-z0-9_\ ]@", "@\ +@");
    $file_good = array(" ", " ", "", " ");
    $cleaned= preg_replace($file_bad, $file_good, $cleaned);
    $cleaned= str_replace(" ", "_", trim($cleaned));
	
    return $cleaned;
}

function getReferenceEmission($numero, $titre, $nomParticipant)
{
	$replaceArray = array(
	  '{numero}' => str_pad($numero, 3, "0", STR_PAD_LEFT), 
	  '{titre}' => $titre, 
	  '{nom_participant}' => $nomParticipant
	);
	
	$reference = str_replace(array_keys($replaceArray), array_values($replaceArray), TEMPLATE_REF_EMISSION);
	return $reference;
}

function getNomFichierEmission($numero, $titre, $nomParticipant)
{
	$replaceArray = array(
	  '{numero}' => str_pad($numero, 3, "0", STR_PAD_LEFT), 
	  '{titre}' => $titre, 
	  '{nom_participant}' => $nomParticipant
	);
	
	$nomFichier = str_replace(array_keys($replaceArray), array_values($replaceArray), TEMPLATE_NOM_FICHIER_EMISSION);
	return clean($nomFichier);
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

?>