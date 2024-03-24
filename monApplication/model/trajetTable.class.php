<?php
// Inclusion de la classe trajet
require_once "trajet.class.php";

class trajetTable {

  public static function getTrajet($depart,$arrivee)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;//se connecter à la base de donnees

	$trajetRepository = $em->getRepository('trajet');//utiliser la table jabaianb.trajet graçe a la classe trajet
	$trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee' => $arrivee));	//findOneBy trouve le trajet  dans la base grace aux arguments(arrivee,depart) 
	
	
	return $trajet; 
	}

  
}


?>
