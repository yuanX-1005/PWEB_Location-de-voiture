<?php 
    
	function infosVoiture($idV,&$infosVoiture){ //obtient les infos de voiture à partir de son id
		require ("connect.php");
		$sql="SELECT * FROM `Vehicule` where idVehicule = :idV";
		
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':idV', $idV, PDO::PARAM_STR); 
			$commande->execute();

			if ($commande->rowCount() > 0) {  
					$infosVoiture = $commande->fetch(PDO::FETCH_ASSOC); 
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

	function infosEntreprise($idE,&$infosEntreprise){ //obtient les infos de Client à partir de son id
		require ("connect.php");
		$sql="SELECT * FROM `Client` where idCLient = :idE";
		
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':idE', $idE, PDO::PARAM_STR); 
			$commande->execute();

			if ($commande->rowCount() > 0) {  
					$infosEntreprise = $commande->fetch(PDO::FETCH_ASSOC); 
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

	function infosFacturation($idF,&$infosFacturation){ //obtient les infos de facturation à partir de son id
		require ("connect.php");
		$sql="SELECT * FROM `facturation` where idFacturation = :idF";
		
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':idF', $idF, PDO::PARAM_STR); 
			$commande->execute();

			if ($commande->rowCount() > 0) { 
					$infosFacturation = $commande->fetch(PDO::FETCH_ASSOC); 
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


	function infosLesFacturationsParEntreprise($idE, $tempsRelle, &$infosFacturationParEntreprise){ //listes de facturation  d'un id client donnée 
		require ("connect.php") ;  //Pour avoir le $pdo
		$sql = "SELECT * FROM `facturation` WHERE idCLient=:idE AND	(dateFin>=:tempsRelle OR dateFin IS NULL)";
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':idE', $idE, PDO::PARAM_STR);
			$commande->bindParam(':tempsRelle', $tempsRelle, PDO::PARAM_STR);
			$commande->execute();

			if ($commande->rowCount() > 0 ) {  //compte le nb d'enregistrement
				$infosFacturationParEntreprise = $commande->fetchAll(PDO::FETCH_ASSOC);
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

	//Acquerir les infos d'un factuation à partir de l'id de entreprise et de voiture qu'il concerné.
	function acquerirInfoFacturation($idE,$idV,$tempsRelle,&$infoIdF){
		require ("connect.php") ;  //Pour avoir le $pdo
		$sql = "SELECT * FROM `facturation` WHERE idVehicule=:idV AND idCLient=:idE AND	(dateFin>=:tempsRelle OR dateFin IS NULL)";
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':idV', $idV, PDO::PARAM_STR);
			$commande->bindParam(':idE', $idE, PDO::PARAM_STR);
			$commande->bindParam(':tempsRelle', $tempsRelle, PDO::PARAM_STR);
			$commande->execute();

			if ($commande->rowCount() > 0 ) {  //compte le nb d'enregistrement
				$infoIdF = $commande->fetch(PDO::FETCH_ASSOC);
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

	//obtient les infos des vehicules concernant les id vehucule et les id Client données
	function acquerirInfoVoitures($idF,$idE,$tempsRelle,&$infoIdF){
		require ("connect.php") ;  //Pour avoir le $pdo
		$sql = "SELECT * FROM `facturation` WHERE idVehicule=:idV AND idCLient=:idE AND	(dateFin>=:tempsRelle OR dateFin IS NULL)";
		try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':idV', $idV, PDO::PARAM_STR);
			$commande->bindParam(':idE', $idE, PDO::PARAM_STR);
			$commande->bindParam(':tempsRelle', $tempsRelle, PDO::PARAM_STR);
			$commande->execute();

			if ($commande->rowCount() > 0 ) {  //compte le nb d'enregistrement
				$infoIdF = $commande->fetch(PDO::FETCH_ASSOC);
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