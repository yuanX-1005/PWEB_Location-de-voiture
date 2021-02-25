<?php 
    //verifier la identité de Loueur
	function verif_connexionLoueur($nomLoueur,$mdpLoueur, &$profilLoueur) {
			
		require ("connect.php");
		$sql="SELECT * FROM `loueur` where nomLoueur=:nomLoueur and mdpLoueur=:mdpLoueur"; 
		
		try {
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':nomLoueur', $nomLoueur, PDO::PARAM_STR);
			$commande->bindParam(':mdpLoueur', $mdpLoueur, PDO::PARAM_STR);
			$commande->execute();
			
			if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
				$profilLoueur = $commande->fetch(PDO::FETCH_ASSOC); //svg du profil
				return true;
			}
			else {
				return false;
			}
		}
		
		
		catch (PDOException $e) {
			echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
	
	}
	
	// trouve les voitures qui sont disponibles
	function afficher_Voiture_Stock($idL,&$ListeVoitureStock){
		require ("connect.php");  //Pour avoir le $pdo
		$sql = "SELECT * FROM `Vehicule` WHERE Vehicule.idLoueur=:idL AND location = 'disponible'";
		
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':idL', $idL, PDO::PARAM_STR);
			$commande->execute();
			
			if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
				$ListeVoitureStock = $commande->fetchAll(); 
				
				return true;
			}
			else {
				return false;
			}
		}
		
		catch (PDOException $e) {
			echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
	}
	
	//trouves les voitures deja loué aux clients
	function afficher_Voiture_Loué($idL,&$ListeVoitureLoué, &$nombreVoitureId){
		require ("connect.php") ;  //Pour avoir le $pdo
		$sql = "SELECT * FROM `Vehicule` WHERE Vehicule.idLoueur=:idL AND location = 'non_disponible' ORDER BY idCLient";
		$sql2 = "SELECT idClient, COUNT(*) FROM `Vehicule` where idClient is not null Group by idClient Order by idClient ";
		try{
			$commande = $pdo->prepare($sql);
			$commande1 = $pdo->prepare($sql2);
			$commande->bindParam(':idL', $idL, PDO::PARAM_STR);
			$commande->execute();
			$commande1->execute();
			
			if ($commande->rowCount() > 0 && $commande1->rowCount() > 0) {  //compte le nb d'enregistrement
				$ListeVoitureLoué = $commande->fetchAll(); 
				$nombreVoitureId = $commande1->fetchAll();
				// var_dump($ListeVoitureLoué);
				// var_dump($nombreVoitureId);
				
				return true;
			}
			else {
				return false;
			}
		}
		
		catch (PDOException $e) {
			echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
	}
	

	
	
	


?>
