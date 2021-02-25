<?php
    // trouves le nombre de jours ecartes entre deux date (debut de location et fin de location)
    function differenceEntreDeuxDates($day1,$day2){
		$date_List_D=explode("-",$day1); // convertir les dates en estampilles
		$date_List_F=explode("-",$day2);
		$dDebut=mktime(0,0,0,$date_List_D[1],$date_List_D[2],$date_List_D[0]);
		$dFin=mktime(0,0,0,$date_List_F[1],$date_List_F[2],$date_List_F[0]);
		if($dDebut>$dFin){
			return 0;
		}elseif($dDebut==$dFin){
			return 1;
		}
		return (round(($dFin - $dDebut)/86400))+1; // 86400=60*60*24
	}
	
	//Mettre les voitures en mode loué, la location devient non disponible 
    function ajouter_Voitures_Au_Panier($idE,$idV,&$ModifVehicule){
		require ("connect.php");

		$sql="UPDATE `Vehicule` SET idClient= :idE, location= 'non_disponible' WHERE idVehicule= :idV"; 
			try{
				$commande = $pdo->prepare($sql);
				$commande->bindParam(':idE', $idE, PDO::PARAM_INT); 
				$commande->bindParam(':idV', $idV, PDO::PARAM_INT); 
				$commande->execute();

			if ($commande->rowCount() > 0) {  //compte le nb vehicule mis à jours
				$ModifVehicule = $commande->fetch(PDO::FETCH_ASSOC); 
				return true;
			}
			else {
				return false;
			}
		}
		
		catch (PDOException $e) {
			echo utf8_encode("Echec d'insert : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
	}

	//créer un nouvelle facturation dans le table `facturation`
	function ajouterFacturation($dateDebut, $valeur, $dateFin, $etat, $idVehicule, $idCLient){
		require ("connect.php");
		$sql="INSERT INTO `facturation` (dateDebut, valeur, dateFin, etat, idVehicule, idCLient) VALUES (:dateDebut, :valeur, :dateFin, :etat, :idVehicule, :idCLient)"; 
		
			try{
			$commande = $pdo->prepare($sql);
			$commande->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR); 
			$commande->bindParam(':valeur', $valeur, PDO::PARAM_STR); 
			$commande->bindParam(':dateFin', $dateFin, PDO::PARAM_STR); 
			$commande->bindParam(':etat', $etat, PDO::PARAM_BOOL);
			$commande->bindParam(':idVehicule', $idVehicule, PDO::PARAM_INT); 
			$commande->bindParam(':idCLient', $idCLient, PDO::PARAM_INT); 
			$commande->execute();

			return $pdo->lastInsertId();
		}
		
		catch (PDOException $e) {
			echo utf8_encode("Echec d'insert : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
	}
?>