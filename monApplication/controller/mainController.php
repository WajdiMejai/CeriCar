<?php

class mainController
{

	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		$context->notification="vous etes dans helloWorld";
		return context::SUCCESS;
	}



	public static function index($request,$context){
		$context->notification="vous etes dans index";
		return context::SUCCESS;
	}


	public static function SuperTest($request,$context){
	
		if (isset($request['param1'])) {
			$context->mavariable1 = $request['param1'];
		}
	
		if (isset($request['param2'])) {
			$context->mavariable2 = $request['param2'];
		}
		$context->notification="Ceci est un test";
		return context::SUCCESS;
	}
    
	public static function testConnexion($request,$context){
		$context->user=utilisateurTable::getUserByLoginAndPass('User1','0bc8658ea4e2f64af9d6890eace91a819f9f2046');
        $context->trajet=trajetTable::getTrajet('Angers','Amiens');
		$context->voyage=voyageTable:: getVoyagesByTrajet(355);
		$context->reservation=reservationTable:: getReservationByVoyage(2);
		$context->utilisateur=utilisateurTable:: getUserById(2);
        return context::SUCCESS;
	}
	public static function chercherVoyage($request,$context){//la fonction qui permet d'afficher les voyages
		
        $context->trajet=trajetTable::getTrajet($request["Depart"],$request["Arrivee"]);
		$context->voyage=voyageTable:: getVoyagesByTrajet( $context->trajet);
        return context::SUCCESS;
	}
	public static function formulaire($request,$context){
		return context::SUCCESS;
	}
	public static function correspondance($request,$context){
		$context->correspondances = voyageTable::getCorrespondance($request["Depart"], $request["Arrivee"],$request["Places"]);
		return context::SUCCESS;
	}

	public static function formulaireInscription($request,$context){
		return context::SUCCESS;
	}
	public static function formulaireConnexion($request,$context){
		return context::SUCCESS;
	}
	public static function Acceuil($request,$context){
		return context::SUCCESS;
	}
	public static function inscrire($request,$context){
		$context->utilsateur= utilisateurTable::ajouterUtilisateur($request["nom"], $request["prenom"], $request["pseudo"], $request["pass"]);
		return context::SUCCESS;
	}
	public static function connecter($request,$context){
		$context->utilisateur=utilisateurTable::getUserByLoginAndPass($request["pseudo"], $request["pass"]);
		// Persiste et flush pour sauvegarder le voyage dans la base de données
		return context::SUCCESS;
	}
	public static function deconnecter($request,$context){
		session_destroy();
		return context::SUCCESS;
	}
	public static function reserver($request,$context){
		$context->reservation= reservationTable::reserver( $request["idVoyage"],$_SESSION["id"]);
		return context::SUCCESS;
	}
	public static function formulaireVoyage($request,$context){
		
		return context::SUCCESS;
	}
	public static function proposerVoyage($request,$context){
		$context->voyage= voyageTable::ajouterVoyage($request["depart"], $request["arrivee"], $request["heureDepart"], $request["nbPlaces"], $request["tarif"],$request["contraintes"],$_SESSION["id"]);
		return context::SUCCESS;
	}

	public static function profil($request,$context){
		$context->voyages= voyageTable::getVoyagesByConducteur($_SESSION["id"]);
	
		$context->voyageur= utilisateurTable::getUserById($_SESSION["id"]);

		$context->reservation= reservationTable::getReservationByVoyageur($context->voyageur);
		return context::SUCCESS;

	}

}

