<?php 

	//returne dans infoVoiture les liste de voiture qui sont disponible
	function chercher_VoituresDisp(&$infoVoiture){
		require ("connect.php");
		$sql="SELECT * FROM `Vehicule` where location = 'disponible'";
		
		try{
			$commande = $pdo->prepare($sql);
			$commande->execute();

			if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
					$infoVoiture = $commande->fetchAll(); //svg du infos de voitures
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


	//connexion entreprise
	function verif_connexionEntrep($nom,$cleanmdp, &$profil) {
			
		require ("connect.php");
		$sql="SELECT * FROM `Client` where nom=:nom and mdp=:cleanmdp"; 
		
		try {
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':nom', $nom, PDO::PARAM_STR);
			$commande->bindParam(':cleanmdp', $cleanmdp, PDO::PARAM_STR);
			$commande->execute();
			
			if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
				$profil = $commande->fetch(PDO::FETCH_ASSOC); //svg du profil
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


	function vehiculeEnCourDeLocation($idE,$tempsRelle, &$ListeVoitureLocat) {
		require ("connect.php") ;  //Pour avoir le $pdo
		$sql = "SELECT * FROM `Vehicule` INNER JOIN `facturation` ON 
		(Vehicule.idVehicule=facturation.idVehicule)
		WHERE (Vehicule.idCLient=:idE AND (facturation.dateFin>=:tempsRelle OR facturation.dateFin IS NULL))";
		
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':idE', $idE, PDO::PARAM_STR);
			$commande->bindParam(':tempsRelle', $tempsRelle, PDO::PARAM_STR);
			$commande->execute();
	
			if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
				$ListeVoitureLocat = $commande->fetchAll(); 
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



	function verif_inscriptEntrep_email($email,&$profil){
		require ("connect.php");
		$sql="SELECT * FROM `Client`  where email=:email"; 
		
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':email', $email, PDO::PARAM_STR); 
			$commande->execute();
			
			// $commande->debugDumpParams(); //affiche la requete préparée
			// die ('RowCount ' . $commande->rowCount() . '<br/>');
			
			if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
				$profil = $commande->fetch(PDO::FETCH_ASSOC); //svg du profil
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

	function verif_inscriptEntrep_mdp($mdp,&$profil){
		require ("connect.php");
		$sql="SELECT * FROM `Client`  where mdp=:mdp"; 
		
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':mdp', $cleanmdp, PDO::PARAM_STR); 
			$commande->execute();
			
			// $commande->debugDumpParams(); //affiche la requete préparée
			// die ('RowCount ' . $commande->rowCount() . '<br/>');
			
			if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
				$profil = $commande->fetch(PDO::FETCH_ASSOC); //svg du profil
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

	function ajouter_persone($nom, $cleanmdp, $email, &$inscrit){
		require ("connect.php");
		$sql="INSERT INTO `Client` (nom, mdp, email) VALUES (:nom, :cleanmdp, :email)"; 
		
			try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':nom', $nom, PDO::PARAM_STR); 
			$commande->bindParam(':cleanmdp', $cleanmdp, PDO::PARAM_STR); 
			$commande->bindParam(':email', $email, PDO::PARAM_STR); 
			$commande->execute();

			if ($commande->rowCount() > 0) {  //compte le nb d'enregistrement
				$inscrit = $commande->fetch(PDO::FETCH_ASSOC); //svg du inscrit
				return true;
			}
			else {
				return false;
			}

			// return true;
		}
		
		catch (PDOException $e) {
			echo utf8_encode("Echec d'insert : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
	}

	




?>
