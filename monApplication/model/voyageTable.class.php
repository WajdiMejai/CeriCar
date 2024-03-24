<?php
// Inclusion de la classe voyage
require_once "voyage.class.php";

class voyageTable {

  public static function  getVoyagesByTrajet($trajet)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;//se connecter à la base de donnees

	$voyageRepository = $em->getRepository('voyage');//
	
	$voyage = $voyageRepository->findBy(['trajet' => $trajet]);	//le findBy permet de reecuperer tous les voyage dont le trajet et celui donne en argument 
	
	
	return $voyage; 
	}

  public static function  getVoyagesByid($id)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;//se connecter à la base de donnees

	$voyageRepository = $em->getRepository('voyage');//
	
	$voyage = $voyageRepository->findoneBy(['id' => $id]);	//le findBy permet de reecuperer tous les voyage dont le trajet et celui donne en argument 
	
	
	return $voyage; 
	}



public static function getCorrespondance($depart, $arrivee, $places) {
    $em = dbconnection::getInstance()->getEntityManager()->getConnection();
    $query = $em->prepare('SELECT * FROM trouverChemin(\''.$depart.'\',\''.$arrivee.'\','.$places.');');
    $bool = $query->execute();

    if ($bool === false) {
        return NULL;
    }

    return $query->fetchAll(); 
}

public static function getVoyagesByConducteur($idConducteur) {
  
  $em = dbconnection::getInstance()->getEntityManager() ;
	$voyageRepository = $em->getRepository('voyage');
  $conducteur=utilisateurTable::getUserById($idConducteur);
  $voyages = $voyageRepository->findBy(['conducteur' => $conducteur]);
  

  return $voyages;
}



public static function ajouterVoyage($depart, $arrivee, $heureDepart, $nbPlaces, $tarif, $contraintes,$idConducteur)
{
    $em = dbconnection::getInstance()->getEntityManager();
  	$conducteur=utilisateurTable::getUserById($idConducteur);
    $trajet=trajetTable::getTrajet($depart,$arrivee);
    
    $voyage = new Voyage();
    $voyage->trajet=$trajet;
    $voyage->heuredepart=$heureDepart;
    $voyage->nbplace=$nbPlaces;
    $voyage->tarif=$tarif;
    $voyage->contraintes=$contraintes;
    $voyage->conducteur =$conducteur;

    $em->persist($voyage);
    $em->flush();

    return $voyage;
}
  }
	

?>
