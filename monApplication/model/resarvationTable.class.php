<?php
// Inclusion de la classe resatrvation
require_once "resarvation.class.php";

class reservationTable {

  public static function getReservationByVoyage($voyage)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$reservationRepository = $em->getRepository('reservation');
	$reservation = $reservationRepository->findBy(array('voyage' =>$voyage ));	
	
	if ($reservation== false){
	
			   }
	return $reservation; 
	}

	public static function reserver($idVoyageArray,$idVoyageur)
	{
	//transformer une chaine de caractere en tableau de int  pour le mettre en voyage 
	$idsVoyageArray = array_map('intval', explode(',', trim($idVoyageArray, '{}')));
	$idsVoyageArray = array_map('intval', $idsVoyageArray);
	
	
	///pour chaque id 
	foreach($idsVoyageArray as $idVoyage){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$voyage =voyageTable::getVoyagesByid($idVoyage);

		$voyageur=utilisateurTable::getUserById($idVoyageur);
		if(! $voyage)
		{
			echo'aucun voyage trouvé';
		}
  	if($voyage->nbplace<=0){
		echo'reservation impossible';
	}
	$voyage->nbplace=$voyage->nbplace-1;
	//$reservationRepository = $em->getRepository('reservation');
	$reservation = new reservation();
        $reservation->voyage =$voyage;
        $reservation->voyageur=$voyageur;

        // Persiste et flush pour sauvegarder le voyage et la reservation dans la base de données
        $em->persist($reservation);
        $em->flush();
		$em->persist($voyage);
        $em->flush();
	}
		
	
	
	return $reservation; 
	}
	public static function getReservationByVoyageur($voyageur)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$reservationRepository = $em->getRepository('reservation');
	$reservation = $reservationRepository->findBy(array('voyageur' =>$voyageur ));	
	
	if ($reservation== false){
		
			   }
	return $reservation; 
	}
  
}


?>
