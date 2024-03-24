<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {

  public static function getUserByLoginAndPass($login,$pass)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;////se connecter à la base de donnees

	$userRepository = $em->getRepository('utilisateur');//////utiliser la table jabaianb.utilisateur graçe a la classe utilisateur
	$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));//findOneBy trouve l' utilisateur dans la base grace aux arguments(login,pass) 	
	
	return $user; 
	}

	public static function getUserById($id)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$utilisateurRepository=$em->getRepository('utilisateur');
		$utilisateur=$utilisateurRepository->findOneBy(array('id'=>$id));
		if ($utilisateur == false){
		
				   }
		return $utilisateur; 

	}
	public static function ajouterUtilisateur($prenom, $nom, $pseudo, $motDePasse)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$dejaInscrit=utilisateurTable::getUserByLoginAndPass($pseudo,$motDePasse);
       
		
		// Création d'une nouvelle instance d 'utilisateur
		if($dejaInscrit) 
		{
			return null;
		}
        $utilisateur = new utilisateur();
        $utilisateur->prenom =$prenom;
        $utilisateur->nom=$nom;
        $utilisateur->identifiant=$pseudo;
        $utilisateur->pass=sha1($motDePasse);

        // Persiste et flush pour sauvegarder l'utilisateur dans la base de données
        $em->persist($utilisateur);
        $em->flush();

        return $utilisateur;
    }

	}


  



?>
